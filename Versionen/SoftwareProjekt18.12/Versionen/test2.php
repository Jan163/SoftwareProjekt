
<?php

 $punkte = 1;

 if(isset($_POST['a'])){
  $punkte += 2;
 }

 if(isset($_POST['b'])){
  $punkte += 3;
 }

 if(isset($_POST['c'])){
  $punkte += 4;
 }

 echo($punkte);
 
 echo "Die Anzahl der Punkte lautet",$punkte;

?>


