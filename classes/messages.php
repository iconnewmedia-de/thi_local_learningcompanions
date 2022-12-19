<?php

namespace local_learningcompanions;

use core\message\message;

class messages {
    private static function initNewMessage(string $messageName): message {
        $message = new \core\message\message();
        $message->component = 'local_learningcompanions';
        $message->notification = 1;
        $message->fullmessageformat = FORMAT_PLAIN;
        $message->name = $messageName;

        return $message;
    }

    public static function send_group_join_requested_notification(int $requestedUserId, int $recipientId, int $groupId) {
        global $DB;

        $requestedUser = $DB->get_record('user', ['id' => $requestedUserId]);
        $recipient = $DB->get_record('user', ['id' => $recipientId]);
        $group = new group($groupId);

        $message = self::initNewMessage('group_join_requested');
        $message->userfrom = $requestedUser;
        $message->userto = $recipient;
        $message->subject = get_string('message_group_join_requested_subject', 'local_learningcompanions');
        $message->fullmessage = get_string('message_group_join_requested_body', 'local_learningcompanions', [
            'receivername' => fullname($recipient),
            'groupname' => $group->name,
            'sendername' => fullname($requestedUser),
        ]);
        $message->fullmessagehtml = get_string('message_group_join_requested_body_html', 'local_learningcompanions', [
            'receivername' => fullname($recipient),
            'groupname' => $group->name,
            'sendername' => fullname($requestedUser)
        ]);
        $message->smallmessage = get_string('message_group_join_requested_small', 'local_learningcompanions', $group->name);
        $message->contexturl = (new \moodle_url('/local/learningcompanions/group/confirm_requested_join.php'))->out(false);
        $message->contexturlname = $group->name;

        message_send($message);
    }

    public static function send_appointed_to_admin_notification(int $newAdminId, int $groupId, int $appointedByUserId = null) {
        global $DB;

        $newAdmin = $DB->get_record('user', ['id' => $newAdminId]);
        $appointedBy = $DB->get_record('user', ['id' => $appointedByUserId]);
        $group = new group($groupId);

        $message = self::initNewMessage('appointed_to_admin');
        $message->userfrom = $appointedBy;
        $message->userto = $newAdmin;
        $message->subject = get_string('message_appointed_to_admin_subject', 'local_learningcompanions');
        $message->fullmessage = get_string('message_appointed_to_admin_body', 'local_learningcompanions', [
            'receivername' => fullname($newAdmin),
            'groupname' => $group->name,
            'sendername' => fullname($appointedBy),
        ]);
        $message->fullmessagehtml = get_string('message_appointed_to_admin_body_html', 'local_learningcompanions', [
            'receivername' => fullname($newAdmin),
            'groupname' => $group->name,
            'sendername' => fullname($appointedBy)
        ]);
        $message->smallmessage = get_string('message_appointed_to_admin_small', 'local_learningcompanions', $group->name);
        $message->contexturl = (new \moodle_url('/local/learningcompanions/chat.php', ['groupid' => $group->id]))->out(false);
        $message->contexturlname = $group->name;

        message_send($message);
    }

    public static function send_group_join_accepted_notification($userId, $groupId) {
        global $DB, $USER;

        $user = $DB->get_record('user', ['id' => $userId]);
        $group = new group($groupId);

        $message = self::initNewMessage('group_join_accepted');
        $message->userfrom = $USER;
        $message->userto = $user;
        $message->subject = get_string('message_group_join_accepted_subject', 'local_learningcompanions');
        $message->fullmessage = get_string('message_group_join_accepted_body', 'local_learningcompanions', [
            'receivername' => fullname($user),
            'groupname' => $group->name,
            'sendername' => fullname($USER),
        ]);
        $message->fullmessagehtml = get_string('message_group_join_accepted_body_html', 'local_learningcompanions', [
            'receivername' => fullname($user),
            'groupname' => $group->name,
            'sendername' => fullname($USER)
        ]);
        $message->smallmessage = get_string('message_group_join_accepted_small', 'local_learningcompanions', $group->name);
        $message->contexturl = (new \moodle_url('/local/learningcompanions/chat.php', ['groupid' => $group->id]))->out(false);
        $message->contexturlname = $group->name;

        message_send($message);
    }

    public static function send_group_join_denied_notification($userId, $groupId) {
        global $DB, $USER;

        $user = $DB->get_record('user', ['id' => $userId]);
        $group = new group($groupId);

        $message = self::initNewMessage('group_join_denied');
        $message->userfrom = $USER;
        $message->userto = $user;
        $message->subject = get_string('message_group_join_denied_subject', 'local_learningcompanions');
        $message->fullmessage = get_string('message_group_join_denied_body', 'local_learningcompanions', [
            'receivername' => fullname($user),
            'groupname' => $group->name,
            'sendername' => fullname($USER),
        ]);
        $message->fullmessagehtml = get_string('message_group_join_denied_body_html', 'local_learningcompanions', [
            'receivername' => fullname($user),
            'groupname' => $group->name,
            'sendername' => fullname($USER)
        ]);
        $message->smallmessage = get_string('message_group_join_denied_small', 'local_learningcompanions', $group->name);
        $message->contexturl = (new \moodle_url('/local/learningcompanions/chat.php', ['groupid' => $group->id]))->out(false);
        $message->contexturlname = $group->name;

        message_send($message);
    }

    public static function send_invited_to_group($userid, $groupid) {
        global $DB, $USER;

        $user = $DB->get_record('user', ['id' => $userid]);
        $group = new group($groupid);

        $message = self::initNewMessage('invited_to_group');
        $message->userfrom = $USER;
        $message->userto = $user;
        $message->subject = get_string('message_invited_to_group_subject', 'local_learningcompanions');
        $message->fullmessage = get_string('message_invited_to_group_body', 'local_learningcompanions', [
            'receivername' => fullname($user),
            'groupname' => $group->name,
            'sendername' => fullname($USER),
        ]);
        $message->fullmessagehtml = get_string('message_invited_to_group_body_html', 'local_learningcompanions', [
            'receivername' => fullname($user),
            'groupname' => $group->name,
            'sendername' => fullname($USER)
        ]);
        $message->smallmessage = get_string('message_invited_to_group_small', 'local_learningcompanions', $group->name);
        $message->contexturl = (new \moodle_url('/local/learningcompanions/chat.php', ['groupid' => $group->id]))->out(false);
        $message->contexturlname = $group->name;

        message_send($message);
    }
}
