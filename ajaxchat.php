<?phpheader("Access-Control-Allow-Origin: *");header("Access-Control-Allow-Headers: *");require_once(__DIR__ . "/../../config.php");require_once(__DIR__ . "/classes/chatrender.php");require_login();$chat = new blocks\learningcompanions_chat\chatrender(1);$posts = $chat->get_posts();echo json_encode(["posts" => $posts]);