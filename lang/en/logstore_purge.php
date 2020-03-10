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
 * Log store lang strings.
 *
 * @package    logstore_purge
 * @copyright  2020 University of Warwick
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Log Purger';
$string['pluginname_desc'] = 'A log plugin that deletes legacy log entries, matchiing specified targets, from the Moodle logstore table.';
$string['privacy:metadata'] = 'The log purger only deletes data.';
$string['tasklogpurge'] = 'Log table purger';
$string['eventtargets'] = 'Purge events with target';
$string['eventtargetshelp'] = 'Event targets separated by commas';
$string['loglifetime'] = 'Only purge events older than';
$string['loglifetimehelp'] = 'All events younger than this will be retained';
$string['neverpurgeevents'] = 'Never purge events';
$string['maxproctime'] = 'Max processing time (secs)';
$string['maxproctimehelp'] = 'If exceeded, processing ends before next chunk of events are deleted';
$string['maxdels'] = 'Max number of events deleted between time expiry checks';
$string['maxdelshelp'] = 'Chunk size';
