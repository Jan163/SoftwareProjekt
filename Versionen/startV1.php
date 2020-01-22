<!--?php require('./include/config.php');?>-->
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
    
    <form id="login" action="Optionen.html">
        <input type="submit" name="neuesspiel" class="login login-submit" value="Neues Spiel">
    </form>
    
    <form id="login" method="post" action="teameingabe.html">
        <input type="password" name="password" placeholder="Password" required = "true">
        <input type="submit" name="submit" class="login login-submit" value="Login">
  </form>
</div>
</body>
</html>