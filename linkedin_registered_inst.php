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
 * Handles linkedin inst.
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot . '/mod/smartcertificate/locallib.php');
require_once($CFG->dirroot . '/mod/smartcertificate/manage_institution_form.php');
$delete = optional_param('delete', 0, PARAM_INT);
$confirm = optional_param('confirm', '', PARAM_ALPHANUM);
require_login();
admin_externalpage_setup('linkedin_registered_inst');
$sitecontext = context_system::instance();
$site = get_site();
require_capability('moodle/site:config', $sitecontext);
$listoflinkedinregisteredinst = get_string('listoflinkedin_registered_inst', 'smartcertificate');
$manageinstitution = get_string('manageinstitution', 'smartcertificate');
$PAGE->set_url('/admin/settings.php', array('section' => 'modsettingsmartcertificate'));
$PAGE->set_pagetype('admin-setting-modsettingsmartcertificate');
$PAGE->set_pagelayout('admin');
$PAGE->set_context($sitecontext);
$PAGE->set_title($listoflinkedinregisteredinst);
$PAGE->set_heading($SITE->fullname);
$PAGE->navbar->add($manageinstitution, new moodle_url('/mod/smartcertificate/manage_institution.php'));
$PAGE->navbar->add($listoflinkedinregisteredinst);

echo $OUTPUT->header();
$returnurl = new moodle_url('/mod/smartcertificate/linkedin_registered_inst.php');

if ($delete and confirm_sesskey()) {
    require_capability('mod/smartcertificate:delete', $sitecontext);
    // Delete inst record, after confirmation.
    $result = $DB->record_exists('smartcertificate', array('companyid' => $delete)); // This query check institute is issued certificates or not.
    if ($confirm != md5($delete)) {
        echo $OUTPUT->heading(get_string('deleteinst', 'smartcertificate'));
        $optionsyes = array('delete' => $delete, 'confirm' => md5($delete), 'sesskey' => sesskey());
        if ($result == TRUE) {
            echo $OUTPUT->confirm(get_string('deletecheckfullifissued', 'smartcertificate'), new moodle_url($returnurl, $optionsyes), $returnurl);
        } else {
            echo $OUTPUT->confirm(get_string('deletecheckfull', 'smartcertificate'), new moodle_url($returnurl, $optionsyes), $returnurl);
        }
        echo $OUTPUT->footer();
        die;
    } else if (data_submitted()) {
        if (smartcertificate_linkedin_del_instt($delete)) {
            \core\session\manager::gc(); // Remove stale sessions.
            redirect($returnurl);
        } else {
            \core\session\manager::gc(); // Remove stale sessions.
             $OUTPUT->notification($returnurl, get_string('deletednot', 'smartcertificate'));
        }
    }
}
$strdelete = get_string('delete');
$result = $DB->get_records('smartcertificate_linkedin');
$table = new html_table();
$table->head = array('Company Name', 'Delete Instt');
foreach ($result as $record) {
    // Display record.
    $companyname = $record->companyname;
    $id = $record->id;
    $link = html_writer::link(new moodle_url('/mod/smartcertificate/linkedin_registered_inst.php',
        array('delete' => $id, 'sesskey' => sesskey())),
        html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('t/delete'), 'alt' => $strdelete, 'class' => 'iconsmall')),
        array('title' => $strdelete));
    $table->data[] = array($companyname, $link);
}
if (!empty($result)) {
    echo html_writer::table($table);
} else {
    echo $OUTPUT->notification(get_string('inststatus', 'smartcertificate'));
}
echo $OUTPUT->footer();

