<?php

require_once __DIR__ . '/../database/Database.php';

class UserDAO
{
    public static function find_by_email($email)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * FROM alpa_user WHERE email=:email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function find_by_username($username)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * FROM alpa_user WHERE username=:username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function register($email, $password, $username)
    {
        $db = (new Database())->getConnection();
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO alpa_user (email,password,username,privileges) VALUES (:email,:password,:username,'user')");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_pass);
        $stmt->bindParam(':username', $username);

        return $stmt->execute();
    }

    public static function find_hashed_password($email, $input_password)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT password FROM alpa_user WHERE email=:email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        return $result['password'];
    }

    public static function get_users()
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT user_id,username,email FROM alpa_user');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function update_user($id, $username, $email, $password)
    {
        $db = (new Database())->getConnection();
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('UPDATE alpa_user SET username = :username, email = :email, password = :password WHERE user_id = :id');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_pass);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }


    public static function delete_user($id)
    {
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('DELETE FROM alpa_user WHERE user_id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
