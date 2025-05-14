<?php 

require_once "AppController.php";
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserDAO.php';
require_once __DIR__.'/../database/Database.php';

class FriendController extends AppController {

public function search_user() {
    $data = json_decode(file_get_contents('php://input'), true);
    $query = '%' . $data['query'] . '%';

    $db = (new Database())->getConnection();
    $stmt = $db->prepare("SELECT user_id, username FROM alpa_user WHERE username ILIKE :query LIMIT 10");
    $stmt->bindParam(':query', $query);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

public function add_friend() {
   

    $userId = $_SESSION['user']['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);
    $friendId = $data['friendId'];

    $db = (new Database())->getConnection();

    $stmt = $db->prepare("INSERT INTO friendship (user_id, friend_id) VALUES (:userId, :friendId)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':friendId', $friendId);

    $stmt->execute();
    http_response_code(200);
}

public function get_friends()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $userId = $_SESSION['user']['user_id'];

    $db = (new Database())->getConnection();

    $stmt = $db->prepare("
    SELECT u.user_id, u.username
    FROM alpa_user u
    JOIN friendship f ON (f.user_id = u.user_id OR f.friend_id = u.user_id)
    WHERE (f.user_id = :userId OR f.friend_id = :userId) AND u.user_id != :userId
    ");

    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}


}
