Smart Certificate module for Moodle
-------------------------------------
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/licenses/.

Description
-----------

The Smart Certificate module is used to generate PDF certificates for students in a course.Smart certificate consist of borders, watermarks, seals, signatures, outcomes, grades etc
to create effective certificate.Smart Certificate contain contents like -grade, signature, outcomes, border, seals etc that doesn’t change again after the first download of certificate.
In case mistakes are found in student certificate then students can request Administrator to allow them download latest updated certificate.
Smart Certifificate allow user to share certificate on their linkedin profile by just clicking the ‘Add Linkedin’ Button.
 
Requirements
------------

Moodle 2.9 +

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

Smart Certificate Setting
-------------------------

Smart Certificate Administration: 
--------------------------------

Go to the course where you want the Smart Certificate and turn editing On,  in the section you want the Smart Certificate, click 'Add an activity or resource' and then click the Smart Certificate button and click Add.

General
--------
 
Certificate Name:
-----------------
This is the standard name field. This name will appear on the homepage of the course, navigation menu and other places which will show or provide links to this Smart Certificate.

Description:
-----------
Describe the purpose.

Linkedin Option: 
----------------
Linkedin option is important feature of Smart certificate. Admin and teacher can use linkedin functionality as per their choice because it is optional. For using linkedin functionality
First-you need to go to Manage institution page in admin settings, Manage Institution page can only be accessed by admin. In case of teacher, they can request admin to Manage Institution

Manage Institution:
-------------------
In manage institution page we can see one linkedin link and two textbox namely-company name and complete Url . Linkedin link is only helpful for fill company name and complete url.
Follow the given steps below  to fill manage Institution’s input boxes.

Step 1 - Click on given linkedin link.

Step 2 - Select institute name from linkedin link first input box and then copy it and paste into Manage institution first text box namely enter company name.

Step 3-  Enter Certification name in linkedin link second input box namely Certification name. 

Step 4-  After filling of linkedin link form. You must click on create button of linkedin link form.

Step 5 - After click on create button we can see in below three text box is popup.then You copy only Complete URL text box and paste into manage institution 
complete Url text box and then click on save button.

Step 6- Similarly you can enter many Institute record in Smart Certificate database for provide Facility to make shareable certificate on linkedin profile of many 
certification course certificate of particular institute.

Step 7- After Filling Some record of manage institution form according to above instruction.Linkedin Option ready for usable. 
Now we can use linkedin functionality via Smart Certificate setting.go to Smart Certificate setting-

Share with Linkedin:
-------------------
Click on checkbox to use linkedin functionality. If you are not interested for it then simply disable the checkbox.

Select Institute:
-----------------
Select your Institute,which is running your certification course.if your institute is not available in list then you need to contact administrator

Certification name:
-------------------
Enter Your certification name such as - .NET,PHP,ORACLE,B-TECH,MCA,MBA etc

Certification URL:
------------------
Enter valid certification URL of the website where your certification course is running

License Number:
---------------
Enter valid license number of your certification course

Issue Options->
--------------

Email Teachers:
---------------
If enabled, then teachers are alerted with an email whenever students receive our certificate.

Email Others:
------------
Here,enter the email addresses of students who should be alerted with an email whenever students receive our certificate.

Delivery:
-----------
Admin and Teacher can Choose here how they would like their students to get their smart certificate such as- Certificate Opens in new browser window,Force Download.

Save Certificates:
------------------
If save certificate setting is enabled then all certificates get stored in moodledata.

Text Options:
------------
Text option of Smart Certificate provide facility for Admin and teacher to choose what text  be visible in pdf certificate such as-
Print date, Date format,Print code, Print grade,Grade format etc.

Design Options:
---------------
Design option of Smart Certificate provide many design option to make good looking Certificate.
Design option is-Certificate type, border image,border lines,water mark image,Signature image,logo seal etc.

Smart Certificate Search:
------------------------
Smart certificate search is also very important feature of smart certificate.Smart certificate search is admin tool to search any student’s certification record via student's username/name/certificate code. Admin can delete any student’s certification records to
allow student download their latest certificate. Normally admin can delete any student's certification record on request of student in case of mistakes in student’s certificate so that student can download their latest update certificate. 
For doing this go to - site administration / reports / Smart Certificate Search

Bugs/patches
------------
Feel free to send bug reports (and/or patches!)

For technical detail

Ravi Kumar ravi.kumar@vidyamantra.com

