<?php

require_once __DIR__ . '/../database/Database.php';

class GalleryDAO
{
    public static function create_gallery($room_id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('
        INSERT INTO "gallery" (room_id)
        VALUES (:room_id)
        ');

        $stmt->execute([
            ":room_id" => $room_id
        ]);
    }

    public static function save_photo($target_path)
    {

        $user_id = $_SESSION["user"]["user_id"];


        $room_id = $_POST['roomId'];


        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT gallery_id FROM gallery WHERE room_id = :room_id LIMIT 1');
        $stmt->execute([':room_id' => $room_id]);

        $gallery = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gallery) {
            $gallery_id = $gallery['gallery_id'];


            $stmt_2 = $db->prepare('
            INSERT INTO photo (gallery_id, user_id, sent_at, target_path) 
            VALUES (:gallery_id, :user_id, NOW(), :target_path)
        ');

            $stmt_2->execute([
                ':gallery_id' => $gallery_id,
                ':user_id' => $user_id,
                ':target_path' => $target_path
            ]);

            return true;
        } else {
            error_log("No gallery found for room_id: $room_id");
            return false;
        }
    }
}
