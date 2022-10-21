<?phprequire_once __DIR__ . "/../../config.php";require_login();global $PAGE, $CFG, $OUTPUT;$PAGE->set_context(\context_system::instance());$PAGE->set_url($CFG->wwwroot . '/local/learningcompanions/creategroup.php');$defaultlayout = 'base';$layout = optional_param('layout', $defaultlayout, PARAM_TEXT);$layoutwhitelist = ['base', 'standard', 'course', 'incourse', 'popup', 'embedded'];if (!in_array($layout, $layoutwhitelist)) {    $layout = $defaultlayout;}$PAGE->set_pagelayout($layout);$PAGE->set_title(get_string('creategroup', 'local_learningcompanions'));echo $OUTPUT->header();$groupid = required_param('groupid', PARAM_INT);$group = \local_learningcompanions\groups::get_group_by_id($groupid);// ICTODO: check that the user has the permission to edit this grouprequire_once __DIR__ . "/group_form.php";$form = new \local_learningcompanions\group_form(    null,        [            'groupid' => $groupid,            'cmid' => $group->cmid,            'courseid' => $group->courseid        ]);$form->set_data($group);if ($data = $form->get_data()) {    try {        $groupid = \local_learningcompanions\groups::group_update(            $data->groupid,            $data->name,            $data->description,            $data->closedgroup,            $data->keywords        );        if ($layout === 'popup' || $layout === 'embedded') {            // ICTODO: close overlay        } else {            // ICTODO: redirect to group overview or course or group chat or so        }    } catch(Exception $e) {        $warning = new \core\output\notification(            get_string('error_group_edit_failed', 'local_learningcompanions', $e->getMessage()),            \core\output\notification::NOTIFY_ERROR        );    }    // ICTODO: handle exceptions and output a warning if exception thrown or groupid === false    // ICTODO: redirect user if everything went well and output a success message}echo $form->render();echo $OUTPUT->footer();