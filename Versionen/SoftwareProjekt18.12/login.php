<?php require('./include/config.php');

if(isset($_POST['submit']))
{
	$turniername = $_POST['turniername'];
	$passwort =$_POST['password'];


	$statement = $pdo->prepare("SELECT turnier_id,managercode,zuschauercode FROM turnieroptionen where turnier_name = '$turniername'");
	$statement ->execute(array($turniername));
	while($row = $statement->fetch()){
		$managercode=$row['managercode'];
		$zuschauercode=$row['zuschauercode'];
		$turnier_id=$row['turnier_id'];
	}

	
	if($managercode==$passwort)
	{
		$_SESSION['turnier_id']=$turnier_id;
		header("location: manager.php");
		die();
	}
	elseif ($zuschauercode==$passwort)
	{
		$_SESSION['turnier_id']=$turnier_id;
		header("location: schiri.php");
		die();
	}
	else 
	{
		$_SESSION['loginError'] = '<p align="center">Tuniername oder Passwort falsch.</p>';
		header("location: start.php");
		 die();
	}
}
?>
