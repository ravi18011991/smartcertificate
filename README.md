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

Administrative Setting of Smart Certificate:
--------------------------------------------

After installation of smart certificate user can configure settings of smart certificate according to himself. 
But to use linkedin functionality of smart certificate,configuration of Smart certificate is necessary.To  configure smart Certificate settings you must 
go to  Site Administration -> Plugins -> Activity Modules -> Smart certificate. Smart certificate have three types of settings  such as-

1. Smart Certificate:
---------------------
Smart certificate setting provide facility to user to select font and certificate border according to himself.
	            
2. Linkedin Manage Institution:
------------------------------- 
User can use linkedin functionality as per their choice because it is optional. For using linkedin functionality follow the below given description.      

In manage institution page we can see one “Linkedin Link” and two field namely-”Enter Company Name” and “Enter Complete URL” . 
Linkedin link is only helpful for fill company name and complete url.Follow the given steps below to fill manage Institution’s input boxes.

Step 1- First Click on given "https://addtoprofile.linkedin.com/cert" Linkedin Link.

Step 2- You need to enter the registered company name, If you have already registered company/institute in linkedin account,
        just type your company name in first input box which shows your company in drop down list, just select your company from this list.

Step 3- Enter Certification name in field “Certification name” second input box.

Step 4- Now click on ‘Create Button’

Step 5- After clicking the 'Create button',you can see three input boxes at right side under heading “Grab your code”.

Step 6- Copy the company name just you selected in step 2 above, and paste this into field “Enter Company Name” 
        in setting page of Linkedin Manage Institution of smartcertificate module.

Step 7- Copy the url/content from Complete URL field under heading “Grab your code” at right side in below,and paste this into 
        “Enter Complete URL” field of Linkedin  Manage Institution of smartcertificate module.                       
Note :
----
Particular institute provides the facility to share various course certification certificate on user’s linkedin profile. 
Now you are ready to use linkedin feature of smart certificate.

3. Linkedin Registered Instt:
-----------------------------
Linkedin Registered instt setting provide facility to user to see all linkedin registered Institute which are in 
smart certificate records and user can delete any institute from Smart Certificate records.  

Smart Certificate Setting:
-------------------------
Smart Certificate Administration:
---------------------------------
Go to the course where you want the Smart Certificate and turn editing On. In the section you want the Smart Certificate, 
click 'Add an activity or resource' and select and add Smart Certificate.

General->
----------
Certificate Name:
----------------
This is the standard name field. This name will appear on the course page, navigation menu and other places which will show or provide links to this Smart Certificate.

Introduction:
--------------
You can describe the purpose of certificate and basis on which the same is being issued.

Linkedin Option->
-----------------
Linkedin option is important feature of Smart certificate and User can use linkedin functionality as per their choice because it is optional. 
To use linkedin functionality,  first  of all user  need to configure smart certificate’s linkedin Manage Institution setting according instructions under the administrative setting description(you can get it on top).
Admin can also directly configure linkedin Manage Institution setting just click on  “Linkedin Mange institution Link” . After configuration of Linkedin Manage institution setting we can use as-

Share with Linkedin:
------------------- 

Click on checkbox to use linkedin functionality. If you are not interested for it then simply disable the checkbox.

Select Institute:  
----------------
Select your Institute, which does running your certification course. 

Certification name:
--------------------
Enter Your certification name, for example .NET, PHP, ORACLE, B-TECH, MCA, MBA etc.

Certification URL:
------------------

Enter certification URL of course you are running.

License Number:
---------------

Enter license number of your certification course.

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
Design option of Smart Certificate provide many design option to make good looking Certificate.Design option is-Certificate type, border image,border lines,water mark image,Signature image,logo seal etc.

Now you save your settings by clicking Save Button.You can get the certificate and share the certificate on linkedin by Clicking the button ‘ADD to Linkedin’ if it linkedin options was enabled earlier.

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

