<?php

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.10.16
 * Time: 0:51
 */
class Music
{
    public $id;
    public $path;
    public $title;
    public $user_id;
    public $thumb;
    public $timeLine = array();
    public $author;
    public $likeCount;





    public function setParamert($id, $path, $title, $user_id, $thumb = '')
    {
        $this->id = $id;
        $this->path = $path;
        $this->title = $title;
        $this->user_id = $user_id;
        $this->thumb = $thumb;
    }
//добавление в бд ин-фы о музыке
//  public function insert() {
//      if (!is_null($this->id)) {
//          trigger_error("Music::insert(): file exist", E_USER_ERROR);
//      } else {
//          $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
//          $sql = "INSERT INTO Music (link, name, timeLine) VALUES (:link, :name, :timeLine)";
//          $st = $connect->prepare($sql);
//          $st->bindValue(":link", $this->link, PDO::PARAM_STR);
//          $st->bindValue(":name", $this->name, PDO::PARAM_STR);
//          $st->bindValue(":timeLine", $this->timeLine, PDO::PARAM_INT);
//          $st->execute();
//          $this->id = $connect->lastInsertId();
//          $connect = null;
//      }
//  }
  public function uploadFile($userId, $file) {
      $path = "../user_file/" . $userId . "/";
      if (!file_exists($path)) {
          mkdir($path);
      }
      $uploadFile = $path . basename($file['name']);
      if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
          $this->user_id = $userId;
          $this->path = $uploadFile;

//          $auObj = new Audio();
//          $auObj->loadFile($this->path);
//          $auObj->id3_title;
//          $this->title = $auObj->id3_title;
          $this->title = $this->path;
      }
      $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql = "INSERT INTO music (user_id, title, path) VALUES (:user_id, :title, :path)";
      $st = $connect->prepare($sql);
      $st->bindValue(":user_id", $this->user_id, PDO::PARAM_INT);
      $st->bindValue(":title", $this->title, PDO::PARAM_STR);
      $st->bindValue(":path", $this->path, PDO::PARAM_STR);
      $st->execute();
      $this->id = $connect->lastInsertId();
      $connect = null;
      return $this;
  }
  public function uploadThumb($id, $photo) {
      $path = "../user_file/thumb/";

      $uploadFile = $path . basename($photo['name']);
      if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
          $this->thumb = $uploadFile;
      }
      $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql = "UPDATE music
        SET thumb='".$this->thumb."'
         WHERE id='".$id."'";

      $st = $connect->prepare($sql);
      $st->bindValue(":thumb", $this->thumb, PDO::PARAM_STR);
      $st->execute();
      $connect = null;
      return $this->thumb;
  }
    public static function getMusicByUserId($userId) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM music WHERE user_id='".$userId."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
    public static function getMusicById($id) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM music WHERE id='".$id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        $music = new Music();
        $music->setParamert($id, $rows['path'], $rows['title'], $rows['user_id'], $rows['thumb']);
        return $music;
    }
    public static function getAllMusicCount() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT id FROM music";
        $st = $connect->prepare($sql);
        $st->execute();
        $id = $st->fetch(PDO::FETCH_ASSOC);
        return $id;
    }
    public function updateTitle($value) {

        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE music
        SET title='".$value."'
         WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->bindValue(":title", $value, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
        $this->title = $value;
        return $this;
    }
    public function updateAuthor($value) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE music
        SET author='".$value."'
         WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->bindValue(":author", $value, PDO::PARAM_STR);
        $st->execute();
        $connect = null;
        $this->author = $value;
        return $this;
    }
    private function getAuthorFromBd() {
        $connect = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT author FROM music WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        $this->author = $rows['author'];
    }
    public function getMusicAuthor() {
        $this->getAuthorFromBd();
        return $this->author;
    }
    private function getThumbByBd() {
        $connect = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT thumb FROM music WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        $this->thumb = $rows['thumb'];
    }
    public function getMusicThumb() {
        $this->getThumbByBd();
        return $this->thumb;
    }
    private function getAllMusicObj() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM music";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $connect = null;
        return $rows;
    }
    public function getCount() {
        $allMusic = $this->getAllMusicObj();
        $count = count($allMusic);
        $qu = 0;
        for ($i = 0; $i < $count; $i++) {
            $qu = $i;
        }
        return $qu;
    }
    public function getLikeCount() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM music WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        if (isset($rows['like_count'])) {
            return $rows['like_count'];
        } else {
            return 0;
        }
    }
    public function addLike() {
       $this->likeCount = $this->getLikeCount() + 1;
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE music
        SET like_count='".$this->likeCount."'
         WHERE id='".$this->id."'";
        $st = $connect->prepare($sql);
        $st->bindValue(":like_count", $this->likeCount, PDO::PARAM_INT);
        $st->execute();
        $connect = null;
    }

}