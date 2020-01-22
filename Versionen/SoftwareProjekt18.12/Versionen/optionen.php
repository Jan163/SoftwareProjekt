<?php  include('./include/config.php');?>
<html>
<head>
    <meta charset="utf-8">
    <title>Login&Spiel erstellen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-card">
    <h3>Tunier erstellen</h3>
    <table style="width:30%">
    <tr>
        <td>Turniername:</td>
        <td><input type="text" name="turniername"></td>
    </tr>
    <tr>
        <td>Beginn der Spiele:</td>
        <td><input type="time" name="turnierbeginn"></td>
    </tr>
    <tr>
        <td>Gruppenphase?:</td>
        <td><input type="checkbox" id="phase" onclick="test()"></td>
    </tr>

    <tr style="visibility:hidden" id="Groesse">
        <td>Gruppengröße: </td>
        <td><input type="number" name="gruppengroesse" min="0" max="15" name="gruppen" value="0"></td>
    </tr>
    <tr style="visibility:hidden" id="weiter">
        <td>Teams pro Gruppe weiter:</td>
        <td><input type="number" name="weiterkommend" min="1" max="15" name="weiter"></td>
    </tr>
    <script>
            function test() {
    // Get the checkbox
    var checkBox = document.getElementById("phase");
    // Get the output text
    var text = document.getElementById("Groesse");
    var text2= document.getElementById("weiter");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
    text.style.visibility = "visible";
    text2.style.visibility = "visible";
    } else {
    text.style.visibility = "hidden";
    text2.style.visibility = "hidden";
    }
    }
    </script>
    <tr>
        <td>Spielfelder:</td>
        <td><input type="number" id="Spielfelder" min="0" max="15" name="felder"></td>
    </tr>
    <tr>
        <td>Spielezeit:</td>
        <td><input type="number" id="Spielezeit" min="0" max="60" name="zeit"></td>
    </tr>
    <tr>
        <td>Zeit zwischen den Spielen:</td>
        <td><input type="number" id="pausenzeit" min="0" max="15" name="timeout"></td>
    </tr>

    </table>
    <form method="post" action="schiri.php">
        <input type="submit" name='senden' value='Tunier erstellen'>
    </form>
</div>
</body>

</html>

<?php
if(isset($_POST['senden']))
{
    $managercode=createRandomPassword();
    $zuschauercode=createRandomPassword();
    $turniername=$_Get('turniername');
    $turnierbeginn=$_Get('turnierbeginn');
    $gruppengröße=$_Get('gruppengroesse');
    
    $statement=$pdo->prepare("INSERT INTO Turnieroptionen (turniername, turnierbeginn, gruppengröße, teams_pro_gruppe, anzahl_spielfelder, spielzeit, zeitzwischendenspielen, managercode,zuschauercode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->execute(array($turniername,$turnierbeginn ,$gruppengröße,null,null,null,null,$managercode,$zuschauercode));
}
function createRandomPassword($length=4,$chars="") 
{ 
        if($chars=="")
            $chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $pass = '' ; 
    
        while ($i <= $length) { 
            $num = rand() % strlen($chars); 
            $tmp = substr($chars, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
        } 
        return $pass; 
    }
?>
