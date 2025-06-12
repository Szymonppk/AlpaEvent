<?php

require_once __DIR__."/../database/Database.php";

class NotesDAO
{
    public static function get()
    {
        $roomId = $_GET['roomId'] ?? null;

        if (!$roomId) {
            echo json_encode(['notes' => []]);
            exit;
        }

        $db = (new Database())->getConnection();
        $stmt = $db->prepare("SELECT note_id AS id, content FROM sticky_note WHERE room_id = :roomId ORDER BY created_at ASC");
        $stmt->execute([':roomId' => $roomId]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['notes' => $notes]);
    }

    public static function add()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $roomId = $data['roomId'] ?? null;

        if (!$roomId) {
            http_response_code(400);
            exit;
        }

        $db = (new Database())->getConnection();
        $stmt = $db->prepare("INSERT INTO sticky_note (room_id, content) VALUES (:roomId, '')");
        $stmt->execute([':roomId' => $roomId]);

        $id = $db->lastInsertId();
        echo json_encode(['id' => $id, 'content' => '']);
    }

    public static function update()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'] ?? null;
        $content = $data['content'] ?? '';

        if (!$id) {
            http_response_code(400);
            exit;
        }

        $db = (new Database())->getConnection();
        $stmt = $db->prepare("UPDATE sticky_note SET content = :content WHERE note_id = :id");
        $stmt->execute([':content' => $content, ':id' => $id]);

        echo json_encode(['status' => 'success']);
    }
}
