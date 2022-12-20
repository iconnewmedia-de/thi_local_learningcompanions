<?php
require_once __DIR__ . "/../../config.php";
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
$PAGE->set_pagelayout($layout);
$PAGE->set_title(get_string('learninggroups', 'local_learningcompanions'));
$groupid = optional_param('groupid', 1, PARAM_INT); // ictodo: change default, or maybe remove this completely, or make it required, ...
$cmid = optional_param('cmid', 0, PARAM_INT);
$courseid = optional_param('courseid', 0, PARAM_INT);
$PAGE->requires->js_call_amd('local_learningcompanions/learningcompanions_chat', 'init');

echo $OUTPUT->header();
//$reactscript = \local_learningcompanions\get_chat_reactscript_path();
$chat = new \local_learningcompanions\chat($groupid);
echo $chat->get_chat_module();
//$context = array(
//    'userid' => $USER->id,
//    'reactscript' => $reactscript,
//    'form' => 'here be submission form'
//);
//echo $OUTPUT->render_from_template('local_learningcompanions/chat', $context);
echo $OUTPUT->footer();
