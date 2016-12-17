<?php

/**
 * Created by PhpStorm.
 * User: Ann
 * Date: 17.12.2016
 * Time: 17:50
 */
class database
{
public function updateProp($table, $prop, $value, $sample) {
        $connect = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE '".$table."'
        SET $prop='".$value."'
         WHERE id='".$id."'";
    }
}