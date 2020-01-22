<?php
include('config.php');


$turnier_id = $_SESSION['turnier_id']; //Das ist die aktuelle Turnier_id;

//Anweisung ob Button Turniererstellen gedrückt wurde
if(isset($_POST['turniererstellen']))
{

	$statement=$pdo->prepare("DELETE FROM spiele WHERE turnier_id=$turnier_id");
	$statement->execute();
	foreach($pdo->query("SELECT gruppengroesse,teams_pro_gruppe FROM turnieroptionen WHERE turnier_id=$turnier_id") as $optionen)
	{
    	$gruppengroesse=$optionen['gruppengroesse'];
		$teamsprogruppe=$optionen['teams_pro_gruppe'];
	}
	
	$sql="SELECT * FROM team WHERE turnier_id=$turnier_id";
	$liste=array();
	foreach($pdo->query($sql) as $row)
	{
	array_push($liste,$row['team_id']);
	}

	if($gruppengroesse != 0)
	{
		$anzahl=count($liste);
		$gruppen=$anzahl/$gruppengroesse;
		$gruppen=ceil($gruppen);
		$id=$liste[0];
		
		for($j=1;$j<=$gruppen;$j++)
		{
			for($i=1;$i<=$gruppen; $i++)
			{
				
				$statement=$pdo->prepare("UPDATE team SET gruppen_id=$i WHERE team_id=$id");
				$statement->execute();
				$id=next($liste);
			}
		}
		$runde=1;
		for($k=0;$k<=$gruppen;$k++)
		{
			
			$sqlteams="SELECT team_id FROM team WHERE turnier_id=$turnier_id AND gruppen_id=$k";
			unset($gruppenarray);
			$gruppenarray=array();
			foreach($pdo->query($sqlteams) as $row)
			{
				array_push($gruppenarray,$row['team_id']);
			}
		
		
			for($i=0;$i<count($gruppenarray);$i++)
			{
				for($j=0;$j<count($gruppenarray);$j++)
				{   
					if ($i<$j)
					{
						$statement=$pdo->prepare("INSERT INTO spiele (`team_id1`,`team_id2`,`turnier_id`,`tischnr`) VALUES(?, ?, ?, ?);");
						$statement->execute(array($gruppenarray[$j],$gruppenarray[$i],$turnier_id,$k));
						
					}
				}
			}
			
		}
		for($i=1;$i<=$gruppen;$i++) //für die anzahl der runden
		{

			$sql="SELECT COUNT(`spiel_id`) AS anzahl FROM spiele WHERE tischnr=$i and turnier_id=$turnier_id"; //Anzahl der spiele pro gruppe
			foreach($pdo->query($sql) as $anzahl)
				{
					$anzahlspiele=$anzahl['anzahl'];
				}
			
			$spielrunden="SELECT spiel_id FROM `spiele` WHERE tischnr=$i and turnier_id=$turnier_id";
			$arraypush=array();
			foreach($pdo->query($spielrunden) as $row)
			{
				//$arraypush=$row['spiel_id'];
				array_push($arraypush,$row['spiel_id']);
			}
			$counter=1;
			$k=$anzahlspiele-1;
			for($j=0;$j<$anzahlspiele/2;$j++)
			{	
				$statement=$pdo->prepare("UPDATE spiele SET runde=$counter WHERE spiel_id=$arraypush[$j]");
				$statement->execute();
				$counter++;
				$statement=$pdo->prepare("UPDATE spiele SET runde=$counter WHERE spiel_id=$arraypush[$k]");
				$statement->execute();
				$counter++;
				$k--;
			}
		}
	}
	
	$_SESSION['turnier_id']=$turnier_id;
	header("location: ../manager.php");
} // End Turnier erstellen Button

?>