<?php

require_once __DIR__.'/../database/Database.php';

class UserDAO
{
    public static function findByEmail($email)
    {   
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * FROM alpa_user WHERE email=:email');
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public static function findByUsername($username)
    {   
        $db = (new Database())->getConnection();
        $stmt = $db->prepare('SELECT * FROM alpa_user WHERE username=:username');
        $stmt->bindParam(':username',$username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public static function register($email,$password,$username)
    {
        $db = (new Database())->getConnection();
        $hashed_pass = password_hash($password,PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO alpa_user (email,password,username) VALUES (:email,:password,:username)');
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$hashed_pass);
        $stmt->bindParam(':username',$username);
        
        return $stmt->execute();
    }

    public static function findHashedPassword($email,$input_password)
    {
        $db = (new Database())->getConnection();
        $stmt= $db->prepare('SELECT password FROM alpa_user WHERE email=:email');
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$result)
        {
            return false;
        }

        return $result['password'];
    }

}