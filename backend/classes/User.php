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
    public $avatar;
    public $userList = array();
    public $musicList = array();
    public $friends_list = array();
    public $bio;


    public function __construct($fullName, $login, $mail, $password, $id, $friend_list = '', $bio)
    {
        $this->fullName = $fullName;
        $this->login = $login;
        $this->email = $mail;
        $this->password = $password;
        $this->id = $id;
        $this->bio = $bio;
    }
    // Возвращает список друзей для текущего ползователя, массив содержит обькты User
    public function getUserList() {
        return $this->userList;
    }
    public function gitUserListCount() {
        $count = 0;
        foreach ($this->userList as $user) {
            $count++;
        }
        return $count;
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
    public static function getUserData($username, $password) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
    public static function getUserById($id) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE id='".$id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
    public static function getUserByUsername($username) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $sql = "SELECT * FROM usertbl WHERE username='".$username."'";
            $st = $connect->prepare($sql);
            $st->execute();
            $rows = $st->fetch(PDO::FETCH_ASSOC);
            return new User($rows['full_name'], $rows['username'], $rows['email'], $rows['password'], $rows['id'],
                $rows['friend_list'], $rows['bio']);
    }
    public function addMusicList($link) {
        $this->musicList[] = $link;
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO usertbl (musicList) VALUES (:musicList)";
        $st = $connect->prepare($sql);
        $st->bindValue(":musicList", $this->fullName, PDO::PARAM_STR);
        $st->execute();

    }
    public function setAvatar($id, $file) {
        $path = "../user_file/avatars/";
        $upload_file = $path . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $upload_file)) {
            $this->avatar = $upload_file;
        }
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
        SET avatar='".$this->avatar."'
         WHERE id='".$id."'";

        $st = $connect->prepare($sql);
        $st->bindValue(":avatar", $this->avatar, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
    }
    public function getAvatar() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        if (isset ($rows['avatar'])) {
            return $rows['avatar'];
        } else {
            return DEFAULT_IMG;
        }
    }
    public function getMusicList() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "
        
        SELECT * FROM music
        WHERE user_id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function getFriend_list() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        return unserialize($rows['friend_list']);
    }
    public function addFriend($friendId) {
        $this->friends_list = $this->getFriend_list();
        $this->friends_list[] = $friendId;
        $str = serialize($this->friends_list);

        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
                SET friend_list='".$str."'
                 WHERE id='".$this->id."'
                ";
        $st = $connect->prepare($sql);
        $st->bindValue(":friend_list", $str, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
    }
    public function setBio($bio) {
        $this->bio = $bio;
    }
    public function insertBio($value) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
        SET bio='".$value."'
         WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->bindValue(":bio", $value, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
        $this->bio = $value;
    }
    public function updateFullName($value) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
        SET full_name='".$value."'
         WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->bindValue(":full_name", $value, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
        $this->fullName = $value;

    }


}
