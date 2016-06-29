Smart Certificate module for Moodle
------------------------------
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.

Description

The Smart Certificate module is used to generate PDF certificates for students in a course.Smart certificate consist of borders, watermarks, seals, signatures, outcomes, grades etc
to create effective certificate.Smart Certificate contain contents like -grade, signature, outcomes, border, seals etc that doesn’t change again after the first download of certificate.
In case mistakes are found in student certificate then students can request Administrator to allow them download latest updated certificate.
Smart Certifificate allow user to share certificate on their linkedin profile by just clicking the ‘Add Linkedin’ Button.
 
Requirements
------------

Moodle 2.9 +

Installation
------------
1- Unpack the "moodle-mod_smartcertificate.zip" and rename that unzipped folder to "smartcertificate" and place this folder into 'mod' directory of moodle. The file structure for Smartcertificate would be something like. [site-root]/mod/smartcertificate

Visit Settings > Site Administration > Notifications, You should find the module's tables successfully created

Dependencies
------------

2- To run "smartcertificate" module you need to add another plugin named "smartcertificatesearch" found at "https://github.com/vidyamantra/moodle-tool_smartcertificatesearch". Locate this folder 'smartcertificatesearch' into 'admin/tool' directory of moodle

File structure for Smartcertificatesearch would be. [site-root]/admin/tool/smartcertificatesearch

3- Visit the admin notification page to trigger the database installation by [site-root] > Site administration > Notifications

Bugs/patches
------------

Feel free to send bug reports (and/or patches!)

For technical detail

Ravi Kumar ravi.kumar@vidyamantra.com

