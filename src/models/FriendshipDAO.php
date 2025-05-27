<?php

require_once __DIR__ . '/../database/Database.php';

class FriendshipDAO
{

    public static function search_user($query) {
   

    $db = (new Database())->getConnection();
    $stmt = $db->prepare("SELECT user_id, username FROM alpa_user WHERE username ILIKE :query LIMIT 10");
    $stmt->bindParam(':query', $query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function add_friend($userId,$friendId) {
   
    $db = (new Database())->getConnection();

    $stmt = $db->prepare("INSERT INTO friendship (user_id, friend_id) VALUES (:userId, :friendId)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':friendId', $friendId);

    $stmt->execute();
    http_response_code(200);
}

public static function get_friends($userId)
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

public static function get_friends_data()
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

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}