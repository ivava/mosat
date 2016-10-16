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
    public $timeLine = array();



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
  }
}