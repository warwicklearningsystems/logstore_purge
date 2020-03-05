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
 * Purge log store.
 *
 * @package    logstore_purge
 * @copyright  2020 University of Warwick
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_purge\log;

defined('MOODLE_INTERNAL') || die();

class store implements \tool_log\log\writer {
    use \tool_log\helper\store,
        \tool_log\helper\buffered_writer;

    /**
     * Constructor.
     * @param \tool_log\log\manager $manager
     * @throws \coding_exception
     */
    public function __construct(\tool_log\log\manager $manager) {
        $this->helper_setup($manager);
    }

    /**
     * Finally store the events into Splunk.
     *
     * @param array $evententries raw event data
     */
    protected function insert_event_entries($evententries) {
            return;
    }
}
