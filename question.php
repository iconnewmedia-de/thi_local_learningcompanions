<?php
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/locallib.php";

require_login();
global $PAGE, $CFG, $OUTPUT, $USER;
$PAGE->set_context(\context_system::instance());
$PAGE->set_url($CFG->wwwroot . '/local/learningcompanions/question.php');
$defaultlayout = 'base';
$layout = optional_param('layout', $defaultlayout, PARAM_TEXT);
$layoutwhitelist = ['base', 'standard', 'course', 'incourse', 'popup', 'embedded'];
if (!in_array($layout, $layoutwhitelist)) {
    $layout = $defaultlayout;
}
$PAGE->set_pagelayout($layout);
$PAGE->set_title(get_string('learninggroups', 'local_learningcompanions'));
$questionid = required_param('questionid', PARAM_INT);
$PAGE->requires->js_call_amd('local_learningcompanions/learningcompanions_chat', 'init');

$PAGE->requires->js(new moodle_url('https://unpkg.com/react@18/umd/react.development.js'), true);
//$PAGE->requires->js(new moodle_url('https://unpkg.com/react@18.2.0/umd/react.production.min.js'), true);
$PAGE->requires->js(new moodle_url('https://unpkg.com/react-dom@18/umd/react-dom.development.js'), true);
//$PAGE->requires->js(new moodle_url('https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js'), true);
$PAGE->requires->js(new moodle_url('/local/learningcompanions/js/react/build/learningcompanions-chat.min.js'));

$chat = \local_learningcompanions\chat::createQuestionChat($questionid);

echo $OUTPUT->header();
echo $chat->get_question_chat_module();
echo $OUTPUT->footer();
