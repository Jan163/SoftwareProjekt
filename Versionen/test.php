<html>
<head>

</head>
<body>

<hr>
<form method="post">
 <input type="checkbox" name="a">
 <input type="checkbox" name="b">
 <input type="checkbox" name="c">
 <input type="submit">
</form>



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



</body>
</html>
