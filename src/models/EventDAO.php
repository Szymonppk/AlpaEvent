<?php

require_once __DIR__ . '/../database/Database.php';

class EventDAO
{
    public static function create_event($event, $user_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('
    INSERT INTO event (event_name, event_date, event_location, event_type, photo, description)
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
        $stmt->bindParam(':photo', $photo, PDO::PARAM_LOB);



        $check = $stmt->execute();


        if (!$check) {
            error_log("Błąd INSERT event: " . implode(" | ", $stmt->errorInfo()));
            return false;
        }

        $event_id = $db->lastInsertId('"Event_Event_ID_seq"');

        $stmt_2 = $db->prepare('INSERT into event_user (event_id,user_id) values (:event_id,:user_id)');

        $check_2 = $stmt_2->execute([
            ':event_id' => $event_id,
            ':user_id' => $user_id
        ]);


        if (!$check_2) {
            error_log("Błąd INSERT event_user: " . implode(" | ", $stmt_2->errorInfo()));
            return false;
        }

        return true;
    }
}
