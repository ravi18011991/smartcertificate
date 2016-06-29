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
 * Certificate module core interaction API
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Add smartcertificate instance.
 *
 * @param stdClass $smartcertificate
 * @return int new smartcertificate instance id
 */
function smartcertificate_add_instance($smartcertificate) {
    global $DB;

    // Create the smartcertificate.
    $smartcertificate->timecreated = time();
    $smartcertificate->timemodified = $smartcertificate->timecreated;

    return $DB->insert_record('smartcertificate', $smartcertificate);
}
/*testing by ravi kumar */
function get_pathname_hash($contextid, $component, $filearea, $itemid, $filepath, $filename) {
        return sha1("/$contextid/$component/$filearea/$itemid".$filepath.$filename);
}
/**
 * Update smartcertificate instance.
 *
 * @param stdClass $smartcertificate
 * @return bool true
 */
function smartcertificate_update_instance($smartcertificate) {
    global $DB;

    // Update the smartcertificate.
    $smartcertificate->timemodified = time();
    $smartcertificate->id = $smartcertificate->instance;

    return $DB->update_record('smartcertificate', $smartcertificate);
}

/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id
 * @return bool true if successful
 */
function smartcertificate_delete_instance($id) {
    global $DB;

    // Ensure the smartcertificate exists
    if (!$smartcertificate = $DB->get_record('smartcertificate', array('id' => $id))) {
        return false;
    }

    // Prepare file record object
    if (!$cm = get_coursemodule_from_instance('smartcertificate', $id)) {
        return false;
    }

    $result = true;
    $DB->delete_records('smartcertificate_issues', array('smartcertificateid' => $id));
    if (!$DB->delete_records('smartcertificate', array('id' => $id))) {
        $result = false;
    }

    // Delete any files associated with the smartcertificate
    $context = context_module::instance($cm->id);
    $fs = get_file_storage();
    $fs->delete_area_files($context->id);

    return $result;
}

/**
 * This function is used by the reset_course_userdata function in moodlelib.
 * This function will remove all posts from the specified smartcertificate
 * and clean up any related data.
 *
 * Written by Jean-Michel Vedrine
 *
 * @param $data the data submitted from the reset course.
 * @return array status array
 */
function smartcertificate_reset_userdata($data) {
    global $DB;

    $componentstr = get_string('modulenameplural', 'smartcertificate');
    $status = array();

    if (!empty($data->reset_smartcertificate)) {
        $sql = "SELECT cert.id
                  FROM {smartcertificate} cert
                 WHERE cert.course = :courseid";
        $params = array('courseid' => $data->courseid);
        $smartcertificates = $DB->get_records_sql($sql, $params);
        $fs = get_file_storage();
        if ($smartcertificates) {
            foreach ($smartcertificates as $certid => $unused) {
                if (!$cm = get_coursemodule_from_instance('smartcertificate', $certid)) {
                    continue;
                }
                $context = context_module::instance($cm->id);
                $fs->delete_area_files($context->id, 'mod_smartcertificate', 'issue');
            }
        }

        $DB->delete_records_select('smartcertificate_issues', "smartcertificateid IN ($sql)", $params);
        $status[] = array('component' => $componentstr, 'item' => get_string('removecert', 'smartcertificate'), 'error' => false);
    }
    // Updating dates - shift may be negative too
    if ($data->timeshift) {
        shift_course_mod_dates('smartcertificate', array('timeopen', 'timeclose'), $data->timeshift, $data->courseid);
        $status[] = array('component' => $componentstr, 'item' => get_string('datechanged'), 'error' => false);
    }

    return $status;
}

/**
 * Implementation of the function for printing the form elements that control
 * whether the course reset functionality affects the smartcertificate.
 *
 * Written by Jean-Michel Vedrine
 *
 * @param $mform form passed by reference
 */
function smartcertificate_reset_course_form_definition(&$mform) {
    $mform->addElement('header', 'smartcertificateheader', get_string('modulenameplural', 'smartcertificate'));
    $mform->addElement('advcheckbox', 'reset_smartcertificate', get_string('deletissuedsmartcertificates', 'smartcertificate'));
}

/**
 * Course reset form defaults.
 *
 * Written by Jean-Michel Vedrine
 *
 * @param stdClass $course
 * @return array
 */
function smartcertificate_reset_course_form_defaults($course) {
    return array('reset_smartcertificate' => 1);
}

/**
 * Returns information about received smartcertificate.
 * Used for user activity reports.
 *
 * @param stdClass $course
 * @param stdClass $user
 * @param stdClass $mod
 * @param stdClass $smartcertificate
 * @return stdClass the user outline object
 */
function smartcertificate_user_outline($course, $user, $mod, $smartcertificate) {
    global $DB;

    $result = new stdClass;
    if ($issue = $DB->get_record('smartcertificate_issues', array('smartcertificateid' => $smartcertificate->id, 'userid' => $user->id))) {
        $result->info = get_string('issued', 'smartcertificate');
        $result->time = $issue->timecreated;
    } else {
        $result->info = get_string('notissued', 'smartcertificate');
    }

    return $result;
}

/**
 * Returns information about received smartcertificate.
 * Used for user activity reports.
 *
 * @param stdClass $course
 * @param stdClass $user
 * @param stdClass $mod
 * @param stdClass $smartcertificate
 * @return string the user complete information
 */
function smartcertificate_user_complete($course, $user, $mod, $smartcertificate) {
    global $DB, $OUTPUT, $CFG;
    require_once($CFG->dirroot.'/mod/smartcertificate/locallib.php');

    if ($issue = $DB->get_record('smartcertificate_issues', array('smartcertificateid' => $smartcertificate->id, 'userid' => $user->id))) {
        echo $OUTPUT->box_start();
        echo get_string('issued', 'smartcertificate') . ": ";
        echo userdate($issue->timecreated);
        $cm = get_coursemodule_from_instance('smartcertificate', $smartcertificate->id, $course->id);
        smartcertificate_print_user_files($smartcertificate, $user->id, context_module::instance($cm->id)->id);
        echo '<br />';
        echo $OUTPUT->box_end();
    } else {
        print_string('notissuedyet', 'smartcertificate');
    }
}

/**
 * Must return an array of user records (all data) who are participants
 * for a given instance of smartcertificate.
 *
 * @param int $smartcertificateid
 * @return stdClass list of participants
 */
function smartcertificate_get_participants($smartcertificateid) {
    global $DB;

    $sql = "SELECT DISTINCT u.id, u.id
              FROM {user} u, {smartcertificate_issues} a
             WHERE a.smartcertificateid = :smartcertificateid
               AND u.id = a.userid";
    return  $DB->get_records_sql($sql, array('smartcertificateid' => $smartcertificateid));
}

/**
 * @uses FEATURE_GROUPS
 * @uses FEATURE_GROUPINGS
 * @uses FEATURE_GROUPMEMBERSONLY
 * @uses FEATURE_MOD_INTRO
 * @uses FEATURE_COMPLETION_TRACKS_VIEWS
 * @uses FEATURE_GRADE_HAS_GRADE
 * @uses FEATURE_GRADE_OUTCOMES
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, null if doesn't know
 */
function smartcertificate_supports($feature) {
    switch ($feature) {
        case FEATURE_GROUPS:                  return true;
        case FEATURE_GROUPINGS:               return true;
        case FEATURE_GROUPMEMBERSONLY:        return true;
        case FEATURE_MOD_INTRO:               return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        case FEATURE_BACKUP_MOODLE2:          return true;

        default: return null;
    }
}

/**
 * Serves smartcertificate issues and other files.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @return bool|nothing false if file not found, does not return anything if found - just send the file
 */
function smartcertificate_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload) {
    global $CFG, $DB, $USER;

    if ($context->contextlevel != CONTEXT_MODULE) {
        return false;
    }

    if (!$smartcertificate = $DB->get_record('smartcertificate', array('id' => $cm->instance))) {
        return false;
    }

    require_login($course, false, $cm);

    require_once($CFG->libdir.'/filelib.php');

    if ($filearea === 'issue') {
        $certrecord = (int)array_shift($args);

        if (!$certrecord = $DB->get_record('smartcertificate_issues', array('id' => $certrecord))) {
            return false;
        }

        if ($USER->id != $certrecord->userid and !has_capability('mod/smartcertificate:manage', $context)) {
            return false;
        }

        $relativepath = implode('/', $args);
        $fullpath = "/{$context->id}/mod_smartcertificate/issue/$certrecord->id/$relativepath";

        $fs = get_file_storage();
        if (!$file = $fs->get_file_by_hash(sha1($fullpath)) or $file->is_directory()) {
            return false;
        }
        send_stored_file($file, 0, 0, true); // download MUST be forced - security!
    }
}

/**
 * Used for course participation report (in case smartcertificate is added).
 *
 * @return array
 */
function smartcertificate_get_view_actions() {
    return array('view', 'view all', 'view report');
}

/**
 * Used for course participation report (in case smartcertificate is added).
 *
 * @return array
 */
function smartcertificate_get_post_actions() {
    return array('received');
}
