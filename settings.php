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
 * Provides some custom settings for the smartcertificate module
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$modltifolder = new admin_category('modsmartcertificatefolder', new lang_string('pluginname', 'mod_smartcertificate'), $module->is_enabled() === false);
$ADMIN->add('modsettings', $modltifolder);
$ADMIN->add('modsmartcertificatefolder', $settings);
$ADMIN->add('modsmartcertificatefolder', new admin_externalpage('smartcertificatemanage_institution',
        get_string('linkedinsettinglink', 'smartcertificate'),
        new moodle_url("$CFG->wwwroot/mod/smartcertificate/manage_institution.php")));
$ADMIN->add('modsmartcertificatefolder', new admin_externalpage('linkedin_registered_inst',
        get_string('linkdinregisinst', 'smartcertificate'),
        new moodle_url("$CFG->wwwroot/mod/smartcertificate/linkedin_registered_inst.php")));

    foreach (core_plugin_manager::instance()->get_plugins_of_type('modsmartcertificate') as $plugin) {
   
    $plugin->load_settings($ADMIN, 'modsmartcertificatefolder', $hassiteconfig);
}
if ($ADMIN->fulltree) {
    
    $settings->add(new mod_smartcertificate_admin_setting_upload('smartcertificate/uploadimage',
        get_string('uploadimage', 'mod_smartcertificate'), get_string('uploadimagedesc', 'smartcertificate'), ''));

    $settings->add(new mod_smartcertificate_admin_setting_font('smartcertificate/fontsans',
        get_string('fontsans', 'mod_smartcertificate'), get_string('fontsans_desc', 'mod_smartcertificate'), 'freesans'));

    $settings->add(new mod_smartcertificate_admin_setting_font('smartcertificate/fontserif',
        get_string('fontserif', 'mod_smartcertificate'), get_string('fontserif_desc', 'mod_smartcertificate'), 'freeserif'));
   
}
$settings = null;

