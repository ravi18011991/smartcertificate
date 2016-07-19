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
 * Language strings for the smartcertificate module
 *
 * @package    mod_smartcertificate
 * @copyright  Vidya Mantra EduSystems Pvt. Ltd.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['addlinklabel'] = 'Add another linked activity option';
$string['addlinktitle'] = 'Click to add another linked activity option';
$string['areaintro'] = 'Certificate introduction';
$string['awarded'] = 'Awarded';
$string['awardedto'] = 'Awarded To';
$string['back'] = 'Back';
$string['border'] = 'Border';
$string['borderblack'] = 'Black';
$string['borderblue'] = 'Blue';
$string['borderbrown'] = 'Brown';
$string['bordercolor'] = 'Border Lines';
$string['bordercolor_help'] = 'Since images can substantially increase the size of the pdf file, you may choose to print a border of lines instead of using a border image (be sure the Border Image option is set to No).  The Border Lines option will print a nice border of three lines of varying widths in the chosen color.';
$string['bordergreen'] = 'Green';
$string['borderlines'] = 'Lines';
$string['borderstyle'] = 'Border Image';
$string['borderstyle_help'] = 'The Border Image option allows you to choose a border image from the smartcertificate/pix/borders folder.  Select the border image that you want around the smartcertificate edges or select no border.';
$string['smartcertificate'] = 'Verification for smartcertificate code:';
$string['smartcertificate:addinstance'] = 'Add a smartcertificate instance';
$string['smartcertificate:manage'] = 'Manage a smartcertificate instance';
$string['smartcertificate:printteacher'] = 'Be listed as a teacher on the smartcertificate if the print teacher setting is on';
$string['smartcertificate:student'] = 'Retrieve a smartcertificate';
$string['smartcertificate:view'] = 'View a smartcertificate';
$string['smartcertificatename'] = 'Certificate Name';
$string['smartcertificatereport'] = 'Certificates Report';
$string['smartcertificatesfor'] = 'Certificates for';
$string['smartcertificatetype'] = 'Certificate Type';
$string['smartcertificatetype_help'] = 'This is where you determine the layout of the smartcertificate. The smartcertificate type folder includes four default smartcertificates:
A4 Embedded prints on A4 size paper with embedded font.
A4 Non-Embedded prints on A4 size paper without embedded fonts.
Letter Embedded prints on letter size paper with embedded font.
Letter Non-Embedded prints on letter size paper without embedded fonts.

The non-embedded types use the Helvetica and Times fonts.  If you feel your users will not have these fonts on their computer, or if your language uses characters or symbols that are not accommodated by the Helvetica and Times fonts, then choose an embedded type.  The embedded types use the Dejavusans and Dejavuserif fonts.  This will make the pdf files rather large; thus it is not recommended to use an embedded type unless you must.

New type folders can be added to the smartcertificate/type folder. The name of the folder and any new language strings for the new type must be added to the smartcertificate language file.';
$string['certify'] = 'This is to certify that';
$string['code'] = 'Code';
$string['completiondate'] = 'Course Completion';
$string['course'] = 'For';
$string['coursegrade'] = 'Course Grade';
$string['coursename'] = 'Course';
$string['coursetimereq'] = 'Required minutes in course';
$string['coursetimereq_help'] = 'Enter here the minimum amount of time, in minutes, that a student must be logged into the course before they will be able to receive the smartcertificate.';
$string['credithours'] = 'Credit Hours';
$string['customtext'] = 'Custom Text';
$string['customtext_help'] = 'If you want the smartcertificate to print different names for the teacher than those who are assigned
the role of teacher, do not select Print Teacher or any signature image except for the line image.  Enter the teacher names in this text box as you would like them to appear.  By default, this text is placed in the lower left of the smartcertificate. The following html tags are available: &lt;br&gt;, &lt;p&gt;, &lt;b&gt;, &lt;i&gt;, &lt;u&gt;, &lt;img&gt; (src and width (or height) are mandatory), &lt;a&gt; (href is mandatory), &lt;font&gt; (possible attributes are: color, (hex color code), face, (arial, times, courier, helvetica, symbol)).';
$string['date'] = 'On';
$string['datefmt'] = 'Date Format';
$string['datefmt_help'] = 'Choose a date format to print the date on the smartcertificate. Or, choose the last option to have the date printed in the format of the user\'s chosen language.';
$string['datehelp'] = 'Date';
$string['deletissuedsmartcertificates'] = 'Delete issued smartcertificates';
$string['delivery'] = 'Delivery';
$string['delivery_help'] = 'Choose here how you would like your students to get their smartcertificate.
Open in Browser: Opens the smartcertificate in a new browser window.
Force Download: Opens the browser file download window.
Email Certificate: Choosing this option sends the smartcertificate to the student as an email attachment.
After a user receives their smartcertificate, if they click on the smartcertificate link from the course homepage, they will see the date they received their smartcertificate and will be able to review their received smartcertificate.';
$string['designoptions'] = 'Design Options';
$string['download'] = 'Force download';
$string['emailsmartcertificate'] = 'Email';
$string['emailothers'] = 'Email Others';
$string['emailothers_help'] = 'Enter the email addresses here, separated by a comma, of those who should be alerted with an email whenever students receive a smartcertificate.';
$string['emailstudenttext'] = 'Attached is your smartcertificate for {$a->course}.';
$string['emailteachers'] = 'Email Teachers';
$string['emailteachers_help'] = 'If enabled, then teachers are alerted with an email whenever students receive a smartcertificate.';
$string['emailteachermail'] = '
{$a->student} has received their smartcertificate: \'{$a->smartcertificate}\'
for {$a->course}.

You can review it here:

    {$a->url}';
$string['emailteachermailhtml'] = '
{$a->student} has received their smartcertificate: \'<i>{$a->smartcertificate}</i>\'
for {$a->course}.

You can review it here:

    <a href="{$a->url}">Certificate Report</a>.';
$string['entercode'] = 'Enter smartcertificate code to verify:';
$string['fontsans'] = 'Sans-serif font family';
$string['fontsans_desc'] = 'Sans-serif font family for smartcertificates with embedded fonts';
$string['fontserif'] = 'Serif font family';
$string['fontserif_desc'] = 'Serif font family for smartcertificates with embedded fonts';
$string['getsmartcertificate'] = 'Get your certificate';
$string['grade'] = 'Grade';
$string['gradedate'] = 'Grade Date';
$string['gradefmt'] = 'Grade Format';
$string['gradefmt_help'] = 'There are three available formats if you choose to print a grade on the smartcertificate:

Percentage Grade: Prints the grade as a percentage.
Points Grade: Prints the point value of the grade.
Letter Grade: Prints the percentage grade as a letter.';
$string['gradeletter'] = 'Letter Grade';
$string['gradepercent'] = 'Percentage Grade';
$string['gradepoints'] = 'Points Grade';
$string['imagetype'] = 'Image Type';
$string['incompletemessage'] = 'In order to download your smartcertificate, you must first complete all required activities. Please return to the course to complete your coursework.';
$string['intro'] = 'Introduction';
$string['issueoptions'] = 'Issue Options';
$string['issued'] = 'Issued';
$string['issueddate'] = 'Date Issued';
$string['landscape'] = 'Landscape';
$string['lastviewed'] = 'You last received this smartcertificate on:';
$string['letter'] = 'Letter';
$string['lockingoptions'] = 'Locking Options';
$string['modulename'] = 'Smart Certificate';
$string['modulenameplural'] = 'Certificates';
$string['mysmartcertificates'] = 'My Certificates';
$string['nosmartcertificates'] = 'There are no smartcertificates';
$string['nosmartcertificatesissued'] = 'There are no smartcertificates that have been issued';
$string['nosmartcertificatesreceived'] = 'has not received any course smartcertificates.';
$string['nofileselected'] = 'Must choose a file to upload!';
$string['nogrades'] = 'No grades available';
$string['notapplicable'] = 'N/A';
$string['notfound'] = 'The smartcertificate number could not be validated.';
$string['notissued'] = 'Not Issued';
$string['notissuedyet'] = 'Not issued yet';
$string['notreceived'] = 'You have not received this smartcertificate';
$string['openbrowser'] = 'Open in new window';
$string['opendownload'] = 'Click the button below to save your smartcertificate to your computer.';
$string['openemail'] = 'Click the button below and your smartcertificate will be sent to you as an email attachment.';
$string['openwindow'] = 'Click the button below to open your certificate in a new browser window.';
$string['or'] = 'Or';
$string['orientation'] = 'Orientation';
$string['orientation_help'] = 'Choose whether you want your smartcertificate orientation to be portrait or landscape.';
$string['pluginadministration'] = 'Certificate administration';
$string['pluginname'] = 'Smart Certificate';
$string['portrait'] = 'Portrait';
$string['printdate'] = 'Print Date';
$string['printdate_help'] = 'This is the date that will be printed, if a print date is selected. If the course completion date is selected but the student has not completed the course, the date received will be printed. You can also choose to print the date based on when an activity was graded. If a smartcertificate is issued before that activity is graded, the date received will be printed.';
$string['printerfriendly'] = 'Printer-friendly page';
$string['printhours'] = 'Print Credit Hours';
$string['printhours_help'] = 'Enter here the number of credit hours to be printed on the smartcertificate.';
$string['printgrade'] = 'Print Grade';
$string['printgrade_help'] = 'You can choose any available course grade items from the gradebook to print the user\'s grade received for that item on the smartcertificate.  The grade items are listed in the order in which they appear in the gradebook. Choose the format of the grade below.';
$string['printnumber'] = 'Print Code';
$string['printnumber_help'] = 'A unique 10-digit code of random letters and numbers can be printed on the smartcertificate. This number can then be verified by comparing it to the code number displayed in the smartcertificates report.';
$string['printoutcome'] = 'Print Outcome';
$string['printoutcome_help'] = 'You can choose any course outcome to print the name of the outcome and the user\'s received outcome on the smartcertificate.  An example might be: Assignment Outcome: Proficient.';
$string['printseal'] = 'Seal or Logo Image';
$string['printseal_help'] = 'This option allows you to select a seal or logo to print on the smartcertificate from the smartcertificate/pix/seals folder. By default, this image is placed in the lower right corner of the smartcertificate.';
$string['printsignature'] = 'Signature Image';
$string['printsignature_help'] = 'This option allows you to print a signature image from the smartcertificate/pix/signatures folder.  You can print a graphic representation of a signature, or print a line for a written signature. By default, this image is placed in the lower left of the smartcertificate.';
$string['printteacher'] = 'Print Teacher Name(s)';
$string['printteacher_help'] = 'For printing the teacher name on the smartcertificate, set the role of teacher at the module level.  Do this if, for example, you have more than one teacher for the course or you have more than one smartcertificate in the course and you want to print different teacher names on each smartcertificate.  Click to edit the smartcertificate, then click on the Locally assigned roles tab.  Then assign the role of Teacher (editing teacher) to the smartcertificate (they do not HAVE to be a teacher in the course--you can assign that role to anyone).  Those names will be printed on the smartcertificate for teacher.';
$string['printwmark'] = 'Watermark Image';
$string['printwmark_help'] = 'A watermark file can be placed in the background of the smartcertificate. A watermark is a faded graphic. A watermark could be a logo, seal, crest, wording, or whatever you want to use as a graphic background.';
$string['receivedcerts'] = 'Received smartcertificates';
$string['receiveddate'] = 'Date Received';
$string['removecert'] = 'Issued smartcertificates removed';
$string['report'] = 'Report';
$string['reportcert'] = 'Report Certificates';
$string['reportcert_help'] = 'If you choose yes here, then this smartcertificate\'s date received, code number, and the course name will be shown on the user smartcertificate reports.  If you choose to print a grade on this smartcertificate, then that grade will also be shown on the smartcertificate report.';
$string['requiredtimenotmet'] = 'You must spend at least a minimum of {$a->requiredtime} minutes in the course before you can access this smartcertificate';
$string['requiredtimenotvalid'] = 'The required time must be a valid number greater than 0';
$string['reviewsmartcertificate'] = 'Review your smartcertificate';
$string['savecert'] = 'Save Certificates';
$string['savecert_help'] = 'If you choose this option, then a copy of each user\'s smartcertificate pdf file is saved in the course files moddata folder for that smartcertificate. A link to each user\'s saved smartcertificate will be displayed in the smartcertificate report.';
$string['seal'] = 'Seal';
$string['sigline'] = 'line';
$string['signature'] = 'Signature';
$string['statement'] = 'has completed the course';
$string['summaryofattempts'] = 'Summary of previously received certificates';
$string['textoptions'] = 'Text Options';
$string['title'] = 'CERTIFICATE of ACHIEVEMENT';
$string['to'] = 'Awarded to';
$string['typeA4_embedded'] = 'A4 Embedded';
$string['typeA4_non_embedded'] = 'A4 Non-Embedded';
$string['typeletter_embedded'] = 'Letter Embedded';
$string['typeletter_non_embedded'] = 'Letter Non-Embedded';
$string['unsupportedfiletype'] = 'File must be a jpeg or png file';
$string['manageinstitution'] = 'Linkedin Manage Institution:';
$string['manageinstitutiondesc'] = 'This button will take you to a new screen where you will be able to add valid linkedin registered institution in Smart Certificate records';
$string['companyname'] = 'Enter Company name';
$string['companyname_help'] = 'Select Your companyname from Linkedin Link first input box,then copy it and paste into Manage Institution company name textbox';
$string['url'] = 'Enter Complete URL';
$string['url_help'] = 'After filling Linkedin Link form ,then click on create button and then see below three textbox is popup you only copy the complete Url textbox and paste into Manage institution complete url textbox ';
$string['uploadimage'] = 'Upload image';
$string['uploadimagedesc'] = 'This button will take you to a new screen where you will be able to upload images.';
$string['userdateformat'] = 'User\'s Language Date Format';
$string['validate'] = 'Verify';
$string['verifysmartcertificate'] = 'Verify Certificate';
$string['viewsmartcertificateviews'] = 'View {$a} issued smartcertificates';
$string['viewed'] = 'You received this smartcertificate on:';
$string['viewtranscript'] = 'View Certificates';
$string['watermark'] = 'Watermark';
$string['smartcertificate_linkedin'] = 'Institute record firstly avialable in database please click below link for see status!';
$string['linkedin_registerted_inst'] = 'View Linkedin Registered Instt';
$string['listoflinkedin_registered_inst'] = 'List of Linkedin Registered Inst.';
$string['linkedinoption'] = 'Linkedin Option';
$string['linkedinoption_help'] = 'To Add linkedin functionality-first you need request to Administrator for insert registered institute on linkedin in smartcertificate database by admin setting page,Admin can directly access setting page via click of below help button.';
$string['linkedinoption_link'] = "$CFG->wwwroot/mod/smartcertificate/manage_institution.php";
$string['companyid'] = 'Select Institute';
$string['companyid_help'] = 'Select your Institute,which is running your certification course.if your institute is not avail in list then you need to contact administrator';
$string['certificationname'] = 'Certification Name';
$string['certificationname_help'] = 'Enter Your certification name such as - .NET,PHP,ORACLE,B-TECH,MCA,MBA etc';
$string['certificationurl'] = 'Certification URL';
$string['certificationurl_help'] = 'Enter valid certification URL of the website where your certification course is running';
$string['licensenumber'] = 'License Number';
$string['licensenumber_help'] = 'Enter valid license number of your certification course';
$string['defaultlinklist'] = "Go to setting Page";
$string['addlinkedin'] = 'ADD To Linkedin';
$string['linkedininstruction'] = 'To fill company name And complete URL you must click on the linkedin link given below and must follow the helpbutton of both input field';
$string['linkedinurl'] = 'https://addtoprofile.linkedin.com/cert';
$string['delete'] = 'Delete';
$string['selectcompany'] = 'Select Comapny Name';
$string['certificationnamevalidation'] = 'Please Enter Certification Name';
$string['checkcertificationnamevalidation'] = 'Please Enter Valid Certification Name';
$string['certificationurlvalidation'] = 'Please Enter Certification URL';
$string['checkcertificationurlisvalidation'] = 'Please Enter Valid Certification URL';
$string['licensenumbervalidation'] = 'Please Enter License Number';
$string['urlvalidation'] = 'Please Enter Valid Complete URL';
$string['companynamevalidation'] = 'Please Enter Valid Company Name';
$string['urlvalidationifempty'] = 'Please Enter Complete URL ';
$string['companynamevalidationifempty'] = 'Please Enter Company Name';
$string['enablecheckbox'] = 'Share With Linkedin';
$string['enablecheckbox_help'] = 'Enable checkbox for use linkedin functionality';
$string['linkedinlink'] = 'Linkedin Link';
$string['linkedinlink_help'] = 'Click given link for- fill company name And complete URL';
$string['delete'] = 'Delete';
$string['cancel'] = 'Cancel';
$string['deletecheckfull'] = 'Are you absolutely sure you want to completely delete the Institute record.';
$string['deletednot'] = 'Institute Record is not Deleted';
$string['deletecheckfullifissued'] = 'Are you absolutely sure you want to completely delete the Institute record because this institute already issued certificates';
$string['deleteinst'] = 'Delete Institute Record';
$string['editnotice'] = 'This certificate has been already issued, New changes will not effect over already issued certificates.';
$string['linkedinsetting'] = 'Linkedin Manage Institution';
$string['linkedinsetting_help'] = 'This button will take you to a new screen where you will be able to use linkedin functionality.';
$string['linkedinsettinglink'] = 'Linkedin Manage Institution';
$string['smartcertificate'] = 'Smart Certificate';
$string['linkdinregisinst'] = 'Linkedin Registerered Instt';
$string['inststatus'] = 'Sorry No Linkedin Registered Institute found in smart certificate Records,First registererd Linkedindin institute in smart certificate records via linkedin Manage Institution page';


