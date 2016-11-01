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
          $this->title = $file['name'];
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
        $music->setParamert($id, $rows['path'], $rows['title'], $rows['thumb']);
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
}