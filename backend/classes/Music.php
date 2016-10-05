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
    public $link;
    public $name;
    public $timeLine;

  public function __construct($data = array()) {
      if (isset($data['id'])) {
          $this->id = (int) $data['id'];
      }
      if (isset($data['link'])) {
          $this->link = $data['link'];
      }
      if (isset($data['name'])) {
          $this->name = $data['name'];
      }
      if (isset($data['timeLine'])) {
          $this->timeLine = $data['timeLine'];
      }
  }
//добавление в бд ин-фы о музыке
  public function insert() {
      if (!is_null($this->id)) {
          trigger_error("Music::insert(): file exist", E_USER_ERROR);
      } else {
          $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
          $sql = "INSERT INTO Music (link, name, timeLine) VALUES (:link, :name, :timeLine)";
          $st = $connect->prepare($sql);
          $st->bindValue(":link", $this->link, PDO::PARAM_STR);
          $st->bindValue(":name", $this->name, PDO::PARAM_STR);
          $st->bindValue(":timeLine", $this->timeLine, PDO::PARAM_INT);
          $st->execute();
          $this->id = $connect->lastInsertId();
          $connect = null;
      }
  }

}