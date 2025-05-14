<?php

require_once "AppController.php";
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserDAO.php';

class SecurityController extends AppController
{
    public function login()
    {

        if (!$this->isPost()) {
            return $this->render("login");
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user= UserDAO::findByEmail($email);

        if(!$user)
        {
            return $this->render("login",['messages'=>['User with email '.$email.' does not exist.']]);
        }
        
        $result_hashed = UserDAO::findHashedPassword($email,$password);
        
        if(!password_verify($password,$result_hashed))
        {
            return $this->render("login",['messages'=>['User with this password does not exist.']]);
        }

        $_SESSION['user'] = [
            'user_id' => $user['user_id'],           
            'email' => $user['email'],
            'username' => $user['username']
        ];


        $url = "http://".$_SERVER['HTTP_HOST'];
        header("Location: {$url}/home-logged");
        exit();
    }

    public function register()
    {
        
        if(!$this->isPost())
        {
            return $this->render("register");
        }

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $found_email = UserDAO::findByEmail($email);

        if($found_email)
        {
            return $this->render('register',['messages'=>['User with that email already exist']]);
        }

        $found_username = UserDAO::findByUsername($username);

        if($found_username)
        {
            return $this->render('register',['messages'=>['User with that username already exist']]);
        }

        $success = UserDAO::register($email,$password,$username);

        if(!$success)
        {
            return $this->render('register',['messages'=>['Error, could not make accont']]);
        }

        $_SESSION['user'] = [

            'email' => $email,
            'username' => $username
            
        ];
        
        $url = "http://".$_SERVER['HTTP_HOST'];
        header("Location: {$url}/home-logged");
        exit();
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $url = "http://".$_SERVER['HTTP_HOST'];
        header("Location: {$url}/login");
        exit();
    }

}