<?php  include('./include/config.php');

if(isset($_POST['submit']))
{
    
    $managercode=createRandomPassword();
    $zuschauercode=createRandomPassword();
    $turniername= $_POST['turniername'];
    $turnierbeginn=$_POST['turnierbeginn'];
    $gruppengroesse=$_POST['gruppengroesse'];
    $weiterkommend= $_POST['weiterkommend'];
    $zeit=$_POST['zeit'];
    $timeout=$_POST['timeout'];

    //Für Zeitpläne erstellen
    //$statement=$pdo->prepare("INSERT INTO turnieroptionen (turnier_name,turnierbeginn,gruppengroesse,teams_pro_gruppe,spielzeit,zeitzwischendenspielen,managercode,zuschauercode,uebrigeteams,aktuellerunde) VALUES (?,?,?,?,?,?,?,?,?,?)");
    //$statement->execute(array($turniername,$turnierbeginn,$gruppengroesse,$weiterkommend,$zeit,$timeout,$managercode,$zuschauercode,$weiterkommend,'1'));

    $statement=$pdo->prepare("INSERT INTO turnieroptionen (turnier_name,gruppengroesse,teams_pro_gruppe,managercode,zuschauercode,uebrigeteams,aktuellerunde) VALUES (?,?,?,?,?,?,?)");
    $statement->execute(array($turniername,$gruppengroesse,$weiterkommend,$managercode,$zuschauercode,$weiterkommend,'1'));

    $idstatement=$pdo->prepare("SELECT turnier_id from turnieroptionen where turnier_name = '$turniername'");
    $idstatement->execute(array($turniername));
    while($row = $idstatement->fetch()){
		$turnier_id =$row['turnier_id'];
	}
    
    $_SESSION['turnier_id'] = $turnier_id;
	header("location: teameingabe.php");
    die();
    
}

function createRandomPassword($length=3,$chars="") 
{ 
        if($chars=="")
            $chars = "0123456789"; 
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
    <form id="login" method="post">
    <tr>
        <td>Turniername:</td>
        <td><input type="text" name="turniername" required = "true"></td>
    </tr>
    <!--
        <tr>
        <td>Beginn der Spiele:</td>
        <td><input type="time" name="turnierbeginn" required = "true"></td>
    </tr>
    -->
    <tr id="weiter">
        <td>Anzahl Teams für KO-Phase</td>
        <td><select name="weiterkommend" required=true>
                <option value=4>4 Teams</option>
                <option value=8>8 Teams</option>
                <option value=16>16 Teams</option>
        </td>
    </tr>
    <tr>
        <td>Gruppenphase?:</td>
        <td><input type="checkbox" id="phase" onclick="test()"></td>
    </tr>
        <tr style="visibility:hidden" id="info2">
        <td colspan=2>Anzahl der Teams = Gruppengröße * Gruppengröße</td>
    </tr>
    <tr style="visibility:hidden" id="info3">
        <td colspan=2>Bsp.: 16 = 4 * 4</td>
    </tr>
    <tr style="visibility:hidden" id="Groesse">
        <td>Gruppengröße: </td>
        <td><input type="number" name="gruppengroesse" min="0" max="15" name="gruppen" value="0" required = "true" ></td>
    </tr>
    
    <!--
        <tr>
        <td>Spielezeit:</td>
        <td><input type="time" id="Spielezeit" name="zeit" required = "true" > hh:mm </td>
    </tr>
    
    <tr>
        <td>Zeit zwischen den Spielen:</td>
        <td><input type="time" id="pausenzeit" name="timeout" required = "true">hh:mm</td>
    </tr>
    -->
    </table>
        <input type="submit" name='submit' value='Tunier erstellen' class="login login-submit">
    </form>
</div>
    <script>
        function test() 
        {
            // Get the checkbox
            var checkBox = document.getElementById("phase");
            // Get the output text
            var text = document.getElementById("Groesse");
            var info = document.getElementById("info");
            var info2 = document.getElementById("info2");
            var info3 = document.getElementById("info3");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true)
            {
            text.style.visibility = "visible";
            info2.style.visibility = "visible";
            info3.style.visibility = "visible";
            } 
            else 
            {
            text.style.visibility = "hidden";
            info2.style.visibility = "hidden";
            info3.style.visibility = "hidden";
            }
        }
    </script>
</body>
</html>



