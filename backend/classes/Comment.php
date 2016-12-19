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
    public function setMusicId($musicId) {
        $this->musicId = $musicId;
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
    public function getMusicId() {
        return $this->musicId;
    }
    public function insert() {

    }
    public function setComment() {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO comment (author, content, music_id) VALUES (:author, :content, :music_id)";
        $st = $connect->prepare($sql);
        $st->bindValue(":author", $this->author);
        $st->bindValue(":content", $this->content);
        $st->bindValue(":music_id", $this->musicId);
        $st->execute();
        $this->setId($connect->lastInsertId());
        $connect = null;
    }
    public function getCommentByMusicId($musicId) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM comment WHERE music_id='".$musicId."'";
        $st = $connect->prepare($sql);
        $rows = $st->fetch(PDO::FETCH_ASSOC);
        $this->setId($rows['id']);
        $this->setAuthor($rows['author']);
        $this->setContent($rows['content']);
        $this->setMusicId($rows['music_id']);
        return $this;
    }
    public function getAuthorObj() {
        $author = User::getUserByIdObj($this->author);
        return $author;
    }
    public function getAllCommentByMusicId($id) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM comment WHERE music_id='".$id."'";
        $st = $connect->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    }