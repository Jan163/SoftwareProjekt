<?php require('./include/config.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login&Spiel erstellen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="login-card">
        <h3>Ein neues Spiel starten</h3>
        <h3>oder dich einloggen</h3>
        
        <form id="login" action="optionen.php">
            <input type="submit" name="neuesspiel" class="login login-submit" value="Neues Spiel">
        </form>
        <br>

        <div class="error-message" style="display: <?php if (isset($_SESSION['loginError'])) {echo 'block';}else{echo 'none';}?>;"><?php if (isset($_SESSION['loginError'])) {echo $_SESSION['loginError']; unset($_SESSION['loginError']); } ?></div>
        
        <form id="login" method="post" action="login.php">
            <input type="text" name="turniername" placeholder="Tuniername" required = "true">
            <br>
            <input type="password" name="password" placeholder="Password" required = "true">
            <br>
            <br>
            <input type="submit" name="submit" class="login login-submit" value="Login">
        </form>
    </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
</html>