<?php

require_once "AppController.php";
require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/RoomDAO.php";
require_once __DIR__ . "/../models/EventDAO.php";
require_once __DIR__ . "/../models/GalleryDAO.php";

class RoomController extends AppController
{
    private $uploadDir = 'uploads/';

    public function room($params)
    {
        $room_id = $params[0] ?? null;
        $subpage = $params[1] ?? 'room_dashboard';
        $user_id = $_SESSION['user']['user_id'];

        if (!$room_id) {
            die("Missing room id!");
        }

        $access = RoomDAO::findById($user_id, $room_id);

        if (!$access) {
            die("No privilages");
        }
        $room_data = $this->get_room_by_id_data($room_id);

        switch ($subpage) {
            case 'room_dashboard':
                $this->render('room-dashboard',["room_id" => $room_id, "room_data" => $room_data]);
                break;
            case 'room_chat':
                $this->render('room-chat', [$room_id]);
                break;
            case 'room_event_info':
                $this->render('room-event-info', ["room_id" => $room_id, "room_data" => $room_data]);
                break;
            case 'room_event_plan':
                $this->render('room-event-plan', [$room_id]);
                break;
            case 'room_event_settlements':
                $this->render('room-event-settlements', [$room_id]);
                break;
            case 'room_gallery':
                $photo_paths = $this->get_photos($room_id);
                $this->render('room-gallery', ["room_id"=>$room_id,"photo_paths"=>$photo_paths]);
                break;
            case 'room_settings':
                $this->render('room-settings', [$room_id]);
                break;
            case 'room_team':
                $this->render('room-team', [$room_id]);
                break;
        }
    }

    public function get_first_room()
    {
        header("Content-Type: application/json");
        $user_id = $_SESSION["user"]["user_id"];
        $event_id = $_GET["event_id"] ?? null;
        error_log($event_id);
        $room_id = RoomDAO::getFirstRoom($user_id, $event_id);

        echo json_encode($room_id);
    }

    public function get_room_by_id()
    {
        header("Content-Type: application/json");
        $user_id = $_SESSION["user"]["user_id"];
        $room_id = $_GET["room_id"] ?? null;

        $rooms = RoomDAO::findByID($user_id, $room_id);

        echo json_encode($rooms);
    }

    public function get_room_by_id_data($room_id)
    {

        $user_id = $_SESSION["user"]["user_id"];


        return RoomDAO::findByID($user_id, $room_id);
    }

    public function get_photos($room_id)
    {
        return RoomDAO::get_photos($room_id);
    }

    public function create_room()
    {
        header('Content-Type: application/json');
        $user_id = $_SESSION["user"]["user_id"];
        $event_id = $_GET['event_id'] ?? null;


        if (!$event_id || !$user_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Brak danych wejściowych']);
            return;
        }
        $reference_event = EventDAO::get_event_by_id($event_id);

        $room_id = RoomDAO::createRoom($event_id, $user_id);
        GalleryDAO::create_gallery($room_id);

        if (!$room_id) {
            http_response_code(500);
            echo json_encode(['error' => 'Nie udało się utworzyć pokoju']);
            return;
        }

        echo json_encode(['room_id' => $room_id]);
    }

    public function add_user()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input["friendId"]) && isset($input["roomId"])) {
                $friendId = $input["friendId"];
                $roomId = $input["roomId"];

                EventDAO::add_user($friendId, $roomId);
                RoomDAO::add_user($friendId, $roomId);
                http_response_code(200);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing data.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }

    public function get_participants()
    {
        header('Content-Type: application/json');
        $roomId = $_GET['roomId'] ?? null;

        if (!$roomId) {
            echo json_encode(['status' => 'error', 'message' => 'Missing roomId']);
            return;
        }

        $participants = RoomDAO::get_participants($roomId);

        echo json_encode($participants);
    }

    public function upload_photo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
            $file = $_FILES['photo'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['status' => 'error', 'message' => 'File upload failed']);
                exit;
            }

            $fileName = basename($file['name']);
            $targetPath = $this->uploadDir . $fileName;

            if (!getimagesize($file['tmp_name'])) {
                echo json_encode(['status' => 'error', 'message' => 'Uploaded file is not an image']);
                exit;
            }

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {

                GalleryDAO::save_photo($targetPath);

                echo json_encode(['status' => 'success', 'photoPath' => '/' . $targetPath]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save image']);
            }
        }
    }

    public function add_plan_point()
    {
        RoomDAO::addPlanPoint();
    }

    public function delete_plan_point()
    {
        RoomDAO::deletePlanPoint();
    }

    public function get_plans()
    {
        RoomDAO::getPlans();
    }
}
