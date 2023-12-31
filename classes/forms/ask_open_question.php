<?php

namespace local_learningcompanions\forms;

use local_learningcompanions\groups;

global $CFG;
require_once $CFG->libdir . "/formslib.php";
require_once __DIR__ . "/../../locallib.php";

class ask_open_question extends \moodleform {
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('html', get_string('ask_open_question_description', 'local_learningcompanions'));
        $this->addTopic();
        $this->addSubject();
        $this->addQuestion();
        $this->add_action_buttons(false, get_string('ask_question', 'local_learningcompanions'));
    }

    private function addQuestion() {
        $mform = $this->_form;
        $mform->addElement('editor', 'question', get_string('question', 'local_learningcompanions'));
        $mform->setType('question', PARAM_TEXT);
        $mform->addRule('question', get_string('required'), 'required', null, 'client');
    }

    private function addSubject() {
        $mform = $this->_form;
        $mform->addElement('text', 'subject', get_string('subject', 'local_learningcompanions'));
        $mform->setType('subject', PARAM_TEXT);
        $mform->addRule('subject', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('subject', 'subject', 'local_learningcompanions');
    }

    private function addTopic() {
        global $USER;
        $mform = $this->_form;
        $userTopics = \local_learningcompanions\get_topics_of_user_courses($USER->id);
        $userTopics = array_combine($userTopics, $userTopics);
        // ICTODO: to be discussed - should the topics be related to groups? Mentors get their role based on their courses, not their groups
        $topics = array_merge([0 => get_string('please_choose', 'local_learningcompanions')], $userTopics);

        $mform->addElement('select', 'topic', get_string('topic', 'local_learningcompanions'), $topics);
        $mform->setType('topic', PARAM_TEXT);
        $mform->addRule('topic', 'required', 'required');
        $mform->addHelpButton('topic', 'topic', 'local_learningcompanions');
    }

    public function validation($data, $files)
    {
        $errors = parent::validation($data, $files);
        if ($data->topics == 0) {
            $errors['topic'] = get_string('please_choose_a_topic', 'local_learningcompanions');
        }
        return $errors;
    }
}
