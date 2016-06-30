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
 * Handles viewing a Smart Certificate
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once("../../config.php");
require_once("$CFG->dirroot/mod/smartcertificate/locallib.php");
require_once("$CFG->libdir/pdflib.php");

$id = required_param('id', PARAM_INT); // Course Module ID.
$action = optional_param('action', '', PARAM_ALPHA);
$edit = optional_param('edit', -1, PARAM_BOOL);

if (!$cm = get_coursemodule_from_id('smartcertificate', $id)) {
    print_error('Course Module ID was incorrect');
}
if (!$course = $DB->get_record('course', array('id' => $cm->course))) {
    print_error('course is misconfigured');
}
if (!$smartcertificate = $DB->get_record('smartcertificate', array('id' => $cm->instance))) {
    print_error('course module is incorrect');
}

require_login($course, false, $cm);
$context = context_module::instance($cm->id);

require_capability('mod/smartcertificate:view', $context);

$event = \mod_smartcertificate\event\course_module_viewed::create(array(
            'objectid' => $smartcertificate->id,
            'context' => $context,
        ));
$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('smartcertificate', $smartcertificate);
$event->trigger();

$completion = new completion_info($course);
$completion->set_module_viewed($cm);

// Initialize $PAGE, compute blocks.
$PAGE->set_url('/mod/smartcertificate/view.php', array('id' => $cm->id));
$PAGE->set_context($context);
$PAGE->set_cm($cm);
$PAGE->set_title(format_string($smartcertificate->name));
$PAGE->set_heading(format_string($course->fullname));

if (($edit != -1) and $PAGE->user_allowed_editing()) {
    $USER->editing = $edit;
}

// Add block editing button.
if ($PAGE->user_allowed_editing()) {
    $editvalue = $PAGE->user_is_editing() ? 'off' : 'on';
    $strsubmit = $PAGE->user_is_editing() ? get_string('blockseditoff') : get_string('blocksediton');
    $url = new moodle_url($CFG->wwwroot . '/mod/smartcertificate/view.php', array('id' => $cm->id, 'edit' => $editvalue));
    $PAGE->set_button($OUTPUT->single_button($url, $strsubmit));
}

// Check if the user can view the smartcertificate.
if ($smartcertificate->requiredtime && !has_capability('mod/smartcertificate:manage', $context)) {
    if (smartcertificate_get_course_time($course->id) < ($smartcertificate->requiredtime * 60)) {
        $a = new stdClass;
        $a->requiredtime = $smartcertificate->requiredtime;
        notice(get_string('requiredtimenotmet', 'smartcertificate', $a), "$CFG->wwwroot/course/view.php?id=$course->id");
        die;
    }
}
if (!$DB->get_record('smartcertificate_issues', array('userid' => $USER->id, 'smartcertificateid' => $smartcertificate->id))) {
    // Create new smartcertificate record, or return existing record.
    $certrecord = smartcertificate_get_issue($course, $USER, $smartcertificate, $cm);

    make_cache_directory('tcpdf');

    // Load the specific smartcertificate type.
    require("$CFG->dirroot/mod/smartcertificate/type/$smartcertificate->smartcertificatetype/smartcertificate.php");
    // No debugging here, sorry.
    $CFG->debugdisplay = 0;
    @ini_set('display_errors', '0');
    @ini_set('log_errors', '1');

    $filename = smartcertificate_get_smartcertificate_filename($smartcertificate, $cm, $course) . '.pdf';

    // PDF contents are now in $file_contents as a string.
    $filecontents = $pdf->Output('', 'S');

    if ($smartcertificate->savecert == 1) { // Save pdf certificate in moodledata.
        smartcertificate_save_pdf($filecontents, $certrecord->id, $filename, $context->id);
    }
}
if (empty($action)) {
    echo $OUTPUT->header();

    $viewurl = new moodle_url('/mod/smartcertificate/view.php', array('id' => $cm->id));
    groups_print_activity_menu($cm, $viewurl);
    $currentgroup = groups_get_activity_group($cm);
    $groupmode = groups_get_activity_groupmode($cm);

    if (has_capability('mod/smartcertificate:manage', $context)) {
        $numusers = count(smartcertificate_get_issues($smartcertificate->id, 'ci.timecreated ASC', $groupmode, $cm));
        $url = html_writer::tag('a', get_string('viewsmartcertificateviews', 'smartcertificate', $numusers),
            array('href' => $CFG->wwwroot . '/mod/smartcertificate/report.php?id=' . $cm->id));
        echo html_writer::tag('div', $url, array('class' => 'reportlink'));
    }

    if (!empty($smartcertificate->intro)) {
        echo $OUTPUT->box(format_module_intro('smartcertificate', $smartcertificate, $cm->id), 'generalbox', 'intro');
    }

    if ($attempts = smartcertificate_get_attempts($smartcertificate->id)) {
        echo smartcertificate_print_attempts($course, $smartcertificate, $attempts);
    }
    if ($smartcertificate->delivery == 0) {
        $str = get_string('openwindow', 'smartcertificate');
    } if ($smartcertificate->delivery == 1) {
        $str = get_string('opendownload', 'smartcertificate');
    } if ($smartcertificate->delivery == 2) {
        $str = get_string('openemail', 'smartcertificate');
    }
    echo html_writer::tag('p', $str, array('style' => 'text-align:center'));
    $linkname = get_string('getsmartcertificate', 'smartcertificate');

    $link = new moodle_url('/mod/smartcertificate/view.php?id=' . $cm->id . '&action=get');
    $button = new single_button($link, $linkname);
    if ($smartcertificate->delivery != 1) {
        $button->add_action(new popup_action('click', $link, 'view' . $cm->id, array('height' => 600, 'width' => 800)));
    }

    echo html_writer::tag('div', $OUTPUT->render($button), array('style' => 'text-align:center'));

    // Linkedin share button.
    echo smartcertificate_linkedin($smartcertificate, $cm);


    echo $OUTPUT->footer($course);
    exit;
} else {
    if ($smartcertificate->delivery == 1) { // Forcely download, fetch certificate from moodledata.
        $path = get_smartcertificate_path($smartcertificate, $USER->id, $context->id, $cm, $course);
        $filename = "$COURSE->fullname.pdf";
        header('Content-Transfer-Encoding: binary');  // For Gecko browsers mainly.
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
        header('Accept-Ranges: bytes');  // For download resume.
        header('Content-Length: ' . filesize($path));  // File size.
        header('Content-Encoding: none');
        header('Content-Type: application/pdf');  // Change this mime type if the file is not PDF.
        header('Content-Disposition: attachment; filename=' . $filename);  // Make the browser display the Save As dialog.
        readfile($path);  // This is necessary in order to get it to actually download the file, otherwise it will be 0Kb.
    } else { // Open new tab.
        $path = get_smartcertificate_path($smartcertificate, $USER->id, $context->id, $cm, $course);

        header("Pragma: public");
        header("Expires: 0");
        header("Content-type: $contenttype");
        header('Cache-Control: private', false);
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header("Content-Disposition: inline; filename=\"$filename\"");
        header('Content-Transfer-Encoding: binary');
        header('Content-Length' . filesize($path));
        ob_clean();
        flush();
        readfile($path);
    }
}
