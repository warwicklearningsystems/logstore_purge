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
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $DB;

        $loglifetime = (int)get_config('logstore_purge', 'loglifetime');

        if (empty($allloglifetime) || $allloglifetime < 0) {
            return;
        }

        $loglifetime = time() - ($loglifetime * 3600 * 24); // Value in days.
        $lifetimep = array($loglifetime);
        $start = time();

//        $sqlwhere = "target IN ('calendar_event', 'webservice_function') AND timecreated < ?";
        $configtargets = (string)get_config('logstore_purge', 'eventtargets');
        $targets = preg_replace('/\s+/', '', $configtargets);
	if (empty($targets) {
            return;
        }
        $sqltarget = "'" . implode("','", explode(',', $targets)) . "'";
        $sqlwhere = "target IN (". $sqltarget . ") AND timecreated < ?"

        while ($min = $DB->get_field_select("logstore_standard_log", "MIN(timecreated)", $sqlwhere, $lifetimep)) {
            // Break this down into chunks to avoid transaction for too long and generally thrashing database.
            // Experiments suggest deleting one day takes up to a few seconds; probably a reasonable chunk size usually.
            // If the cleanup has just been enabled, it might take e.g a month to clean the years of logs.
            $params = array(min($min + 3600 * 24, $loglifetime));
            $DB->delete_records_select("logstore_standard_log", $sqlwhere, $params);
            if (time() > $start + 300) {
                // Do not churn on log deletion for too long each run.
                break;
            }
        }

        mtrace(" Deleted legacy log records from standard store.");
    }
}
