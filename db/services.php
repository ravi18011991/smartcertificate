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
 * smartcertificate external functions and service definitions.
 *
 * @package    mod_smartcertificate
 * @category   external
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(

    'mod_smartcertificate_get_smartcertificates_by_courses' => array(
        'classname'     => 'mod_smartcertificate_external',
        'methodname'    => 'get_smartcertificates_by_courses',
        'description'   => 'Returns a list of smartcertificate instances in a provided set of courses, if
                            no courses are provided then all the smartcertificate instances the user has access to will be returned.',
        'type'          => 'read',
        'capabilities'  => 'mod/smartcertificate:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE, 'local_mobile'),
    ),

    'mod_smartcertificate_view_smartcertificate' => array(
        'classname'     => 'mod_smartcertificate_external',
        'methodname'    => 'view_smartcertificate',
        'description'   => 'Trigger the course module viewed event and update the module completion status.',
        'type'          => 'write',
        'capabilities'  => 'mod/smartcertificate:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE, 'local_mobile'),
    ),

    'mod_smartcertificate_issue_smartcertificate' => array(
        'classname'     => 'mod_smartcertificate_external',
        'methodname'    => 'issue_smartcertificate',
        'description'   => 'Create new smartcertificate record, or return existing record for the current user.',
        'type'          => 'write',
        'capabilities'  => 'mod/smartcertificate:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE, 'local_mobile'),
    ),

    'mod_smartcertificate_get_issued_smartcertificates' => array(
        'classname'     => 'mod_smartcertificate_external',
        'methodname'    => 'get_issued_smartcertificates',
        'description'   => 'Get the list of issued smartcertificates for the current user.',
        'type'          => 'read',
        'capabilities'  => 'mod/smartcertificate:view',
        'services'      => array(MOODLE_OFFICIAL_MOBILE_SERVICE, 'local_mobile'),
    ),
);
