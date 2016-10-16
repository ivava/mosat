<?php
ini_set("display_errors", true);
date_default_timezone_set("Europe/Moscow");

// константы
define("DB_DSN", "mysql:host=localhost;dbname=mosat");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("CLASS_PATH", "backend/classes");
define("ERROR_DB", "Не удалось подключиться к бд");
define("DEFAULT_IMG", "assets/img/test.png");

// autoload
spl_autoload_register(function($class_name) {
   $file = 'classes/'.($class_name) . '.php';
    if (file_exists($file))
        require_once ($file);
});


function handleExeption($exeption) {
    echo "Упс";
    error_log($exeption->getMessage());
};
set_exception_handler('handleExeption');