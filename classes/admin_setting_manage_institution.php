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
 * manage institution on the settings page
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/adminlib.php');

/**
 * Class extends admin setting class to allow/process an uploaded file
 **/
class mod_smartcertificate_admin_setting_manage_institution extends admin_setting_configtext {
    public function __construct($name, $visiblename, $description, $defaultsetting) {
        parent::__construct($name, $visiblename, $description, $defaultsetting, PARAM_RAW, 50);
    }

    function output_html($data, $query='') {
        // Create a dummy var for this field.
        $this->config_write($this->name, '');

        return format_admin_setting($this, $this->visiblename,
            html_writer::link(new moodle_url('/mod/smartcertificate/manage_institution.php'), get_string('manageinstitution','smartcertificate')),
            $this->description, true, '', null, $query);
    }
}
