<?php
require('./include/config.php');

$password = 'test';
$hashedpassword = password_hash($password,PASSWORD_DEFAULT);

if(isset($_POST['submit']))
{

	if (password_verify($_POST['password'], $hashedpassword)) 
	{

		$_SESSION['login'] = TRUE;
		header("Location: ./teameingabe.html");
		die();
	}	
	else 
	{
		 $_SESSION['loginError'] = '<p align="center">Passwort falsch.</p>';
		 header("Location: ./index.php");
	  	die();
	}

}
else if(isset($_POST['logout']))
{
	$_SESSION['login'] = FALSE;
	header("Location: ./index.php");
	die();	
}
?>
