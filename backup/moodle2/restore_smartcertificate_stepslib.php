<?php
// This file is part of the Smart Certificate module for Moodle - http://moodle.org/
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
 * @package    mod_smartcertificate
 * @subpackage backup-moodle2
 * @copyright Vidya Mantra EduSystems Pvt. Ltd.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Define all the restore steps that will be used by the restore_smartcertificate_activity_task
 */

/**
 * Structure step to restore one smartcertificate activity
 */
class restore_smartcertificate_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {

        $paths = array();
        $userinfo = $this->get_setting_value('userinfo');

        $paths[] = new restore_path_element('smartcertificate', '/activity/smartcertificate');

        if ($userinfo) {
            $paths[] = new restore_path_element('smartcertificate_issue', '/activity/smartcertificate/issues/issue');
        }

        // Return the paths wrapped into standard activity structure
        return $this->prepare_activity_structure($paths);
    }

    protected function process_smartcertificate($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();
        $data->timecreated = $this->apply_date_offset($data->timecreated);
        $data->timemodified = $this->apply_date_offset($data->timemodified);

        // insert the smartcertificate record
        $newitemid = $DB->insert_record('smartcertificate', $data);
        // immediately after inserting "activity" record, call this
        $this->apply_activity_instance($newitemid);
    }

    protected function process_smartcertificate_issue($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->smartcertificateid = $this->get_new_parentid('smartcertificate');
        $data->timecreated = $this->apply_date_offset($data->timecreated);
        if ($data->userid > 0) {
            $data->userid = $this->get_mappingid('user', $data->userid);
        }
     }

    protected function after_execute() {
        // Add smartcertificate related files, no need to match by itemname (just internally handled context)
        $this->add_related_files('mod_smartcertificate', 'issue', 'smartcertificate_issue');
    }
}
