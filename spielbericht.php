<?php  
	include('./include/config.php');
    include('./include/gruppenphaseerstellung.php');

    $turnier_id = $_SESSION['turnier_id']; //Das ist die aktuelle Turnier_id;
    $_SESSION['turnier_id'] = $turnier_id;

    $statement="SELECT zuschauercode FROM turnieroptionen WHERE turnier_id = '$turnier_id'";
    foreach($pdo->query($statement) as $row)
                    { 
                        $zuschauercode=$row['zuschauercode']; 
                    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Spielbericht</title>
        <link rel="stylesheet" type="text/css" href="css/stylemanager.css">
    </head>
                    
    <body>
        <div class="card">
        <table class="tablewatch">
                <tr>
                    <td><h1>Spielbericht</h1></td>
                </tr>
            </table>
            <table class="tablelinks">
                <tr>
                    <td rowspan=2><a href="manager.php?turnier_id=$turnier_id">Manager-Ansicht</a></td>
                    <td>
                        <!-- JAVA TIMER -->
                        <!--
                        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
                        <div class="timer">
                            <span class="minute">00</span>:<span class="second">10</span>
                        </div>
                        -->
                    </td>
                </tr>
                <tr>
                    <td colspan=2><p style="border:1px solid black">Zuschauercode:
                                    <?php echo $zuschauercode ?>
                                </p>
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
            <div class="points">
                <div>
                <?php
                    $sql="SELECT DISTINCT tischnr FROM spiele WHERE turnier_id=$turnier_id";
                    foreach($pdo->query($sql) as $row)
                    { 
                        $tischnr=$row['tischnr'];    
                ?>
                    
                <table class="tablepunkte">
                    <tr>
                        <th colspan="6">Tisch <?php echo $row['tischnr']   ?></th>
                    </tr>

                    <tr style="border-bottom:1pt solid black;">
                        <td> Runde</td>
                        <td colspan=2 style=""> Team 1</td>
                        <td></td>
                        <td></td>
                        <td colspan=2> Team 2</td>
                    </tr>   
                    <?php
                    $sql2="SELECT team_id1,team_id2,punktet1,punktet2,runde FROM spiele WHERE turnier_id=$turnier_id and tischnr=$tischnr ORDER BY runde ASC";
                    foreach($pdo->query($sql2) as $row2) 
                    {
                        if($row2['runde']==1000)
                        {
                            $row2['runde']="Achtelfinale";
                        }
                        else if($row2['runde']==1001)
                        {
                            $row2['runde']="Viertelfinale";
                        }
                        else if($row2['runde']==1002)
                        {
                            $row2['runde']="Halbfinale";
                        }
                        else if($row2['runde']==1003)
                        {
                            $row2['runde']="Finale";
                        }
                    $teamid1=$row2['team_id1'];
                    $teamid2=$row2['team_id2'];
                    $punktet1=$row2['punktet1'];
                    $punktet2=$row2['punktet2'];
                    $runde=$row2['runde'];
                    ?>
                    <tr>
                        <td style="width:20;text-align:center"><?php echo $runde ?> </td>
                        <td>
                            <?php 
                                $sqlteam1="SELECT team_name FROM team WHERE team_id=$teamid1";
                                foreach($pdo->query($sqlteam1) as $team_name1)
                                {
                                echo $team_name1['team_name'];
                                }
                            ?>
                        </td>
                        <td><?php echo $punktet1 ?></td>
                        <td>:</td>
                        <td><?php echo $punktet2 ?></td>
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
            </div>
        </div>
    </body>
</html>


