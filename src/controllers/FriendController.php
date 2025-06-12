<?php 

require_once "AppController.php";
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserDAO.php';
require_once __DIR__.'/../database/Database.php';
require_once __DIR__.'/../repository/FriendshipDAO.php';

class FriendController extends AppController {

public function search_user() {
    
    $data = json_decode(file_get_contents('php://input'), true);
    $query = '%' . $data['query'] . '%';

    $search_result = FriendshipDAO::search_user($query);

    echo json_encode($search_result);
}

public function add_friend() {
   

    $userId = $_SESSION['user']['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);
    $friendId = $data['friendId'];

    FriendshipDAO::add_friend($userId,$friendId);
}

public function get_friends()
{
    
   if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $userId = $_SESSION['user']['user_id'];

    $friends = FriendshipDAO::get_friends($userId);

    echo json_encode($friends);
}

public function get_friends_data($userId)
{
   
    $db = (new Database())->getConnection();

    $stmt = $db->prepare("
    SELECT u.user_id, u.username
    FROM alpa_user u
    JOIN friendship f ON (f.user_id = u.user_id OR f.friend_id = u.user_id)
    WHERE (f.user_id = :userId OR f.friend_id = :userId) AND u.user_id != :userId
    ");

    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
