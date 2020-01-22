<?php
include('./include/config.php');
?>

<?php
if($_POST['testspielid'])
{
	$sql = "SELECT testcup1,testcup2 
			FROM testtabelle 
			where testspielid = '" . $_POST['testspielid']."'";
			
	$result=mysqli_query($pdo,$sql);
	$data[]= $row;
}
echo json_encode($data);
?>