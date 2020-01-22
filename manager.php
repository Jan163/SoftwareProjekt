<?php  
	include('./include/config.php');
    include('./include/gruppenphaseerstellung.php');

    $turnier_id = $_SESSION['turnier_id']; //Das ist die aktuelle Turnier_id;
    $_SESSION['turnier_id'] = $turnier_id;

    $statement="SELECT Count(team_id) as teamcount From team Where turnier_id='$turnier_id'";
    foreach($pdo->query($statement)as $row)
        {
            $teamcount=$row['teamcount'];
        }

    $statement="SELECT gruppengroesse,teams_pro_gruppe,uebrigeteams,aktuelleRunde, managercode FROM turnieroptionen WHERE turnier_id ='$turnier_id'";
    foreach($pdo->query($statement) as $row)
                    { 
                        $gruppengroesse=$row['gruppengroesse'];
                        $teams_pro_gruppe=$row['teams_pro_gruppe'];
                        $uebrigeteams=$row['uebrigeteams'];
                        $aktuelleRunde=$row['aktuelleRunde'];
                        $managercode=$row['managercode'];
                    }
    $max="SELECT Max(runde) as maxRunde FROM spiele WHERE turnier_id ='$turnier_id'";
    foreach($pdo->query($max) as $col)
                    { 
                        $maxRunde=$col['maxRunde'];
                    }
    $anzeigen=false;

    

    if (isset($_GET['turnier'])) {
        $anzeigen = true;
    }
    if($maxRunde=='Achtelfinale')
        {
            $maxRunde=1;
            $aktuelleRunde=2;
        }
        elseif($maxRunde=='Viertelfinale')
        {
            $maxRunde=1;
            $aktuelleRunde=2;
        }
        elseif($maxRunde=='Halbfinale')
        {
            $maxRunde=1;
            $aktuelleRunde=2;
        }
        elseif($maxRunde=='Finale')
        {
            $maxRunde=1;
            $aktuelleRunde=2;
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ansicht Manager</title>
        <link rel="stylesheet" type="text/css" href="css/stylemanager.css">
    </head>
                    
    <body>
        <div class="card">
            <table class="tablewatch">
                <tr>
                    <td><h1>Manager</h1></td>
                </tr>
            </table>
            <table class="tablelinks">
                <tr>
                    <?php if ($anzeigen == false){  ?>
                        <td><a href="teameingabe.php?turnier_id=$turnier_id">Teameingabe</a></td>
                    <?php } ?>
                    <td rowspan=4>
                    <!-- JAVA TIMER -->
                    <!--
                    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
                    <div class="timer">
                        <span class="minute"></span>:<span class="second">10</span>
                    </div>-->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="schiri.php?turnier_id=$turnier_id">Schiri-Seite</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="spielbericht.php?turnier_id=$turnier_id">Ab zum Spielbericht</a>
                    </td>
                </tr>
                <tr>
                    <td>

                    <?php 
                    if($gruppengroesse!=0)
                    {
                    if($teamcount==$gruppengroesse*$gruppengroesse)
                    {
                        ?>
                        <form method="post" action="./include/gruppenphaseerstellung.php">
                            <?php if ($gruppengroesse != 0){ 
                                ?>
                                    <?php if ($anzeigen == false){  ?>
                                        <button type="submit" name="turniererstellen" >Gruppenphase erstellen</button> 
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                        </form>
                    <?php 
                    } 
                    else
                    {?>
                    <p>Es werden <?php echo $gruppengroesse*$gruppengroesse?> Teams benötigt, um das Turnier starten zu können</p>
                    <p>Es sind bisher <?php echo $teamcount?> Teams eingegeben.</p>
                    <?php
                    }
                }
                ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="./include/koerstellung.php">
                        <?php if($aktuelleRunde <= $maxRunde AND $gruppengroesse !=0 )
                        { ?>
                            <button type="submit" name="punkteSenden" >Punkte der Runde senden</button>
                        <?php } else
                        {
                            if ($teams_pro_gruppe == $uebrigeteams)
                            { ?>
                            <button type="submit" name="koerstellen" >Ko-Runde erstellen</button>
                            <?php }
                            else 
                            {?>
                            <div class="error-message" style="display: <?php if (isset($_SESSION['full'])) {echo 'block';}else{echo 'none';}?>;"><?php if (isset($_SESSION['full'])) {echo $_SESSION['full']; unset($_SESSION['full']); } ?></div>
                            <button type="submit" name="rundekoerstellen" >Nächste Ko-Runde erstellen</button>
                            <?php }
                        } ?>
                        </form>
                    </td>
                
                    <!-- Timer-->
                    <!--
                    <td>
                        <div class="control">
                            <button onClick="timer.start(1000)">Start</button> 
                            <button onClick="timer.stop()">Stop</button> 
                            <button onClick="timer.reset(60)">Reset</button> 
                            <button onClick="timer.mode(0)">Count down</button>
                        </div>
                    
                        <script  src="js/timer.js"></script>
                    </td>
                    -->
                    <!-- JAVA TIMER ENDE -->
                </tr>
                
                <tr>
                    
                    <td style="border:1px solid black">ManagerCode:
                            <?php echo $managercode ?>
                    </td>
                </tr>
                
            </table>
            <div>
                    <?php
                        $sql="SELECT MAX(gruppen_id) as anzahl FROM `team` WHERE turnier_id=$turnier_id";
                        foreach($pdo->query($sql) as $gruppenganzahl)
                        {
                            $gruppen=$gruppenganzahl['anzahl'];
                        }
                        
                        for($i=1;$i<=$gruppen;$i++)
                        { ?>
                            <table class="tablegruppe">
                            <tr>
                                <th colspan=3>Gruppe <?php echo $i ?></th>
                            </tr>
                            <tr class="tabelltr">
                                <td>Team </td>
                                <td>Punkte </td>
                                <td>Cups </td>
                            </tr>
                            <?php
                            $sqlgruppen="SELECT team_name,punkte,getroffenecups FROM team WHERE turnier_id=$turnier_id AND gruppen_id=$i order by punkte Desc";
                            $result=$pdo->prepare($sqlgruppen);
                            $result->execute();
                            while($row=$result->fetch())
                            {?>
                            <tr>
                                <td>
                                    <?php echo $row[0];?>
                                </td>
                                <td>
                                    <?php echo $row[1];?>
                                </td>
                                <td>
                                    <?php echo $row[2];?>
                                </td>
                            </tr>
                        <?php
                        }
                        }
                    ?>
            </div>
        </div>
    </body>
</html>