<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     local_learningcompanions
 * @category    string
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Learning Companions';
$string['learningcompanions:group_create'] = 'Create groups';
$string['learningcompanions:group_manage'] = 'Manage groups';
$string['adminareaname'] = 'Learning Companions';
$string['no_permission_create_group'] = 'You don\'t have the permission to create groups';
$string['failed_create_group'] = 'Unexpected error. Creating a new group failed with the error message: ';
$string['category_for_groups'] = 'Category for Groups';
$string['configcategory'] = 'Please select the category which shall hold the courses for each group';
$string['learningcompanions_settings'] = 'Local plugin learningcompanions';
$string['group-me-up'] = 'Group me up';
$string['button_bg_color'] = 'Button background color';
$string['configbuttonbg'] = 'Background color for the "group my up" button. Use CSS color syntax';
$string['button_text_color'] = 'Button text color';
$string['configbuttoncolor'] = 'Text color for the "group my up" button. Use CSS color syntax';
$string['button_radius'] = 'Button radius';
$string['configbuttonradius'] = 'Button radius for the "group my up" button in pixels.';
$string['creategroup'] = 'Create group';
$string['groupname'] = 'Group name';
$string['maxlengthwarning'] = 'You may only use up to {$a} characters';
$string['groupdescription'] = 'Group description';
$string['closedgroup'] = 'Closed group';
$string['closedgroup_help'] = 'With a closed group, people have to request permission to join. 
You will then have to decide for each request who may or may not join. 
Discussions of closed groups are only visible to group members.
Open groups can be joined by anyone and the discussions are visible to the public.';
$string['keywords'] = 'Keywords';
$string['nokeywords'] = 'No keywords chosen yet';
$string['error_group_creation_failed'] = 'Error: Group creation failed with message: "{$a}"';
$string['error_group_edit_failed'] = 'Error: Editing the group failed with message: "{$a}"';
$string['button_css_selector'] = 'CSS selector for group me up button';
$string['configbuttoncssselector'] = 'Group me up buttons will automatically get placed on elements that match this CSS selector';
$string['group_topic'] = 'Topic';
$string['coursecontext'] = 'Course context';
$string['nuggetcontext'] = 'Learning nugget context';
$string['group_image'] = 'Group image';
$string['group_description'] = 'Group description';

// Mentor
$string['myquestions'] = 'My questions';
$string['mentorquestions'] = 'Mentor questions';
$string['mymentorquestions'] = 'My mentor questions';
$string['allmentorquestions'] = 'Open questions related to my topics';
$string['title'] = 'Question title';
$string['topic'] = 'Topic';
$string['answers'] = 'Answers';
$string['lastactivity'] = 'Last activity';
$string['questiondate'] = 'Question date';
$string['noquestionsfound'] = 'No questions found.';
$string['asknewquestion'] = 'Ask new question';
$string['navbar_mentors'] = 'Mentors';
$string['navbar_mentorquestions'] = 'My questions';
$string['groupimage_maxbytes'] = 'Group image max filesize ';
$string['configgroupimagemaxbytes'] = 'Limits the file size of image files that users upload for the group image';

// Group


$string['datatables_url'] = $CFG->wwwroot . '/local/learningcompanions/lang/en/datatables.json';
