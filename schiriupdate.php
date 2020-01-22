<?php
    include('./include/config.php');
    $value=$_POST['setvalue'];
    $name=$_POST['setname'];

    $statement=$pdo->query("UPDATE spiele SET $name=0 WHERE spiel_id=$value");
    $statement->excecute();
?>