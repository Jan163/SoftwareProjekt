<?php
include('config.php');
$turnier_id = $_SESSION['turnier_id']; 

    if(isset($_POST['punkteSenden'])) //Punkte senden nur in der Gruppenphase
    {

        $sqlrunde="SELECT aktuelleRunde FROM turnieroptionen WHERE turnier_id=$turnier_id"; //Aktuelle Runde ermitteln
        foreach($pdo->query($sqlrunde) as $row)
        {
            $aktuelleRunde=$row['aktuelleRunde'];
        }
        
        //Punkte Update der Spiele der aktuellen Runde
        $sqlpunkteupdate="SELECT 1_getroffenecups,2_getroffenecups,spiel_id,team_id1,team_id2 FROM `spiele` WHERE turnier_id=$turnier_id and runde=$aktuelleRunde";
        foreach($pdo->query($sqlpunkteupdate) as $flow)
        {
            $spiel_id=$flow['spiel_id'];
            $getroffeneCups1=$flow['1_getroffenecups'];
            $getroffeneCups2=$flow['2_getroffenecups'];
            $team_id1=$flow['team_id1'];
            $team_id2=$flow['team_id2'];
            if($getroffeneCups1>$getroffeneCups2)
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet1=2, punktet2=0 WHERE spiel_id=$spiel_id");
                $statement->execute();
                $pointscups1=$pdo->prepare("UPDATE team SET punkte=punkte + 2,getroffenecups=getroffenecups+$getroffeneCups1 WHERE team_id=$team_id1");
                $pointscups1->execute();
                $cups2=$pdo->prepare("UPDATE team SET getroffenecups=getroffenecups+$getroffeneCups2 WHERE team_id=$team_id2");
                $cups2->execute();
            }
            elseif($getroffeneCups2>$getroffeneCups1)
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet2=2, punktet1=0 WHERE spiel_id=$spiel_id");
                $statement->execute();
                $pointscups2=$pdo->prepare("UPDATE team SET punkte=punkte + 2,getroffenecups=getroffenecups+$getroffeneCups2 WHERE team_id=$team_id2");
                $pointscups2->execute();
                $cups2=$pdo->prepare("UPDATE team SET getroffenecups=getroffenecups+$getroffeneCups1 WHERE team_id=$team_id1");
                $cups2->execute();
            }
            else
            {
                $statement=$pdo->prepare("UPDATE spiele SET punktet2=1, punktet1=1 WHERE spiel_id=$spiel_id");
                $statement->execute();
                $points1=$pdo->prepare("UPDATE team SET punkte=punkte + 1,getroffenecups=getroffenecups+$getroffeneCups1 WHERE team_id=$team_id1");
                $points1->execute();
                $points2=$pdo->prepare("UPDATE team SET punkte=punkte + 1,getroffenecups=getroffenecups+$getroffeneCups2 WHERE team_id=$team_id2");
                $points2->execute();
            }
        }
        $aktuelleRunde=$aktuelleRunde+1;
        $updaterunde=$pdo->prepare("UPDATE turnieroptionen SET aktuellerunde=$aktuelleRunde WHERE turnier_id=$turnier_id");
        $updaterunde->execute();

        $_SESSION['turnier_id']=$turnier_id;
        header("location: ../manager.php");
    }

    if(isset($_POST['koerstellen'])) //Erste Runde der Ko-Phase erstellen, egal ob Gruppenphase oder nicht
    {

        $sqlweiter="SELECT teams_pro_gruppe FROM turnieroptionen WHERE turnier_id=$turnier_id";
            foreach($pdo->query($sqlweiter) as $row)
            {
                $weiter=$row['teams_pro_gruppe'];
            }
        $koteams=array();
        foreach($pdo->query("SELECT gruppengroesse FROM turnieroptionen WHERE turnier_id=$turnier_id") as $optionen)
        {
            $gruppengroesse=$optionen['gruppengroesse'];
        }
        if($gruppengroesse!=0)
        {
            $sql="SELECT MAX(gruppen_id) as anzahl FROM `team` WHERE turnier_id=$turnier_id";
            foreach($pdo->query($sql) as $gruppenganzahl)
            {
                $gruppenanzahl=$gruppenganzahl['anzahl'];
            }
            $sqlmax_tische="SELECT max(tischnr) as max_tische FROM spiele where turnier_id=$turnier_id";
            foreach($pdo->query($sqlmax_tische) as $row)
            {
                $max_tische=$row['max_tische'];
            }
            

            //echo $gruppenanzahl . ": Gruppenanzahl"; //Ausgabe

            $gruppenteams=array();
            $teamarray=array();
            $zaehler = 1;
            for ($a=0; $a < $gruppenanzahl; $a++) 
            { 
                $teamarray=array();
                $row="SELECT COUNT(`team_id`) AS anzahl FROM team WHERE gruppen_id=$zaehler and turnier_id=$turnier_id ";
                foreach($pdo->query($row) as $anzahl)
                {
                    $anzahlteamsprogruppe=$anzahl['anzahl'];  
                }
                // echo $anzahlteamsprogruppe; //Ausgabe

                $teamspunkte="SELECT team_id,punkte FROM team WHERE gruppen_id=$a+1 and turnier_id=$turnier_id order by punkte desc";
                foreach($pdo->query($teamspunkte) as $punkte)
                {
                    $teamsgeordnet=$punkte['team_id'];
                    array_push($teamarray,$teamsgeordnet);
                  
                }
                array_push($gruppenteams,$teamarray);
            }
            $abc=array();
            for ($platz=0; $platz <= $weiter ; $platz++) //bsp:. 8 Teams weiter
            { 
                for ($gruppe=0; $gruppe < $gruppenanzahl; $gruppe++) //bsp.:4 Gruppen
                { 
                    $abc = $gruppenteams[$gruppe];
                    array_push($koteams,$abc[$platz]);
                    if(count($koteams)>=$weiter){
                    break;
                    }
                }
                if(count($koteams)>=$weiter)
                {
                break;
                }
            }
        }
        
        
        else
        {	//Array wenn keine Gruppenphase erstellt ist
            $koteamsql="SELECT team_id FROM team WHERE turnier_id=$turnier_id";
                foreach($pdo->query($koteamsql) as $row)
                {
                    array_push($koteams,$row['team_id']);
                }
        }

        //Einfügen der Ko-Spiele in die Datenbank
        if($weiter==16)
        {
            $finalrunde="Achtelfinale";
        }
        elseif($weiter==8)
        {
            $finalrunde="Viertelfinale";
        }
        elseif($weiter==4)
        {
            $finalrunde="Halbfinale";
        }
        else
        {
            $finalrunde="Finale";
        }
        $j=1;
        $k=1;
        for($i=0;$i<=$weiter;$i++)
        {	
            if($j<=$max_tische)
            {
                $sqlfinals="INSERT INTO spiele (`team_id1`,`team_id2`,`turnier_id`,`tischnr`,`runde`) VALUES(?, ?, ?, ?, ?);";
                $team1=$koteams[$i];
                $i++;
                $team2=$koteams[$i];
                $statement=$pdo->prepare($sqlfinals);
                $statement->execute(array($team1,$team2,$turnier_id,$j,$finalrunde));
                $j++;
            }
            else 
            {
                $sqlfinals="INSERT INTO spiele (`team_id1`,`team_id2`,`turnier_id`,`tischnr`,`runde`) VALUES(?, ?, ?, ?, ?);";
                $team1=$koteams[$i];
                $i++;
                $team2=$koteams[$i];
                $statement=$pdo->prepare($sqlfinals);
                $statement->execute(array($team1,$team2,$turnier_id,$k,$finalrunde));
                $k++;
            }
        }
        $zahl=2;
        $weiter/=$zahl;
        $update=$pdo->prepare("UPDATE turnieroptionen SET uebrigeteams ='$weiter' WHERE turnier_id=$turnier_id");
        $update->execute();        
        //update von der nächsten finalsweiter $weiter=$weiter/2
       
        $updaterunde=$pdo->prepare("UPDATE `turnieroptionen` SET `aktuellerunde` = '$finalrunde' WHERE `turnieroptionen`.`turnier_id` = $turnier_id");
        
        $updaterunde->execute();
        
        $_SESSION['turnier_id']=$turnier_id;
        header("location: ../manager.php");
        
    } // End Turnier erstellen Button
    

    if(isset($_POST['rundekoerstellen'])) //nächste KO-Runde nach erster Ko-Erstellung, egal ob Gruppenphase oder nicht
    {
        
        $sqlweiter="SELECT uebrigeteams FROM turnieroptionen WHERE turnier_id=$turnier_id";
        foreach($pdo->query($sqlweiter) as $row)
        {
            $weiter=$row['uebrigeteams'];
        }
        
        if($weiter!=1)
        {

            $weiter=$weiter*2;

            //Einfügen der Ko-Spiele in die Datenbank
            if($weiter==16)
            {
                $finalrunde="Achtelfinale";
            }
            elseif($weiter==8)
            {
                $finalrunde="Viertelfinale";
            }
            elseif($weiter==4)
            {
                $finalrunde="Halbfinale";
            }
            else
            {
                $finalrunde="Finale";
            }
            $sqlpunkteupdate="SELECT 1_getroffenecups,2_getroffenecups,spiel_id,team_id1,team_id2 FROM `spiele` WHERE turnier_id=$turnier_id and runde='$finalrunde'";
            foreach($pdo->query($sqlpunkteupdate) as $flow)
            {
                $spiel_id=$flow['spiel_id'];
                $getroffeneCups1=$flow['1_getroffenecups'];
                $getroffeneCups2=$flow['2_getroffenecups'];
                $team_id1=$flow['team_id1'];
                $team_id2=$flow['team_id2'];
                if($getroffeneCups1>$getroffeneCups2)
                {
                    $statement=$pdo->prepare("UPDATE spiele SET punktet1=2, punktet2=0 WHERE spiel_id=$spiel_id");
                    $statement->execute();
                }
                elseif($getroffeneCups2>$getroffeneCups1)
                {
                    $statement=$pdo->prepare("UPDATE spiele SET punktet2=2, punktet1=0 WHERE spiel_id=$spiel_id");
                    $statement->execute();
                }
            }

            $sqlrunde="SELECT aktuellerunde FROM turnieroptionen WHERE turnier_id=$turnier_id";
            foreach($pdo->query($sqlrunde) as $flow)
            {
                $aktuellerunde=$flow['aktuellerunde'];
            }

            //SELECT von den Spielen (Gewinner) ins Array
            $koteams=array();
            $koteamsql="SELECT team_id1,punktet1,team_id2,punktet2 FROM spiele WHERE turnier_id=$turnier_id AND runde='$finalrunde'";
            foreach($pdo->query($koteamsql) as $show)
            {
                $team_id1=$show['team_id1'];
                $team_id2=$show['team_id2'];
                $punktet1=$show['punktet1'];
                $punktet2=$show['punktet2'];

                if($punktet1>$punktet2)
                {
                    array_push($koteams,$team_id1);
                }
                else
                {
                    array_push($koteams,$team_id2);
                }
                
            }

            $weiter=$weiter/2;
            //Einfügen der Ko-Spiele in die Datenbank
            if($weiter==16)
            {
                $finalrunde="Achtelfinale";
            }
            elseif($weiter==8)
            {
                $finalrunde="Viertelfinale";
            }
            elseif($weiter==4)
            {
                $finalrunde="Halbfinale";
            }
            else
            {
                $finalrunde="Finale";
            }
            $j=1;
            for($i=0;$i<=$weiter;$i++)
            {	
                $sqlfinals="INSERT INTO spiele (`team_id1`,`team_id2`,`turnier_id`,`tischnr`,`runde`) VALUES(?, ?, ?, ?, ?);";
                $team1=$koteams[$i];
                $i++;
                $team2=$koteams[$i];
                $statement=$pdo->prepare($sqlfinals);
                $statement->execute(array($team1,$team2,$turnier_id,$j,$finalrunde));
                $j++;
            }
            $zahl=2;
            $weiter/=$zahl;
            $update=$pdo->prepare("UPDATE turnieroptionen SET uebrigeteams ='$weiter' WHERE turnier_id=$turnier_id");
            $update->execute();        
            //update von der nächsten finalsweiter $weiter=$weiter/2
        
            //Aktuellerunde wird upgedated
            $updaterunde=$pdo->prepare("UPDATE turnieroptionen SET aktuellerunde='$finalrunde' WHERE turnier_id=$turnier_id");
            $updaterunde->execute();

            $_SESSION['turnier_id']=$turnier_id;
            header("location: ../manager.php");
        }
        else {
            $_SESSION['full'] = '<p align="center">Finalansetzung steht schon!</p>';
		    header("location: ../manager.php");
		    die();
        }
        
    }

?>