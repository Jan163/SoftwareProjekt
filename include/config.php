<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

     //Database Infos
     
     $dbname = 'bierpong_db';
     $dbuser = 'bierpong_dbuser';
     $dbpassword = 'karate7879';
     $dbhost = 'localhost';
    
 
     $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpassword);
?>