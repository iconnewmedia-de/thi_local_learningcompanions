<?php

require_once dirname(__DIR__, 2) . '/config.php';
require_once __DIR__ . "/locallib.php";

require_login();
global $PAGE, $CFG, $OUTPUT, $USER;
$PAGE->set_context(\context_system::instance());
$PAGE->set_url($CFG->wwwroot . '/local/learningcompanions/chat.php');
$defaultlayout = 'base';
$layout = optional_param('layout', $defaultlayout, PARAM_TEXT);
$layoutwhitelist = ['base', 'standard', 'course', 'incourse', 'popup', 'embedded'];
if (!in_array($layout, $layoutwhitelist)) {
    $layout = $defaultlayout;
}

$groupid = optional_param('groupid', null, PARAM_INT);
$group = new \local_learningcompanions\group($groupid);
$mayViewGroup = \local_learningcompanions\groups::may_view_group($groupid);
if ($group->closedgroup && !$mayViewGroup) {
    \local_learningcompanions\chat::redirectToOtherGroupChat();
}

$PAGE->set_pagelayout($layout);
$PAGE->set_title(get_string('learninggroups', 'local_learningcompanions'));
$groupid = optional_param('groupid', null, PARAM_INT);
$PAGE->requires->js_call_amd('local_learningcompanions/learningcompanions_chat', 'init');

//$PAGE->requires->js(new moodle_url('https://unpkg.com/react@18/umd/react.development.js'), true);
$PAGE->requires->js(new moodle_url('https://unpkg.com/react@18.2.0/umd/react.production.min.js'), true);
//$PAGE->requires->js(new moodle_url('https://unpkg.com/react-dom@18/umd/react-dom.development.js'), true);
$PAGE->requires->js(new moodle_url('https://unpkg.com/react-dom@18.2.0/umd/react-dom.production.min.js'), true);
$PAGE->requires->js(new moodle_url('/local/learningcompanions/js/react/build/learningcompanions-chat.min.js'));

$chat = \local_learningcompanions\chat::createGroupChat($groupid);

echo $OUTPUT->header();
if (isset($_POST['action'])) {
    // using switch/case just in case we might add further actions later.
    switch ($_POST['action']) {
        case "invite":
            \local_learningcompanions\invite_users();
            break;
        default:
            // nothing to do
    }
}
echo $chat->get_chat_module();
echo $OUTPUT->footer();
