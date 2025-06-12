<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/EventDAO.php';

class RoomDAO
{
    public static function findById($user_id, $room_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT e.* FROM room_user ru join room r on r.room_id = ru.room_id join event e on e.event_id = r.event_id WHERE ru.user_id = :user_id AND ru.room_id = :room_id');
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

    public static function getFirstRoom($user_id, $event_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT ru.room_id FROM room_user ru join room r on ru.room_id=r.room_id join event_user eu on ru.user_id = eu.user_id WHERE r.event_id = :event_id and ru.user_id = :user_id order by ru.room_id desc limit 1');
        $stmt->execute([
            ':user_id' => $user_id,
            ':event_id' => $event_id
        ]);


        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function add_user($user_id, $room_id)
    {
        error_log("RoomDAO");
        $db = (new Database())->getConnection();

        $stmt = $db->prepare('INSERT into room_user (room_id,user_id) values (:room_id,:user_id)');

        $success = $stmt->execute([
            ':room_id' => $room_id,
            ':user_id' => $user_id

        ]);

        if (!$success) {
            error_log("DAO: Błąd wykonania zapytania: " . implode(" | ", $stmt->errorInfo()));
            return false;
        }
    }

    public static function get_participants($room_id)
    {
        $db = (new Database())->getConnection();

        $stmt = $db->prepare('SELECT * from alpa_user u join room_user ru on ru.user_id = u.user_id where room_id = :room_id');

        $success = $stmt->execute([
            ':room_id' => $room_id,

        ]);

        if (!$success) {
            error_log("DAO: Error: " . implode(" | ", $stmt->errorInfo()));
            return false;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get_photos($room_id)
    {
        $db = (new Database())->getConnection();
        $stmt_1 = $db->prepare('SELECT gallery_id from gallery where room_id=:room_id');

        $success = $stmt_1->execute([
            ":room_id" => $room_id
        ]);

        if (!$success) {
            error_log("DAO: Error: " . implode(" | ", $stmt_1->errorInfo()));
            return false;
        }

        $gallery_id = $stmt_1->fetchColumn();

        $stmt_2 = $db->prepare("SELECT target_path from photo where gallery_id = :gallery_id");

        $success_2 = $stmt_2->execute([
            ":gallery_id" => $gallery_id
        ]);

        if (!$success_2) {
            error_log("DAO: Error: " . implode(" | ", $stmt_2->errorInfo()));
            return false;
        }

        return $stmt_2->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addPlanPoint()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            $roomId = $input['roomId'] ?? null;
            $planText = $input['planText'] ?? null;

            if ($roomId && $planText) {
                $db = (new Database())->getConnection();
                $stmt = $db->prepare('INSERT INTO event_plan_item (room_id, content) VALUES (:roomId, :planText)');
                $stmt->execute([
                    ':roomId' => $roomId,
                    ':planText' => $planText
                ]);

                $planId = $db->lastInsertId();
                echo json_encode(['status' => 'success', 'planId' => $planId]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing data']);
            }
        }
    }

    public static function deletePlanPoint()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            $planId = $input['planId'] ?? null;

            if ($planId) {
                $db = (new Database())->getConnection();
                $stmt = $db->prepare('DELETE FROM event_plan_item WHERE event_plan_item_id = :planId');
                $stmt->execute([':planId' => $planId]);

                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing planId']);
            }
        }
    }

    public static function getPlans()
    {
        header('Content-Type: application/json');

        $roomId = $_GET['roomId'] ?? null;

        if (!$roomId) {
            echo json_encode(['status' => 'error', 'message' => 'Missing roomId']);
            return;
        }

        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * FROM event_plan_item WHERE room_id = :roomId');
        $stmt->execute([':roomId' => $roomId]);

        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'plans' => $plans]);
    }
}
