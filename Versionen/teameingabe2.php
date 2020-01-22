<?php  include('./include/config.php');?>
<?php  include('./include/TeamsDB.php'); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		foreach($pdo->query("SELECT * FROM team WHERE Team_ID=$id and Turnier_ID=1")as $test){
		$name=$test['Team_Name'];
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css\styleteams.css">
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>



<table>
	<thead>
		<tr>
			<th>Name</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php
	$sqli ="SELECT Team_Name,Team_ID FROM team" ;
	foreach($pdo->query($sqli) as $row) { ?>
		<tr>
			<td><?php echo $row['Team_Name']; ?></td>
		
			<td>
				<a href="teameingabe.php?edit=<?php echo $row['Team_ID']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="teameingabe.php?del=<?php echo $row['Team_ID']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

<form>
	<form method="post" action="TeamsDB.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">
		<label>Name</label>
		<input type="text" name="Team_Name" value="<?php echo $name;?>">
	</div>
	<div class="input-group">
	
	<?php if ($update == true): ?>
		<button class="btn" type="submit" name="update_team" style="background: #556B2F;" >update</button>
	<?php else: ?>
		<button class="btn" type="submit" name="save_team" >Save</button>
	<?php endif ?>
	</div>
		
	</form>

</body>

</html>