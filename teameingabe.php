<?php  	
	include('./include/config.php');
	include('./include/TeamsDB.php'); 

	$turnier_id=$_SESSION['turnier_id'];
	$name="";
	$update= false;
  	
	$statement="SELECT Count(team_id) as teamcount From team Where turnier_id='$turnier_id'";
    foreach($pdo->query($statement)as $row)
        {
			
            $teamcount=$row['teamcount'];
		}
		
	    $statement="SELECT gruppengroesse,teams_pro_gruppe FROM turnieroptionen WHERE turnier_id ='$turnier_id'";
    foreach($pdo->query($statement) as $row)
                    { 
						$gruppengroesse=$row['gruppengroesse'];
						$teamsprogruppe=$row['teams_pro_gruppe'];
						
                    }

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		foreach($pdo->query("SELECT * FROM team WHERE team_id=$id and turnier_id=$turnier_id")as $test){
		$name=$test['team_name'];
		}
	}


	$_SESSION['turnier_id'] = $turnier_id;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styleteams.css">
</head>
<body>
<div class="card">
	<?php
	if($gruppengroesse!=0)
	{
		if($teamcount==$gruppengroesse*$gruppengroesse)
		{?>
		<div class="managerlink">
			<a href="manager.php?turnier_id=$turnier_id">Manager-Seite</a>
		</div>
		<?php 
		}
		else
		{
		?>
			<p><?php echo $teamcount?> Teams von <?php echo $gruppengroesse*$gruppengroesse?> Teams eingegeben.</p>
		<?php
		}
	}
	else
	{
		if($teamcount==$teamsprogruppe)
		{
			?>
			<div class="managerlink">
			<a href="manager.php?turnier_id=$turnier_id">Manager-Seite</a>
			</div>
		<?php 
		}
		else
		{
			?>
			<p><?php echo $teamcount?> Teams von <?php echo $teamsprogruppe?> Teams eingegeben.</p>
			<?php
		}
	}
		?>

	<div class="error-message" style="display: <?php if (isset($_SESSION['toManyTeams'])) {echo 'block';}else{echo 'none';}?>;"><?php if (isset($_SESSION['toManyTeams'])) {echo $_SESSION['toManyTeams']; unset($_SESSION['toManyTeams']); } ?></div>
	<form> 
	<form method="post" action="TeamsDB.php">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="Team_Name" autofocus requiered="true"  value="<?php echo $name;?>" >
		</div>
		<div class="input-group">
		
		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update_team" style="background: #556B2F;" >update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="save_team" >Save</button>
		<?php endif ?>
		</div>		
	</form>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		
		<?php
		$sqli ="SELECT team_name,team_id FROM team WHERE turnier_id=$turnier_id" ;
		foreach($pdo->query($sqli) as $row) { ?>
			<tr>
				<td><?php echo $row['team_name']; ?></td>
				<td>
					<a href="teameingabe.php?edit=<?php echo $row['team_id']; ?>" class="edit_btn" >Edit</a>
				</td>
				<td>
					<a href="teameingabe.php?del=<?php echo $row['team_id']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>

</div>
</body>

</html>