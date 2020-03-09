
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
 * Logpurge settings.
 *
 * @package    logstore_purge
 * @copyright  2013 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings->add(new admin_setting_configtext('logstore_purge/eventtargets',
        new lang_string('eventtargets', 'logstore_purge'),
        new lang_string('eventtargetshelp', 'logstore_purge'), 
        '', PARAM_TEXT));

    $options = array(
        0    => new lang_string('neverpurgeevents', 'logstore_purge'),
        1000 => new lang_string('numdays', '', 1000),
        365  => new lang_string('numdays', '', 365),
        350  => new lang_string('numdays', '', 350),
        300  => new lang_string('numdays', '', 300),
        180  => new lang_string('numdays', '', 180),
        150  => new lang_string('numdays', '', 150),
        120  => new lang_string('numdays', '', 120),
        90   => new lang_string('numdays', '', 90),
        60   => new lang_string('numdays', '', 60),
        30   => new lang_string('numdays', '', 30),
        10   => new lang_string('numdays', '', 10),
        5    => new lang_string('numdays', '', 5),
        2    => new lang_string('numdays', '', 2));
    $settings->add(new admin_setting_configselect('logstore_purge/loglifetime',
        new lang_string('loglifetime', 'logstore_purge'),
        new lang_string('loglifetimehelp', 'logstore_purge'), 
        0, $options));

    $settings->add(new admin_setting_configtext( 'logstore_purge/maxproctime',
        new lang_string('maxproctime', 'logstore_purge'),
        new lang_string('maxproctimehelp', 'logstore_purge'),
        '300', PARAM_INT));

    $settings->add(new admin_setting_configtext( 'logstore_purge/maxdeletions',
        new lang_string('maxdels', 'logstore_purge'),
        new lang_string('maxdelshelp', 'logstore_purge'),
        '10000', PARAM_INT));

/*
    $settings->add(new admin_setting_configtext( 'logstore_purge/intervalchunk',
        new lang_string('intervalchunk', 'logstore_purge'),
        new lang_string('intervalchunkhelp', 'logstore_purge'),
        '1', PARAM_INT));
*/
}

/*
    $healthurl = new moodle_url('/admin/tool/log/store/splunk/index.php', array('sesskey' => sesskey()));
    $ADMIN->add('reports', new admin_externalpage(
        'logstoresplunkhealth',
        new lang_string('reporttitle', 'logstore_splunk'),
        $healthurl,
        'moodle/site:config'
    ));

    $settings->add(new admin_setting_configtext(
        'logstore_splunk/servername',
        new lang_string('servername', 'logstore_splunk'),
        '', 'localhost', PARAM_HOST
    ));

    $settings->add(new admin_setting_configtext(
        'logstore_splunk/port',
        new lang_string('port', 'logstore_splunk'),
        '', '8089', PARAM_INT
    ));

    $settings->add(new admin_setting_configtext(
        'logstore_splunk/username',
        new lang_string('username'),
        '', 'admin', PARAM_ALPHANUMEXT
    ));

    $settings->add(new admin_setting_configpasswordunmask(
        'logstore_splunk/password',
        new lang_string('password'),
        '', '', PARAM_ALPHANUMEXT
    ));

    $settings->add(new admin_setting_configtext(
        'logstore_splunk/indexname',
        new lang_string('indexname', 'logstore_splunk'),
        '', 'moodle', PARAM_ALPHANUMEXT
    ));

    $settings->add(new admin_setting_configtext(
        'logstore_splunk/hostname',
        new lang_string('hostname', 'logstore_splunk'),
        '', gethostname(), PARAM_HOST
    ));

    $settings->add(new admin_setting_configtext(
        'logstore_splunk/source',
        new lang_string('source', 'logstore_splunk'),
        '', 'Moodle', PARAM_TEXT
    ));

    $settings->add(new admin_setting_configselect(
        'logstore_splunk/mode',
        new lang_string('mode', 'logstore_splunk'),
        '', 'realtime', array(
            'realtime' => new lang_string('realtime', 'logstore_splunk'),
            'background' => new lang_string('background', 'logstore_splunk')
        )));
*/
