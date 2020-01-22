<?php 
include('config.php');
$turnier_id=$_SESSION['turnier_id'];

	//insert
	if (isset($_GET['save_team'])) {
		$count="SELECT COUNT(team.turnier_id) as anzahlTeams,t.teams_pro_gruppe as groesse, t.gruppengroesse as gruppengroesse FROM team,turnieroptionen as t WHERE t.turnier_id = '$turnier_id' and team.turnier_id='$turnier_id'";
		foreach($pdo->query($count) as $row)
						{ 
							$anzahlteams=$row['anzahlTeams'];
							$groesse = $row['groesse'];
							$gruppengroesse = $row['gruppengroesse'];
							
						}
		if ($gruppengroesse==0)
		{				
			if($anzahlteams<$groesse)
			{
				$name = $_GET['Team_Name'];
				$statement=$pdo->prepare("INSERT INTO team (`Team_ID`, `Team_Name`, `Turnier_ID`) VALUES (?, ?, ?);");
				$statement->execute(array(NULL, $name, $turnier_id));//Die TurnierID noch auf die jeweils aktuelle Anpassen
			}
			else if($anzahlteams>=$groesse)
			{
				$_SESSION['toManyTeams'] = '<p align="center">Mehr Teams in der Eingabe nicht möglich!</p>';
				header("location: teameingabe.php");
				die();
			}
		}
		else
		{
			$name = $_GET['Team_Name'];
			$statement=$pdo->prepare("INSERT INTO team (`Team_ID`, `Team_Name`, `Turnier_ID`) VALUES (?, ?, ?);");
			$statement->execute(array(NULL, $name, $turnier_id));//Die TurnierID noch auf die jeweils aktuelle Anpassen
		}

	}

	//updaten
	if(isset ($_GET['update_team'])){
		$id= $_GET['id'];
		$name= $_GET['Team_Name'];
		$statement=$pdo->prepare("UPDATE team SET Team_Name='$name' WHERE Team_ID=$id");
		$statement->execute();

	}
	//delete
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		$statement=$pdo->prepare("DELETE FROM team WHERE Team_ID=$id");
		$statement->execute();

	}
?>

