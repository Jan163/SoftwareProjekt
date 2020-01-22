<?php 
include('config.php');
//$spiel_id=$_SESSION['spiel_id'];

    //hier müssen alle Cups geupadtet werden
    //updaten
 
 
    if(isset($_POST['submit']))
    {
        $spiel_id=$_POST['spiel_id'];
        $team1array=array();
        $team2array=array();
        for ($mannschaft1=1; $mannschaft1 <=10 ; $mannschaft1++) 
        { 
            if(isset($_POST['1_cup_'.$mannschaft1]))
            {
                if($_POST['1_cup_'.$mannschaft1] == '1')
                {
                    $team1array[$mannschaft1]=1;
                }
                else
                {
                    $team1array[$mannschaft1]=0;
                }
            }
            else
            {
                $team1array[$mannschaft1]=0;
            }
        

        }

        for ($mannschaft2=1; $mannschaft2 <=10 ; $mannschaft2++) 
        { 
            if(isset($_POST['2_cup_'.$mannschaft2]))
            {
                if($_POST['2_cup_'.$mannschaft2] == '1')
                {
                    $team2array[$mannschaft2]=1;
                }
                else
                {
                    $team2array[$mannschaft2]=0;
                }
            }
            else
            {
                $team2array[$mannschaft2]=0;
            }

        }
    
        
        //Update der Cups 

        
		$statementupdate=$pdo->prepare("UPDATE spiele SET 1_cup_1=$team1array[1],1_cup_2=$team1array[2],1_cup_3=$team1array[3],1_cup_4=$team1array[4],1_cup_5=$team1array[5],
        1_cup_6=$team1array[6],1_cup_7=$team1array[7],1_cup_8=$team1array[8],1_cup_9=$team1array[9],1_cup_10=$team1array[10],2_cup_1=$team2array[1],
        2_cup_2=$team2array[2],2_cup_3=$team2array[3], 2_cup_4=$team2array[4],2_cup_5=$team2array[5],2_cup_6=$team2array[6],
        2_cup_7=$team2array[7],2_cup_8=$team2array[8], 2_cup_9=$team2array[9], 2_cup_10=$team2array[10]  WHERE spiel_id=$spiel_id");
        $statementupdate->execute();
        
        //Count abfrage wie viele Cups pro team getroffen werden //Team1
        //In der Datenbank noch die Cups auf Standard 1 setzten.
        $countteam1=0;
        $countteam1array=array();
        $statementselectteam1=("SELECT 1_cup_1,1_cup_2,1_cup_3,1_cup_4,1_cup_5,1_cup_6,1_cup_7,1_cup_8,1_cup_9,1_cup_10 FROM spiele where spiel_id=$spiel_id");
        foreach($pdo->query($statementselectteam1) as $row)
        { 
            for ($i=1; $i <=10 ; $i++) { 
                $countteam1array[$i] = $row['1_cup_'.$i];
                
                    $countteam1=$countteam1+$countteam1array[$i];
            }
        }
        
        //Count abfrage wie viele Cups pro team getroffen werden Team 2
        //In der Datenbank noch die Cups auf Standard 1 setzten.
        $countteam2=0;
        $countteam2array=array();
        $statementselectteam2=("SELECT 2_cup_1,2_cup_2,2_cup_3,2_cup_4,2_cup_5,2_cup_6,2_cup_7,2_cup_8,2_cup_9,2_cup_10 FROM spiele where spiel_id=$spiel_id");
        foreach($pdo->query($statementselectteam2) as $row)
        { 
            for ($j=1; $j <=10 ; $j++) 
            { 
                $countteam2array[$j] = $row['2_cup_'.$j];
                
                    $countteam2=$countteam2+$countteam2array[$j];
            }
        }

        //Countteam1 & 2 and 1_getroffene Cups & 2_getroffene Cups senden
        $statementcups=$pdo->prepare("UPDATE spiele SET 1_getroffenecups=$countteam1,2_getroffenecups=$countteam2  WHERE spiel_id=$spiel_id");
        $statementcups->execute();

        //Puntke Update
        if($countteam1<$countteam2)
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet1=2, punktet2=0 WHERE spiel_id=$spiel_id");
                $statement->execute();
            }
            elseif($countteam2<$countteam1)
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet2=2, punktet1=0 WHERE spiel_id=$spiel_id");
                $statement->execute();
            }
            else
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet2=1, punktet1=1 WHERE spiel_id=$spiel_id");
                $statement->execute();

            }
        // Cups an die Teams senden

        header('Location:'.$_SERVER['HTTP_REFERER']); 
        die();
		
	}

?>

