<?php 
include('config.php');
$spiel_id=$_SESSION['spiel_id'];

    //hier müssen alle Cups geupdatet werden
    //updaten
    if(isset($_POST['submit']))
    {
        $team1_cup_1=$_POST['1_cup_1'];
        $team1_cup_2=$_POST['1_cup_2'];
        $team1_cup_3=$_POST['1_cup_3'];
        $team1_cup_4=$_POST['1_cup_4'];
        $team1_cup_5=$_POST['1_cup_5'];
        $team1_cup_6=$_POST['1_cup_6'];
        $team1_cup_7=$_POST['1_cup_7'];
        $team1_cup_8=$_POST['1_cup_8'];
        $team1_cup_9=$_POST['1_cup_9'];
        $team1_cup_10=$_POST['1_cup_10'];
        $team2_cup_1=$_POST['2_cup_1'];
        $team2_cup_2=$_POST['2_cup_2'];
        $team2_cup_3=$_POST['2_cup_3'];
        $team2_cup_4=$_POST['2_cup_4'];
        $team2_cup_5=$_POST['2_cup_5'];
        $team2_cup_6=$_POST['2_cup_6'];
        $team2_cup_7=$_POST['2_cup_7'];
        $team2_cup_8=$_POST['2_cup_8'];
        $team2_cup_9=$_POST['2_cup_9'];
        $team2_cup_10=$_POST['2_cup_10']; 
        echo $spiel_id; 

        //Update der Cups 

        /*
		$statementupdate=$pdo->prepare("UPDATE spiele SET 1_cup_1='$team1_cup_1' and 1_cup_2='$team1_cup_2' and 1_cup_1='$team1_cup_3' and 1_cup_1='$team1_cup_4' and 1_cup_1='$team1_cup_5' and
        1_cup_1='$team1_cup_6' and 1_cup_1='$team1_cup_7' and 1_cup_1='$team1_cup_8' and 1_cup_1='$team1_cup_9' and 1_cup_1='$team1_cup_10' and 1_cup_1='$team2_cup_1' and
        1_cup_1='$team2_cup_2' and 1_cup_1='$team2_cup_3' and 1_cup_1='$team2_cup_4' and 1_cup_1='$team2_cup_5' and 1_cup_1='$team2_cup_6' and
        1_cup_1='$team2_cup_7' and 1_cup_1='$team2_cup_8' and 1_cup_1='$team2_cup_9' and 1_cup_1='$team2_cup_10'  WHERE spiel_id=$spiel_id");
        $statementupdate->execute();
        echo $team1_cup_1;
        
        //Count abfrage wie viele Cups pro team getroffen werden //Team1
        //In der Datenbank noch die Cups auf Standard 1 setzten.
        $countteam1=0;
        $statementselectteam1=$pdo->prepare("SELECT 1_cup_1,1_cup_2,1_cup_3,1_cup_4,1_cup_5,1_cup_6,1_cup_7,1_cup_8,1_cup_9,1_cup_10 FROM spiele where spiel_id=$spiel_id");
        foreach($pdo->query($statementselectteam1) as $row)
        { 
            for ($i=1; $i <=10 ; $i++) { 
                $platzhalter = '1_cup_'.$i;
                $team1_cup_.$i=$row['platzhalter'];

                if($team1_cup_.$i==1)
                {
                    $countteam1=$countteam1+1;
                }
            }
        }

        //Count abfrage wie viele Cups pro team getroffen werden Team 2
        //In der Datenbank noch die Cups auf Standard 1 setzten.
        $countteam2=0;
        $statementselectteam2=$pdo->prepare("SELECT 2_cup_1,2_cup_2,2_cup_3,2_cup_4,2_cup_5,2_cup_6,2_cup_7,2_cup_8,2_cup_9,2_cup_10FROM spiele where spiel_id=$spiel_id");
        foreach($pdo->query($statementselectteam2) as $row)
        { 
            for ($i=1; $i <=10 ; $i++) { 
                $platzhalter = '2_cup_'.$i;
                $team2_cup_.$i=$row['platzhalter'];

                if($team2_cup_.$i=1)
                {
                    $countteam2=$countteam2+1;
                }
            }
        }
        //Countteam1 & 2 and 1_getroffene Cups & 2_getroffene Cups senden
        $statementcups=$pdo->prepare("UPDATE spiele SET 1_getroffenecups=$countteam1 and 2_getroffenecups=$countteam2  WHERE spiel_id=$spiel_id");
        $statementcups->execute();

        //Puntke Update
        if($countteam1>$countteam2)
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet1=2, punktet2=0 WHERE spiel_id=$spiel_id");
                $statement->execute();
            }
            elseif($getroffeneCups2>$getroffeneCups1)
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet2=2, punktet1=0 WHERE spiel_id=$spiel_id");
                $statement->execute();
            }
            else
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet2=1, punktet1=1 WHERE spiel_id=$spiel_id");
                $statement->execute();
            }
        */
	}

?>

