<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * log purger.
 *
 * @package    logstore_purge
 * @copyright  2020 University orf Warwick
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_purge\task;

defined('MOODLE_INTERNAL') || die();

define ('LPDEBUG', false);
function debug_var_dump($val) {
    if (defined('LPDEBUG') && LPDEBUG) {
        var_dump($val);
    };
};

class purge_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('tasklogpurge', 'logstore_purge');
    }

    /**
     * Do the job.
     */
    public function execute() {
        global $DB;

        $loglifetime = (int)get_config('logstore_purge', 'loglifetime');
        $maxtime = (int)get_config('logstore_purge', 'maxproctime');
        $maxdels = (int)get_config('logstore_purge', 'maxdeletions');

        debug_var_dump($loglifetime); debug_var_dump($maxtime); debug_var_dump($maxdels);

        if (empty($loglifetime) || $loglifetime < 0) {
            return;
        }

        $loglifetime = time() - ($loglifetime * 3600 * 24); // Value in days.
        $lifetimep = array($loglifetime);
        $start = time();

        $configtargets = (string)get_config('logstore_purge', 'eventtargets');
        $targets = preg_replace('/\s+/', '', $configtargets);
        if (empty($targets)) {
            return;
        }
        $sqltarget = "'" . implode("','", explode(',', $targets)) . "'";
        $sqlwhere = "target IN (". $sqltarget . ") AND timecreated < ?";

        debug_var_dump($sqlwhere); debug_var_dump($lifetimep);

        while ($count = $DB->get_field_select("logstore_standard_log", "COUNT(timecreated)", $sqlwhere, $lifetimep)) {
            $sqlwherelimit = "target IN (". $sqltarget . ") AND timecreated < ? ORDER BY timecreated LIMIT " . min($maxdels,$count);
            debug_var_dump($count); debug_var_dump($sqlwherelimit);
            $DB->delete_records_select("logstore_standard_log", $sqlwherelimit, $lifetimep);

            if (time() > $start + $maxtime) {
                // Do not churn on log deletion for too long each run.
                break;
            }
        }
        mtrace(" Purged legacy log records from standard store.");
    }
}
