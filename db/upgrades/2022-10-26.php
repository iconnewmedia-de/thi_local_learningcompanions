<?php
defined('MOODLE_INTERNAL') || die();
global $DB;
if ($oldversion < 2022102601) {
    $dbman = $DB->get_manager();

// ##################### MODIFY TABLE lc_chat_comment
    $table = new xmldb_table('lc_chat_comment');
// ------------ add field 'flaggedby'
    $field = new xmldb_field('flaggedby');
    $field->set_attributes(XMLDB_TYPE_INTEGER, 10, NULL, false, false);
    $dbman->add_field($table, $field);

    upgrade_plugin_savepoint(true, 2022102601, 'local', 'learningcompanions');
}
