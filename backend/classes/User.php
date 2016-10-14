<?php

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 12.10.16
 * Time: 0:22
 */
class User
{
    public $id;
    public $login;
    public $email;
    public $fullName;
    public $password;


    public function __construct($fullName, $login, $mail, $password)
    {
        $this->fullName = $fullName;
        $this->login = $login;
        $this->mail = $mail;
        $this->password = $password;
    }



    public function insert() {
        if (!is_null($this->id)) {
            trigger_error("User::insert(): file exxist", ERROR_DB);
//            return ERROR_DB;
        } else {
            $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $sql = "INSERT INTO usertbl (full_name, login, email) VALUES (:full_name, :login, :email)";
            $st = $connect->prepare($sql);
            $st->bindValue(":full_name", $this->fullName, PDO::PARAM_STR);
            $st->bindValue(":login", $this->login, PDO::PARAM_STR);
            $st->bindValue(":email", $this->email, PDO::PARAM_STR);
            $st->execute();
            $this->id = $connect->lastInsertId();
            $connect = null;
//            return SUC_DB;
        }
    }
    public static function auth($username, $password) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'";
        $st = $connect->prepare($sql);
        $rows = $connect->query($st);
        if ($rows != FALSE) {
            $dbusername = $rows['username'];
            $dbpassword = $rows['password'];
            if ($username == $dbusername && $password == $dbpassword) {
                $_SESSION['session_username'] = $username;
                header("Location: ../../front/intro.php");
            } else {
                echo "Неправильный логин или пароль";
            }
        }
    }
}
