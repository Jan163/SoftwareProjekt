<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

     //Database Infos
     $dbname = 'kkl';
     $dbuser = 'root';
     $dbpassword = 'root';
     $dbhost = 'localhost';
 
     $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpassword);
?>