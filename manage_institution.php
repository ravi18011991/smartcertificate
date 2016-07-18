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
 * Handles Manage Institution.
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot . '/mod/smartcertificate/locallib.php');
require_once($CFG->dirroot . '/mod/smartcertificate/manage_institution_form.php');

require_login();
admin_externalpage_setup('smartcertificatemanage_institution');
$context = context_system::instance();
require_capability('moodle/site:config', $context);
$manageinstitution = get_string('manageinstitution', 'smartcertificate');

$PAGE->set_url('/admin/settings.php', array('section' => 'modsettingsmartcertificate'));
$PAGE->set_pagetype('admin-setting-modsettingsmartcertificate');
$PAGE->set_pagelayout('admin');
$PAGE->set_context($context);
$PAGE->set_title($manageinstitution);
$PAGE->set_heading($SITE->fullname);
$PAGE->navbar->add($manageinstitution);

$mform = new mod_smartcertificate_manage_institution_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/mod/smartcertificate/manage_institution.php'));
} else if ($fromform = $mform->get_data()) {

    $data = new stdClass();
    $data->companyname = $fromform->companyname;
    $completeurl = $fromform->url;
    $extracted = strstr($completeurl, 'CertificationName', true);
    $completeed = strstr($extracted, '?_ed');
    $data->completeurl = $completeed;
    $result = $DB->get_record_sql('SELECT * FROM {smartcertificate_linkedin} WHERE companyname = :companyname AND completeurl =  :completeurl',
        array('companyname' => $data->companyname, 'completeurl' => $data->completeurl));
    if (empty($result)) {
        $smartcertificatelinkedin = $DB->insert_record('smartcertificate_linkedin', $data);
        redirect(new moodle_url('/mod/smartcertificate/linkedin_registered_inst.php'));
    } else {
        echo $reply = $fromform->reply;
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('manageinstitution', 'smartcertificate'));
echo get_string('linkedininstruction', 'smartcertificate');
echo $mform->display();
echo $OUTPUT->footer();
