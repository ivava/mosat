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
    public $musicCount;
    public $follower;
    public $mosatLike = array();


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
    public static function getUserByIdObj($id) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE id='".$id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        return new User($rows['full_name'], $rows['username'], $rows['email'], $rows['password'], $rows['id'],
            $rows['friend_list'], $rows['bio']);
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
        $arr = 0;

          return $arr = unserialize($rows['friend_list']);

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
        $this->folloving($friendId);
    }
    public function getFriendCount() {
        $this->friends_list = $this->getFriend_list();
        $count = 0;
        for ($i = 0; $i < count($this->friends_list); $i++) {
            $count = $i;
        }
        return $count;
    }
    public function getFollowCount() {
        $this->follower = $this->getFollowerList($this->id);

        $count = 0;
        for ($i = 0; $i < count($this->follower); $i++) {
            $count = $i;
        }
        return $count;
    }
    public function getFollowerList($id) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE id='".$id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        return unserialize($rows['follower']);
    }
   public function folloving($id) {
        $this->follower = $this->getFollowerList($id);
        $this->follower[] = $this->id;
        $str = serialize($this->follower);

        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
                SET follower='".$str."'
                 WHERE id='".$id."'
                ";
        $st = $connect->prepare($sql);
        $st->bindValue(":follower", $str, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
    }
    public function deleteFriend($id) {
        $friendList = $this->getFriend_list();
        $key = array_search($id, $friendList);
        if ($key !== false) {
           unset($friendList[$key]);
        }

        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
                SET friend_list='".$friendList."'
                 WHERE id='".$this->id."'
                ";

        $st = $connect->prepare($sql);
        $st->bindValue(":friend_list", $friendList, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
        $this->deleteFollower($id);
    }
    public function deleteFollower($id) {
        $followList = $this->getFollowerList($id);
        $key = array_search($this->id, $followList);

        if ($key !== false) {
            unset($followList[$key]);
        }

        $connnect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
                SET follower='".$followList."'
                 WHERE id='".$id."'
                ";
        $st = $connnect->prepare($sql);
        $st->bindValue(":follower", $followList, PDO::PARAM_STR);
        $st->execute();
        $connnect = null;
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
    public function getMosatCount() {
        $list = $this->getMusicList();
        $count = 0;
        for ($i = 0; $i <= count($list); $i++) {
            $count = $i;
        }
        $this->musicCount = $count;
        return $this->musicCount;
    }
    public function isFollow($id) {
        $friendLIst = $this->getFriend_list();
        if (is_array($friendLIst)) {
            return in_array($id, $friendLIst);
        } else {
            return false;
        }
    }
    public function getLikedList($userId) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM usertbl WHERE id='".$userId."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        $arr = 0;
        $arr = unserialize($rows['mosat_like']);
        return $arr;
    }
    public function addToLikedMusic($userId, $musicId) {
        $arr = $this->getLikedList($userId);
        if (is_array($arr)) {
            $this->mosatLike = $arr;
        } else {
            $this->mosatLike = array();
        }


//            $this->mosatLike[] = $musicId;
            array_push($this->mosatLike, $musicId);
            $str = serialize($this->mosatLike);
            $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $sql = "UPDATE usertbl
                SET mosat_like='" . $str . "'
                 WHERE id='" . $userId . "'
                ";
            $st = $connect->prepare($sql);
            $st->bindValue(":mosat_like", $str, PDO::PARAM_STR);
            $st->execute();
            $connect = null;
    }
    public function isLiked($music_id) {
        $likeList = $this->getLikedList($this->id);

        if (is_array($likeList)) {
            return in_array($music_id, $likeList);
        } else {
            return false;
        }
    }
    public function deleteLikeMusic($music_id) {
        $likeList = $this->getLikedList($this->id);
        $key = array_search($music_id, $likeList);

        if ($key !== false) {
            unset($likeList[$key]);
        }
        $connnect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
                SET mosat_like='".$likeList."'
                 WHERE id='".$this->id."'
                ";
        $st = $connnect->prepare($sql);
        $st->bindValue(":mosat_like", $likeList, PDO::PARAM_STR);
        $st->execute();
        $connnect = null;



        $followList = $this->getFollowerList($id);
        $key = array_search($this->id, $followList);

        if ($key !== false) {
            unset($followList[$key]);
        }

        $connnect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE usertbl
                SET follower='".$followList."'
                 WHERE id='".$id."'
                ";
        $st = $connnect->prepare($sql);
        $st->bindValue(":follower", $followList, PDO::PARAM_STR);
        $st->execute();
        $connnect = null;
    }



}
