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
        $this->email = $mail;
        $this->password = $password;
    }



    public function insert() {
        if (!is_null($this->id)) {
            trigger_error("User::insert(): file exxist", ERROR_DB);
//            return ERROR_DB;
        } else {
            $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $sql = "INSERT INTO usertbl (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)";
            $st = $connect->prepare($sql);
            $st->bindValue(":full_name", $this->fullName, PDO::PARAM_STR);
            $st->bindValue(":username", $this->login, PDO::PARAM_STR);
            $st->bindValue(":email", $this->email, PDO::PARAM_STR);
            $st->bindValue(":password", $this->password, PDO::PARAM_STR);
            $st->execute();
            $this->id = $connect->lastInsertId();
            $connect = null;
            if (isset($this->id)) {
                return TRUE;
            } else {
                return FALSE;
            }
//            return SUC_DB;
        }
    }
    public static function auth($username, $password) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT INTO usertbl (username, password)";
        $rows = $connect->query($sql);



        if ($rows != FALSE) {
            $dbusername = $rows['username'];
            $dbpassword = $rows['password'];
            if ($username == $dbusername && $password == $dbpassword) {


            } else {
                echo "Неправильный логин или пароль";
            }
        }
    }
}
