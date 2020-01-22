<?php  
	include('./include/config.php');
    include('./include/gruppenphaseerstellung.php');

    $turnier_id = $_SESSION['turnier_id']; //Das ist die aktuelle Turnier_id;
    $_SESSION['turnier_id'] = $turnier_id;
?>
<!DOCTYPE html>
<html>
<head>
<title>Ansicht Manager</title>
<link rel="stylesheet" type="text/css" href="css/styleschiri.css">
</head>
                
<body>
    <h1>Manager</h1>
    <!-- JAVA TIMER -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
        <div class="timer">
            <span class="minute">00</span>:<span class="second">10</span>
        </div>
        <div class="control">
            <button onClick="timer.start(1000)">Start</button> 
            <button onClick="timer.stop()">Stop</button> 
            <button onClick="timer.reset(60)">Reset</button> 
            <button onClick="timer.mode(0)">Count down</button>
        </div>

  <script  src="js/timer.js"></script>
<!-- JAVA TIMER ENDE -->
    <p> Teameingabe Seite --> <a href="teameingabe.php?turnier_id=$turnier_id">Teameingabe</a></p>
        <p> Schiri Seite --> <a href="schiri.php?turnier_id=$turnier_id">Schiri</a></p>
    <form method="post" action="./include/gruppenphaseerstellung.php">
        <p>Tunier-Button --> <button type="submit" name="turniererstellen" >Turnier erstellen</button></p>
    </form>
    
    <label>Runde auswählen
        <select name="top5" size="5">
            <option>Runde 1</option>
            <option>Runde 2</option>
            <option>Runde 3</option>
            <option>Runde 4</option>
        </select>
    </label>
   

<div>
<?php
    $sql="SELECT DISTINCT tischnr FROM spiele WHERE turnier_id=$turnier_id";
    foreach($pdo->query($sql) as $row)
    { 
        $tischnr=$row['tischnr'];    
?>
    
<table style="float:left;">
    <tr>
        <th colspan="5">Gruppe <?php echo $row['tischnr']   ?></th>
    </tr>
   
    <?php
    $sql2="SELECT team_id1,team_id2 FROM spiele WHERE turnier_id=$turnier_id and tischnr=$tischnr";
    foreach($pdo->query($sql2) as $row2) 
    {
    $teamid1=$row2['team_id1'];
    $teamid2=$row2['team_id2'];
    ?>
    <tr>
        <td>
            <?php 
                $sqlteam1="SELECT team_name FROM team WHERE team_id=$teamid1";
                foreach($pdo->query($sqlteam1) as $team_name1)
                {
                echo $team_name1['team_name'];
                }
            ?>
        </td>
        <td>Punkte X</td>
        <td>:</td>
        <td>Punkte Y</td>
        <td>
            <?php  
                $sqlteam2="SELECT team_name FROM team WHERE team_id=$teamid2";
                foreach($pdo->query($sqlteam2) as $team_name2)
                {
                echo $team_name2['team_name'];
                }
            ?>
        </td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
</div>
<div >
<?php
    $sql="SELECT MAX(gruppen_id) as anzahl FROM `team` WHERE turnier_id=$turnier_id";
    foreach($pdo->query($sql) as $gruppenganzahl)
    {
        $gruppen=$gruppenganzahl['anzahl'];
    }
    
    
    for($i=1;$i<=$gruppen;$i++)
    { ?>
        <table style="float:left">
        <tr>
            <th>Gruppe <?php echo $i ?></th>
        </tr>
         <?php
        $sqlgruppen="SELECT team_name FROM team WHERE turnier_id=$turnier_id AND gruppen_id=$i";
        $result=$pdo->prepare($sqlgruppen);
        $result->execute();
        while($row=$result->fetch())
        {?>
        <tr>
            <td>
                <?php echo $row[0];?>
            </td>
        </tr>
    <?php
       }
    }?>

</body>
</html>


