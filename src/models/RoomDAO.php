<?php

require_once __DIR__ . '/../database/Database.php';

class RoomDAO
{
    public static function findById($user_id,$room_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * FROM room_user WHERE user_id = :user_id AND room_id = :room_id');
        $stmt->execute([
            ':user_id' => $user_id,
            ':room_id' => $room_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createRoom($event_id, $user_id)
    {
        $db = (new Database())->getConnection();
        $stmt_1 = $db->prepare('INSERT INTO room (event_id,created_at) values (:event_id,NOW())');
        $stmt_1->bindParam(':event_id', $event_id);
        $check_1 = $stmt_1->execute();

        if (!$check_1) {
            error_log("Error INSERT room: " . implode(" | ", $stmt_1->errorInfo()));
            return false;
        }

        $room_id = $db->lastInsertId();

        $stmt_2 = $db->prepare('INSERT INTO room_user (room_id,user_id) values (:room_id,:user_id)');
        $check_2 = $stmt_2->execute([
            ':user_id' => $user_id,
            ':room_id' => $room_id
        ]);

        if (!$check_2) {
            error_log("Error INSERT room: " . implode(" | ", $stmt_2->errorInfo()));
            return false;
        }

        return $room_id;
    }

    public static function getRoomInfo() {}
}
