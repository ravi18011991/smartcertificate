Smart Certificate module for Moodle
-------------------------------------
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.

Description
-----------

Smart Certificate module is used to generate PDF certificates for student in a course.

Smart Certificate has grade, signature, outcomes, border, seals etc that would not change after the first download of certificate. 
If mistakes are found in student certificate then students can request to administrator(by message, chat, phone etc) 
to allow them for download latest updated certificate. Smart Certificate allow user to share certificate on their linkedin profile by just clicking the ‘Add Linkedin’ Button.

Its various attributes like  borders, watermarks, seals, signatures, outcomes, grades etc make smart certificate more effective.

Requirements
------------

Moodle 3.0 +

Installation
------------
1- Unpack the "moodle-mod_smartcertificate.zip" and rename that unzipped folder to "smartcertificate" and place this folder into 'mod' directory of moodle. 
The file structure for Smartcertificate    would be something like. [site-root]/mod/smartcertificate

Visit Settings > Site Administration > Notifications, You should find the module's tables successfully created

Dependencies 
------------

2- To run "smartcertificate" module you need to add another plugin named "smartcertificatesearch" found at "https://github.com/ravi18011991/smartcertificatesearch". 
Locate this folder 'smartcertificatesearch' into 'admin/tool' directory of moodle

File structure for Smartcertificatesearch would be. [site-root]/admin/tool/smartcertificatesearch

3- Visit the admin notification page to trigger the database installation by [site-root] > Site administration > Notifications

How to use Smart Certificate:
----------------------------
Click On Link "https://github.com/ravi18011991/smartcertificate/wiki/How-to-Use-Smart-Certificate".

Bugs/patches
------------
Feel free to send bug reports (and/or patches!)

For technical detail

Ravi Kumar ravi.kumar@vidyamantra.com

