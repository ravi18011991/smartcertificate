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
 * This page lists all the instances of smartcertificate in a particular course
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('locallib.php');

$id = required_param('id', PARAM_INT);           // Course Module ID

// Ensure that the course specified is valid
if (!$course = $DB->get_record('course', array('id'=> $id))) {
    print_error('Course ID is incorrect');
}

// Requires a login
require_login($course);

// Declare variables
$currentsection = "";
$printsection = "";
$timenow = time();

// Strings used multiple times
$strsmartcertificates = get_string('modulenameplural', 'smartcertificate');
$strissued  = get_string('issued', 'smartcertificate');
$strname  = get_string("name");
$strsectionname = get_string('sectionname', 'format_'.$course->format);

// Print the header
$PAGE->set_pagelayout('incourse');
$PAGE->set_url('/mod/smartcertificate/index.php', array('id'=>$course->id));
$PAGE->navbar->add($strsmartcertificates);
$PAGE->set_title($strsmartcertificates);
$PAGE->set_heading($course->fullname);

// Add the page view to the Moodle log
$event = \mod_smartcertificate\event\course_module_instance_list_viewed::create(array(
    'context' => context_course::instance($course->id)
));
$event->add_record_snapshot('course', $course);
$event->trigger();

// Get the smartcertificates, if there are none display a notice
if (!$smartcertificates = get_all_instances_in_course('smartcertificate', $course)) {
    echo $OUTPUT->header();
    notice(get_string('nosmartcertificates', 'smartcertificate'), "$CFG->wwwroot/course/view.php?id=$course->id");
    echo $OUTPUT->footer();
    exit();
}

$usesections = course_format_uses_sections($course->format);

$table = new html_table();

if ($usesections) {
    $table->head  = array ($strsectionname, $strname, $strissued);
} else {
    $table->head  = array ($strname, $strissued);
}

foreach ($smartcertificates as $smartcertificate) {
    if (!$smartcertificate->visible) {
        // Show dimmed if the mod is hidden
        $link = html_writer::tag('a', $smartcertificate->name, array('class' => 'dimmed',
            'href' => $CFG->wwwroot . '/mod/smartcertificate/view.php?id=' . $smartcertificate->coursemodule));
    } else {
        // Show normal if the mod is visible
        $link = html_writer::tag('a', $smartcertificate->name, array('class' => 'dimmed',
            'href' => $CFG->wwwroot . '/mod/smartcertificate/view.php?id=' . $smartcertificate->coursemodule));
    }

    $strsection = '';
    if ($smartcertificate->section != $currentsection) {
        if ($smartcertificate->section) {
            $strsection = get_section_name($course, $smartcertificate->section);
        }
        if ($currentsection !== '') {
            $table->data[] = 'hr';
        }
        $currentsection = $smartcertificate->section;
    }

    // Get the latest smartcertificate issue
    if ($certrecord = $DB->get_record('smartcertificate_issues', array('userid' => $USER->id, 'smartcertificateid' => $smartcertificate->id))) {
        $issued = userdate($certrecord->timecreated);
    } else {
        $issued = get_string('notreceived', 'smartcertificate');
    }

    if ($usesections) {
        $table->data[] = array ($strsection, $link, $issued);
    } else {
        $table->data[] = array ($link, $issued);
    }
}

echo $OUTPUT->header();
echo '<br />';
echo html_writer::table($table);
echo $OUTPUT->footer();
