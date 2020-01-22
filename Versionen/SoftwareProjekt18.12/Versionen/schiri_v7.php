<?php  include('./include/config.php');?>
<?php  include('./include/TeamsDB.php'); ?>



<!DOCTYPE html>
<html>

<head>
<title>Ansicht Schiedsrichter</title>

<h1>Schiedsrichter</h1>

<link rel="stylesheet" type="text/css" href="css/styleschiri.css">

<!-- JAVA TIMER 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
        <div class="timer">
            <span class="minute">00</span>:<span class="second">10</span>
        </div>
        <div class="control">
            <button onClick="timer.start(1000)">Start</button> 
            <button onClick="timer.stop()">Stop</button> 
            <button onClick="timer.reset(60)">Reset</button> 
            
            <button onClick="timer.mode(0)">Count down</button>
        </div>

  <script  src="js/timer.js"></script>

JAVA TIMER ENDE -->

</head>
                

<body>

<form method="post"> <!--Wichtig PHP-->

        <br>
        <br>
        <br>

<label>
Turnier-ID auswählen <select name="dropdown_turnierid" size="1">
          	  
		  <?php
	$abfrage = "SELECT Turnier_ID FROM Spiele";
	foreach($pdo->query($abfrage) as $row) { ?>
	<option>
		<tr>
			<td>
			
			<?php echo $row['Turnier_ID']; ?>
			
			</td>				
		</tr>
	</option>
	<?php } ?>
		  
        </select>
 </label>

<br>
<br>

<form action="#" method="post">
<label>
Spiel-ID auswählen <select name="dropdown_spielid" size="1">
          	  
		  <?php
	$abfrage = "SELECT Spiel_ID FROM Spiele";
	
	foreach($pdo->query($abfrage) as $row) { ?>
	<option value="spielid">
		<tr>
			<td>
			
			<?php echo $row['Spiel_ID']; ?>
			
			</td>				
		</tr>
	</option>
	<?php } ?>
	</select>
		  <input type="submit" name="submit" value="Auswahl bestätigen" />
		  </form>
		  
		  
<?php
//if(isset($_POST['submit'])) ?>
	
<?php
//$abfrage2 = "SELECT Team_ID1 FROM Spiele";
	//foreach($pdo->query($abfrage2) as $row) { ?>
	
	<?php //echo $row['Team_ID1'];?>
<?php //} ?>


<?php
if(isset($_POST['submit'])){
$selected_werte = $_POST['dropdown_spielid'];  // gespeicherte/ausgewählte Werte in einer Variable
echo "Ausgabe: " .$selected_werte;  // Ausgabe der Mannschaften
}
?>    

 </label>

<br>
<br>

<label>
Runde auswählen <select name="dropdown_runde" size="1">
          	  
		  <?php
	$abfrage = "SELECT Runde FROM Spiele";
	foreach($pdo->query($abfrage) as $row) { ?>
	<option>
		<tr>
			<td>
			
			<?php echo $row['Runde']; ?>
			
			</td>				
		</tr>
	</option>
	<?php } ?>
		  
        </select>
 </label>


<br>
<br>
<br>






<table style="width:60%">

  <tr>
        <td></td>
        

  </tr>

  <!-- TableRow 1 -->
  <tr>

    <td>
        <label class="container">
        <input type="checkbox" class="cups" name="cup1">
        <span class="checkmark"></span>
    </td>
<td></td>
<td></td>
<td></td>
<td rowspan="7" style="background-color:black" align="center"></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup11">
        <span class="checkmark"></span>
    </td>
</tr>
<!--Reihe 2-->
  <tr>
    <td></td>
    <td>            
        <label class="container">
        <input type="checkbox" class="cups" name="cup5">
        <span class="checkmark"></span></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup15">
        <span class="checkmark"></span>
    </td>
    </tr>
  
 
  <!-- TableRow 3 -->
   <tr>

        <td>
                <label class="container">
            <input type="checkbox" class="cups" name="cup2">
            <span class="checkmark"></span>
        </td>
<td></td>
        <td>
                <label class="container">
            <input type="checkbox" class="cups" name="cup8">
            <span class="checkmark"></span>
        </td>
<td></td>
<td></td>
<td></td>
    <td>        <label class="container">
        <input type="checkbox" class="cups" name="cup18">
        <span class="checkmark"></span>
    </td>
<td></td>
    <td>        <label class="container">
        <input type="checkbox" class="cups" name="cup12">
        <span class="checkmark"></span>
    </td>
</tr>
<!--Reihe 4-->
<tr>

<td></td>
    <td>        <label class="container">
            <input type="checkbox" class="cups" name="cup6">
            <span class="checkmark"></span>
        </td>
        <td></td>
        <td>        <label class="container">
                <input type="checkbox" class="cups" name="cup10">
                <span class="checkmark"></span>
            </td>
        <td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup20">
        <span class="checkmark"></span>
    </td>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup16">
        <span class="checkmark"></span>
    </td>
<td></td>

</tr>
<!--Reihe 5-->
<tr>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup3">
        <span class="checkmark"></span>
    </td>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup9">
        <span class="checkmark"></span>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td>        <label class="container">
            <input type="checkbox" class="cups" name="cup19">
            <span class="checkmark"></span>
        </td>
    <td></td>
    <td>        <label class="container">
            <input type="checkbox" class="cups" name="cup13">
            <span class="checkmark"></span>
        </td>
</tr>
<!--Reihe 6-->
<tr>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup7">
        <span class="checkmark"></span>
    </td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup17">
        <span class="checkmark"></span>
    </td>
<td></td>


</tr>
<!--Reihe 7-->
<tr>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup4">
        <span class="checkmark"></span>
    </td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>        <label class="container">
        <input type="checkbox" class="cups" name="cup14">
        <span class="checkmark"></span>
    </td>




</tr>
</table>

<br>
<br>

<input type="submit" value="Bestätigung">


</form>

<!-- PHP -->
<?php

 $ergebnislinks = 10;

 if(isset($_POST['cup1'])){
  $ergebnislinks -= 1;
 }

 if(isset($_POST['cup2'])){
  $ergebnislinks -= 1;
 }

 if(isset($_POST['cup3'])){
  $ergebnislinks -= 1;
 }
 
 if(isset($_POST['cup4'])){
  $ergebnislinks -= 1;
 }

if(isset($_POST['cup5'])){
  $ergebnislinks -= 1;
 }

if(isset($_POST['cup6'])){
  $ergebnislinks -= 1;
 }

if(isset($_POST['cup7'])){
  $ergebnislinks -= 1;
 }

if(isset($_POST['cup8'])){
  $ergebnislinks -= 1;
 }

if(isset($_POST['cup9'])){
  $ergebnislinks -= 1;
 }

if(isset($_POST['cup10'])){
  $ergebnislinks -= 1;
 }


 $ergebnisrechts = 10;

 if(isset($_POST['cup11'])){
  $ergebnisrechts -= 1;
 }

 if(isset($_POST['cup12'])){
  $ergebnisrechts -= 1;
 }

 if(isset($_POST['cup13'])){
  $ergebnisrechts -= 1;
 }
 
 if(isset($_POST['cup14'])){
  $ergebnisrechts -= 1;
 }

if(isset($_POST['cup15'])){
  $ergebnisrechts -= 1;
 }

if(isset($_POST['cup16'])){
  $ergebnisrechts -= 1;
 }

if(isset($_POST['cup17'])){
  $ergebnisrechts -= 1;
 }

if(isset($_POST['cup18'])){
  $ergebnisrechts -= 1;
 }

if(isset($_POST['cup19'])){
  $ergebnisrechts -= 1;
 }

if(isset($_POST['cup20'])){
  $ergebnisrechts -= 1;
 }


 echo " Ergebnis:"," ",$ergebnislinks," : ",$ergebnisrechts;

?>

<!-- PHP ENDE -->



</body>
</html>


