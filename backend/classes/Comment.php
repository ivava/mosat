<?php

/**
 * Created by PhpStorm.
 * User: Ann
 * Date: 19.12.2016
 * Time: 12:43
 */
class Comment
{
    public $id;
    public $author;
    public $date;
    public $content;
    public $musicId;

    public function setId($id) {
        $this->id = $id;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function setContent($content) {
        $this->content = $content;
    }
    public function getId() {
        return $this->id;
    }
    public function getContent() {
        return $this->content;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getDate() {
        return $this->date;
    }
    public function insert() {

    }
    public function setComment() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_USERNAME);
        $sql = "INSERT INTO comment (author, content) VALUES (:author, :content)";
        $st = $connect->prepare($sql);
        $st->bindValue(":author", $this->author);
        $st->bindValue(":content", $this->content);
        $st->execute();
        $this->setId($connect->lastInsertId());
        $connect = null;
    }
    public function getContentByMusicId() {}

    }