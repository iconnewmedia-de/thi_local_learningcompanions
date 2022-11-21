<?phpnamespace local_learningcompanions;class chats {    public static function get_chat_of_group(int $groupid) {    }    public static function get_chat_of_activity(int $cmid) {    }    public static function get_all_chats_of_user() {    }    public static function get_all_chats_of_course() {    }    public static function post_comment($formdata, $chatid) {    }    public static function report_comment($commentid) {    }    public static function flag_comment($commentid) {        global $DB, $USER;        $comment = $DB->get_record('lc_chat_comment', array('id' => $commentid));        $comment->flagged = 1;        $comment->flaggedby = $USER->id;        $comment->timemodified = time();        return $DB->update_record('lc_chat_comment', $comment);    }    public static function unflag_comment($commentid) {        global $DB;        if ($comment = $DB->get_record('lc_chat_comment', array('id' => $commentid))) {            $comment->flagged = 0;            $comment->timemodified = time();            return $DB->update_record('lc_chat_comment', $comment);        }        return false;        // ICTODO: when comment gets unflagged, should field 'flaggedby' go NULL?    }    public static function delete_comment($commentid) {        global $DB, $USER;        return $DB->delete_records('lc_chat_comment', array('id' => $commentid));        // ICTODO: check if it's the user's own comment.        // ICTODO: if it's not the user's own comment:        //          check if the user has the right to delete other people's comments        //          and if the user is admin for the chat or mentor for the corresponding course    }    public static function get_all_flagged_comments(bool $extended = false, bool $cut = false): array {        global $CFG, $DB;        require_once($CFG->dirroot.'/local/learningcompanions/lib.php');        if ($comments = $DB->get_records('lc_chat_comment', array('flagged' => 1), 'timecreated')) {            $attachments = get_attachments_of_chat_comments($comments, 'attachment');            foreach ($comments as $comment) {                if (array_key_exists($comment->id, $attachments)) {                    $comment->attachments = $attachments;                } else {                    $comment->attachments = [];                }            }            if ($extended) {                return self::add_extended_fields_to_comments($comments, $cut);            }        }        return $comments;    }    public static function add_extended_fields_to_comments(array $comments, bool $cut = false): array {        global $CFG, $DB;        foreach($comments as $comment) {            $comment->author = $DB->get_record('user', array('id' => $comment->userid));            $comment->author_fullname = fullname($comment->author);            $comment->author_profileurl = $CFG->wwwroot.'/user/profile.php?id='.$comment->userid;            $comment->flaggedbyuser = $DB->get_record('user', array('id' => $comment->flaggedby));            $comment->flaggedbyuser_fullname = fullname($comment->flaggedbyuser);            $comment->flaggedbyuser_profileurl = $CFG->wwwroot.'/user/profile.php?id='.$comment->flaggedby;            $comment->commentdate = date('d.m.Y', $comment->timecreated);            $comment->relatedchat_url = $CFG->wwwroot;            $comment->origincomment = $comment->comment;            if ($cut && strlen($comment->comment) > 100) {                $comment->comment = substr($comment->comment, 0, 100).'...';                $comment->commentcut = true;            } else {                $comment->commentcut = false;            }        }        return $comments;    }    protected static function may_post_comment($chatid) {    }}