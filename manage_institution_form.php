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
 * ADD Manage Insititution
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/mod/smartcertificate/locallib.php');

class mod_smartcertificate_manage_institution_form extends moodleform {

    public function definition() {
        global $CFG;

        $mform = & $this->_form;
        $linkcontent = '<a href= "https://addtoprofile.linkedin.com/cert" target = "_blank"> https://addtoprofile.linkedin.com/cert </a>';
        $mform->addElement('static', 'linkedinlink', get_string('linkedinlink', 'smartcertificate'), $linkcontent);
        $mform->addHelpButton('linkedinlink', 'linkedinlink', 'smartcertificate');
        $mform->addElement('text', 'companyname', get_string('companyname', 'smartcertificate'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('companyname', PARAM_TEXT);
        } else {
            $mform->setType('companyname', PARAM_CLEANHTML);
        }
        $mform->setDefault('companyname', '');
        $mform->addHelpButton('companyname', 'companyname', 'smartcertificate');
        $mform->addElement('text', 'url', get_string('url', 'smartcertificate'));
        $mform->setType('url', PARAM_CLEANHTML);
        $mform->setDefault('url', '');
        $mform->addHelpButton('url', 'url', 'smartcertificate');
        $mform->addElement('hidden', 'reply', get_string('smartcertificate_linkedin', 'smartcertificate'));
        $mform->setType('reply', PARAM_CLEANHTML);
        $this->add_action_buttons();
    }


    /**
     * Some basic validation
     *
     * @param $data
     * @param $files
     * @return array
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        if (empty($data['companyname'])) {
            $errors['companyname'] = get_string('companynamevalidationifempty', 'smartcertificate');
        }
        if (!empty($data['companyname'])) {
            if (is_number($data['companyname'])) {
                $errors['companyname'] = get_string('companynamevalidation', 'smartcertificate');
            }
        }
        if (empty($data['url'])) {
            $errors['url'] = get_string('urlvalidationifempty', 'smartcertificate');
        }

        if (!empty($data['url'])) {
            if ($data['url'] !== strstr($data['url'], 'https://www.linkedin.com/profile/add?_ed=') && $data['url'] !== strstr($data['url'], 'CertificationName')) {

                $errors['url'] = get_string('urlvalidation', 'smartcertificate');
            }
        }

        return $errors;
    }

}
