<?php
namespace local_learningcompanions\mentor;
use local_learningcompanions\mentors;
defined('MOODLE_INTERNAL') || die();
require_once $CFG->dirroot . '/lib/formslib.php';
require_once __DIR__ . "/../locallib.php";
class mentor_question_form extends \moodleform {
    public function definition()
    {
        global $DB;
        $mform = $this->_form;
        $customdata = $this->_customdata;
        $mentorID =  $customdata['mentor'];
        if ($mentorID === 0) {
            // ICTODO: get all mentors for the topics of my courses and create a selector, including the option "all mentors"
            $mentorOptions = array(-1 => get_string('all_mentors', 'local_learningcompanions'));
            $mentors = mentors::get_mentors_of_users_courses();
            foreach($mentors as $mentor) {
                $mentorOptions[$mentor->id] = $mentor->firstname . " " . $mentor->lastname;
            }
            $mform->addElement('select', 'mentor', get_string('mentor', 'local_learningcompanions'), $mentorOptions);
        } else {
            $mentor = $DB->get_record('user', array('id' => $mentorID, 'deleted' => 0), '*', MUST_EXIST);
            $mentorname = \fullname($mentor);
            $mform->addElement('hidden', 'mentor', $mentorID);
            $mform->addElement('static', 'mentorname', get_string('mentor', 'local_learningcompanions'), $mentorname);
        }
        $userTopics = \local_learningcompanions\get_topics_of_user_courses();
        $mform->addElement('select', 'questiontopic', get_string('mentor_question_topic', 'local_learningcompanions'), $userTopics);
        $mform->setType('questiontopic', PARAM_TEXT);
        $mform->addElement('text', 'subject', get_string('mentor_question_subject', 'local_learningcompanions'));
        $mform->setType('subject', PARAM_TEXT);
        $mform->addRule('subject', 'required', 'required');
        $mform->addElement('editor', 'question', get_string('mentor_question_body', 'local_learningcompanions'));
        $mform->setType('question', PARAM_TEXT);
        $mform->addRule('question', 'required', 'required');
        $this->add_action_buttons(false, get_string('submit_question', 'local_learningcompanions'));
    }
}