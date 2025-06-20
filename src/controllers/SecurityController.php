<?php

require_once "AppController.php";
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserDAO.php';

class SecurityController extends AppController
{
    public function login()
    {

        if (!$this->isPost()) {
            return $this->render("login");
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = UserDAO::find_by_email($email);

        if (!$user) {
            return $this->render("login", ['messages' => ['User with email ' . $email . ' does not exist.']]);
        }

        $result_hashed = UserDAO::find_hashed_password($email, $password);

        if (!password_verify($password, $result_hashed)) {
            return $this->render("login", ['messages' => ['User with this password does not exist.']]);
        }

        $_SESSION['user'] = [
            'user_id' => $user['user_id'],
            'email' => $user['email'],
            'username' => $user['username'],
            'privileges' => $user['privileges']
        ];

        if ($user['privileges'] == 'admin') {
            $url = "http://" . $_SERVER['HTTP_HOST'];
            header("Location: {$url}/admin-panel");
            exit();
        }

        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/home-logged");
        exit();
    }

    public function get_users()
    {
        return UserDAO::get_users();
    }

    public function register()
    {

        if (!$this->isPost()) {
            return $this->render("register");
        }

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $found_email = UserDAO::find_by_email($email);

        if ($found_email) {
            return $this->render('register', ['messages' => ['User with that email already exist']]);
        }

        $found_username = UserDAO::find_by_username($username);

        if ($found_username) {
            return $this->render('register', ['messages' => ['User with that username already exist']]);
        }

        $success = UserDAO::register($email, $password, $username);

        if (!$success) {
            return $this->render('register', ['messages' => ['Error, could not make accont']]);
        }

        $user = UserDAO::find_by_email($email);

        $_SESSION['user'] = [

            'email' => $user['email'],
            'username' => $user['username'],
            'user_id' => $user['user_id'],
            'privileges' => $user['privileges']

        ];

        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/home-logged");
        exit();
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit();
    }

    public function update_user()
    {

        if (!isset($_SESSION['user']['user_id'])) {
            header("Location: /login");
            exit;
        }

        $userId = $_SESSION['user']['user_id'];
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($email)) {
            echo "Username and email are required.";
            exit;
        }


        $updated = UserDAO::update_user($userId, $username, $email, $password);

        if ($updated) {
            session_destroy();
            header("Location: /login");
            exit;
        } else {
            echo "Failed to update user.";
        }
    }

    public function delete_user()
    {
        if (!isset($_SESSION['user']['user_id'])) {
            header("Location: /login");
            exit;
        }

        $isAdmin = ($_SESSION['user']['privileges'] === 'admin');

        $userId = $isAdmin ? ($_POST['user_id'] ?? null) : $_SESSION['user']['user_id'];

        if (!$userId) {
            echo "No user ID provided.";
            return;
        }

        $deleted = UserDAO::delete_user($userId);

        if ($deleted) {
            if ($isAdmin && $userId !== $_SESSION['user']['user_id']) {

                header("Location: /admin-panel");
                exit;
            } else {

                session_destroy();
                header("Location: /login");
                exit;
            }
        } else {
            echo "Failed to delete user.";
        }
    }

    public function delete_user_by_admin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['privileges'] !== 'admin') {
            header("Location: /login");
            exit;
        }

        $userId = $_POST['user_id'] ?? null;

        if (!$userId) {
            echo "No user ID provided.";
            return;
        }

        
        if ($userId == $_SESSION['user']['user_id']) {
            echo "Admin cannot delete their own account.";
            return;
        }

        $deleted = UserDAO::delete_user($userId);

        if ($deleted) {
            header("Location: /admin-panel");
            exit;
        } else {
            echo "Failed to delete user.";
        }
    }
}
