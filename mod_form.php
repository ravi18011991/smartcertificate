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
 * Instance add/edit form
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->dirroot . '/course/moodleform_mod.php');
require_once($CFG->dirroot . '/mod/smartcertificate/locallib.php');

class mod_smartcertificate_mod_form extends moodleform_mod {

    public function definition() {
        global $CFG, $DB;
        $mform = & $this->_form;
        if (isset($_GET['update'])) {
            $id = required_param('update', PARAM_INT);
            $isdownload = smartcertificate_is_certificate_downloads($id);
            if (!empty($isdownload)) {
                $msg = get_string('editnotice', 'smartcertificate');
                $mform->addElement('static', 'notice', '', html_writer::tag('div', $msg, array('style' => 'text-align:justify', 'style' => 'background-color: #ffc')));
            }
        }
        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('smartcertificatename', 'smartcertificate'), array('size' => '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');

        $this->standard_intro_elements(get_string('intro', 'smartcertificate'));
        // Linkedin option Input Field.
        $comapnyname = smartcertificate_get_linkedin_instt();
        if (!empty($comapnyname)) {

            $mform->addElement('header', 'linkedinoption', get_string('linkedinoption', 'smartcertificate'));
            $name = get_string('enablecheckbox', 'smartcertificate');
            $mform->addElement('advcheckbox', 'linkedincheckbox', $name);
            $mform->addHelpButton('linkedincheckbox', 'enablecheckbox', 'smartcertificate');
            $mform->setDefault('linkedincheckbox', 0);
            $mform->addElement('select', 'companyid', get_string('companyid', 'smartcertificate'), $comapnyname);
            $mform->setDefault('companyid', 0);
            $mform->disabledIf('companyid', 'linkedincheckbox', 'notchecked');
            $mform->addHelpButton('companyid', 'companyid', 'smartcertificate');
            $mform->addElement('text', 'certificationname', get_string('certificationname', 'smartcertificate'));
            $mform->setType('certificationname', PARAM_CLEANHTML);
            $mform->disabledIf('certificationname', 'linkedincheckbox', 'notchecked');
            $mform->addHelpButton('certificationname', 'certificationname', 'smartcertificate');
            $mform->addElement('text', 'certificationurl', get_string('certificationurl', 'smartcertificate'));
            $mform->setType('certificationurl', PARAM_CLEANHTML);
            $mform->disabledIf('certificationurl', 'linkedincheckbox', 'notchecked');
            $mform->addHelpButton('certificationurl', 'certificationurl', 'smartcertificate');
            $mform->addElement('text', 'licensenumber', get_string('licensenumber', 'smartcertificate'));
            $mform->setType('licensenumber', PARAM_CLEANHTML);
            $mform->disabledIf('licensenumber', 'linkedincheckbox', 'notchecked');
            $mform->addHelpButton('licensenumber', 'licensenumber', 'smartcertificate');
        } else {
            $mform->addElement('header', 'linkedinoption', get_string('linkedinoption', 'smartcertificate'));
            $mform->addElement('static', 'linkedinsetting', get_string('linkedinsetting', 'smartcertificate'), 
                html_writer::link(new moodle_url("$CFG->wwwroot/mod/smartcertificate/manage_institution.php"),
                get_string('linkedinsettinglink', 'smartcertificate')));
            $mform->addHelpButton('linkedinsetting', 'linkedinsetting', 'smartcertificate');
        }
        // Issue options.

        $mform->addElement('header', 'issueoptions', get_string('issueoptions', 'smartcertificate'));
        $ynoptions = array(1 => get_string('yes'));
        $mform->addElement('select', 'emailteachers', get_string('emailteachers', 'smartcertificate'), $ynoptions);
        $mform->setDefault('emailteachers', 0);
        $mform->addHelpButton('emailteachers', 'emailteachers', 'smartcertificate');

        $mform->addElement('text', 'emailothers', get_string('emailothers', 'smartcertificate'), array('size' => '40', 'maxsize' => '200'));
        $mform->setType('emailothers', PARAM_TEXT);
        $mform->addHelpButton('emailothers', 'emailothers', 'smartcertificate');

        $deliveryoptions = array(0 => get_string('openbrowser', 'smartcertificate'),
            1 => get_string('download', 'smartcertificate'),
            2 => get_string('emailsmartcertificate', 'smartcertificate'));
        $mform->addElement('select', 'delivery', get_string('delivery', 'smartcertificate'), $deliveryoptions);
        $mform->setDefault('delivery', 0);
        $mform->addHelpButton('delivery', 'delivery', 'smartcertificate');

        $mform->addElement('select', 'savecert', get_string('savecert', 'smartcertificate'), $ynoptions);
        $mform->setDefault('savecert', 1);
        $mform->addHelpButton('savecert', 'savecert', 'smartcertificate');

        $reportfile = "$CFG->dirroot/smartcertificates/index.php";
        if (file_exists($reportfile)) {
            $mform->addElement('select', 'reportcert', get_string('reportcert', 'smartcertificate'), $ynoptions);
            $mform->setDefault('reportcert', 0);
            $mform->addHelpButton('reportcert', 'reportcert', 'smartcertificate');
        }

        $mform->addElement('text', 'requiredtime', get_string('coursetimereq', 'smartcertificate'), array('size' => '3'));
        $mform->setType('requiredtime', PARAM_INT);
        $mform->addHelpButton('requiredtime', 'coursetimereq', 'smartcertificate');

        // Text Options.
        $mform->addElement('header', 'textoptions', get_string('textoptions', 'smartcertificate'));

        $modules = smartcertificate_get_mods();
        $dateoptions = smartcertificate_get_date_options() + $modules;
        $mform->addElement('select', 'printdate', get_string('printdate', 'smartcertificate'), $dateoptions);
        $mform->setDefault('printdate', 'N');
        $mform->addHelpButton('printdate', 'printdate', 'smartcertificate');

        $dateformatoptions = array(1 => 'January 1, 2000', 2 => 'January 1st, 2000', 3 => '1 January 2000',
            4 => 'January 2000', 5 => get_string('userdateformat', 'smartcertificate'));
        $mform->addElement('select', 'datefmt', get_string('datefmt', 'smartcertificate'), $dateformatoptions);
        $mform->setDefault('datefmt', 0);
        $mform->addHelpButton('datefmt', 'datefmt', 'smartcertificate');

        $mform->addElement('select', 'printnumber', get_string('printnumber', 'smartcertificate'), $ynoptions);
        $mform->setDefault('printnumber', 0);
        $mform->addHelpButton('printnumber', 'printnumber', 'smartcertificate');

        $gradeoptions = smartcertificate_get_grade_options() + smartcertificate_get_grade_categories($this->current->course) + $modules;
        $mform->addElement('select', 'printgrade', get_string('printgrade', 'smartcertificate'), $gradeoptions);
        $mform->setDefault('printgrade', 0);
        $mform->addHelpButton('printgrade', 'printgrade', 'smartcertificate');

        $gradeformatoptions = array(1 => get_string('gradepercent', 'smartcertificate'), 2 => get_string('gradepoints', 'smartcertificate'),
            3 => get_string('gradeletter', 'smartcertificate'));
        $mform->addElement('select', 'gradefmt', get_string('gradefmt', 'smartcertificate'), $gradeformatoptions);
        $mform->setDefault('gradefmt', 0);
        $mform->addHelpButton('gradefmt', 'gradefmt', 'smartcertificate');

        $outcomeoptions = smartcertificate_get_outcomes();
        $mform->addElement('select', 'printoutcome', get_string('printoutcome', 'smartcertificate'), $outcomeoptions);
        $mform->setDefault('printoutcome', 0);
        $mform->addHelpButton('printoutcome', 'printoutcome', 'smartcertificate');

        $mform->addElement('text', 'printhours', get_string('printhours', 'smartcertificate'), array('size' => '5', 'maxlength' => '255'));
        $mform->setType('printhours', PARAM_TEXT);
        $mform->addHelpButton('printhours', 'printhours', 'smartcertificate');

        $mform->addElement('select', 'printteacher', get_string('printteacher', 'smartcertificate'), $ynoptions);
        $mform->setDefault('printteacher', 0);
        $mform->addHelpButton('printteacher', 'printteacher', 'smartcertificate');

        $mform->addElement('textarea', 'customtext', get_string('customtext', 'smartcertificate'), array('cols' => '40', 'rows' => '4', 'wrap' => 'virtual'));
        $mform->setType('customtext', PARAM_RAW);
        $mform->addHelpButton('customtext', 'customtext', 'smartcertificate');

        // Design Options.
        $mform->addElement('header', 'designoptions', get_string('designoptions', 'smartcertificate'));
        $mform->addElement('select', 'smartcertificatetype', get_string('smartcertificatetype', 'smartcertificate'), smartcertificate_types());
        $mform->setDefault('smartcertificatetype', 'A4_non_embedded');
        $mform->addHelpButton('smartcertificatetype', 'smartcertificatetype', 'smartcertificate');

        $orientation = array('L' => get_string('landscape', 'smartcertificate'), 'P' => get_string('portrait', 'smartcertificate'));
        $mform->addElement('select', 'orientation', get_string('orientation', 'smartcertificate'), $orientation);
        $mform->setDefault('orientation', 'L');
        $mform->addHelpButton('orientation', 'orientation', 'smartcertificate');

        $mform->addElement('select', 'borderstyle', get_string('borderstyle', 'smartcertificate'), smartcertificate_get_images(CERT_IMAGE_BORDER));
        $mform->setDefault('borderstyle', '0');
        $mform->addHelpButton('borderstyle', 'borderstyle', 'smartcertificate');

        $printframe = array(0 => get_string('no'), 1 => get_string('borderblack', 'smartcertificate'), 2 => get_string('borderbrown', 'smartcertificate'),
            3 => get_string('borderblue', 'smartcertificate'), 4 => get_string('bordergreen', 'smartcertificate'));
        $mform->addElement('select', 'bordercolor', get_string('bordercolor', 'smartcertificate'), $printframe);
        $mform->setDefault('bordercolor', '0');
        $mform->addHelpButton('bordercolor', 'bordercolor', 'smartcertificate');

        $mform->addElement('select', 'printwmark', get_string('printwmark', 'smartcertificate'), smartcertificate_get_images(CERT_IMAGE_WATERMARK));
        $mform->setDefault('printwmark', '0');
        $mform->addHelpButton('printwmark', 'printwmark', 'smartcertificate');

        $mform->addElement('select', 'printsignature', get_string('printsignature', 'smartcertificate'), smartcertificate_get_images(CERT_IMAGE_SIGNATURE));
        $mform->setDefault('printsignature', '0');
        $mform->addHelpButton('printsignature', 'printsignature', 'smartcertificate');

        $mform->addElement('select', 'printseal', get_string('printseal', 'smartcertificate'), smartcertificate_get_images(CERT_IMAGE_SEAL));
        $mform->setDefault('printseal', '0');
        $mform->addHelpButton('printseal', 'printseal', 'smartcertificate');

        $this->standard_coursemodule_elements();

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

        // Check that the required time entered is valid
        if ((!is_number($data['requiredtime']) || $data['requiredtime'] < 0)) {
            $errors['requiredtime'] = get_string('requiredtimenotvalid', 'smartcertificate');
        }
        // Here set validation for each inputfield of linkedin.
        $comapnyname = smartcertificate_get_linkedin_instt();
        if (!empty($comapnyname)) {  // Check this condition for prevent errors during installation-if linkedin_instt table is empty.
            if ($data['linkedincheckbox'] == 1) {
                if ($data['companyid']) {
                    if ($data['companyid']) {
                        if (empty($data['certificationname'])) {
                            $errors['certificationname'] = get_string('certificationnamevalidation', 'smartcertificate');
                        }
                        if (!empty($data['certificationname'])) {
                            if (is_number($data['certificationname'])) {
                                $errors['certificationname'] = get_string('checkcertificationnamevalidation', 'smartcertificate');
                            }
                        }
                        if (empty($data['certificationurl'])) {

                            $errors['certificationurl'] = get_string('certificationurlvalidation', 'smartcertificate');
                        }
                        if (!empty($data['certificationurl'])) {
                            if (filter_var($data['certificationurl'], FILTER_VALIDATE_URL) === false) {
                                $errors['certificationurl'] = get_string('checkcertificationurlisvalidation', 'smartcertificate');
                            }
                        }
                        if (empty($data['licensenumber'])) {

                            $errors['licensenumber'] = get_string('licensenumbervalidation', 'smartcertificate');
                        }
                    }
                }
            }
        }
        return $errors;
    }

}
