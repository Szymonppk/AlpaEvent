<?php

require_once __DIR__ . '/../database/Database.php';

class EventDAO
{
    public static function create_event($event, $user_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('
    INSERT INTO "event" (event_name, event_date, event_location, event_type, photo, description)
    VALUES (:event_name, :event_date, :event_location, :event_type, :photo, :description)
    ');

        $event_name = $event->getName();
        $event_date = $event->getDate();
        $event_location = $event->getLocation();
        $event_type = $event->getType();
        $photo = $event->getPhoto();
        $description = $event->getDescription();

        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':event_location', $event_location);
        $stmt->bindParam(':event_type', $event_type);
        $stmt->bindParam(':description', $description);
        $stmt->bindValue(':photo', $photo, PDO::PARAM_LOB);



        $check = $stmt->execute();


        if (!$check) {
            error_log("Error INSERT event: " . implode(" | ", $stmt->errorInfo()));
            return false;
        }

        $event_id = $db->lastInsertId('"Event_Event_ID_seq"');

        $stmt_2 = $db->prepare('INSERT into event_user (event_id,user_id) values (:event_id,:user_id)');

        $check_2 = $stmt_2->execute([
            ':event_id' => $event_id,
            ':user_id' => $user_id
        ]);


        if (!$check_2) {
            error_log("Error INSERT event_user: " . implode(" | ", $stmt_2->errorInfo()));
            return false;
        }

        return $event_id;
    }

    public static function get_events($user_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * from "event" e join event_user eu on e.event_id = eu.event_id where eu.user_id =:user_id');

        $success = $stmt->execute([
            ':user_id' => $user_id
        ]);

        if (!$success) {
            error_log("DAO: Błąd wykonania zapytania: " . implode(" | ", $stmt->errorInfo()));
            return false;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get_event_by_id($event_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * from "event" where event_id =:event_id');

        $success = $stmt->execute([
            ':event_id' => $event_id
        ]);

        if (!$success) {
            error_log("DAO: Błąd wykonania zapytania: " . implode(" | ", $stmt->errorInfo()));
            return false;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function add_user($user_id, $room_id)
    {
        $db = (new Database())->getConnection();

        $stmt_1 = $db->prepare("SELECT event_id from room where room_id = :room_id");

        $success_1 = $stmt_1->execute([
            ":room_id" => $room_id
        ]);

        if (!$success_1) {
            error_log("DAO: Błąd wykonania zapytania: " . implode(" | ", $stmt_1->errorInfo()));
            return false;
        }

        $event_id = $stmt_1->fetch(PDO::FETCH_NUM)[0];

        $stmt_2 = $db->prepare('INSERT into event_user (event_id,user_id) values (:event_id, :user_id)');

        $success_2 = $stmt_2->execute([
            ':event_id' => $event_id,
            ':user_id' => $user_id

        ]);

        if (!$success_2) {
            error_log("DAO: Błąd wykonania zapytania: " . implode(" | ", $stmt_2->errorInfo()));
            return false;
        }
    }

    public static function check_participant($user_id, $event_id)
    {
        $db = (new Database())->getConnection();
        $stmt_check = $db->prepare('SELECT 1 FROM event_user WHERE user_id = :user_id AND event_id = :event_id LIMIT 1');
        $stmt_check->execute([':user_id' => $user_id, ':event_id' => $event_id]);
        $exists = $stmt_check->fetchColumn();
        if ($exists) {
            
            error_log("User $user_id is already in event $event_id.");
            return true;  
        }
        else
        {
            return false;
        }
    }
    



}
