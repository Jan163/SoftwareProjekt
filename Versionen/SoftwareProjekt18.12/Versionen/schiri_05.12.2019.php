<?php  
    include('./include/config.php');
    include('./include/TeamsDB.php'); 
    

    $turnier_id = $_SESSION['turnier_id']; //Das ist die aktuelle Turnier_id;
    $_SESSION['turnier_id'] = $turnier_id;
?>

<!DOCTYPE html>
<html>

<head>
<title>Ansicht Schiedsrichter</title>
<h1>Schiedsrichter</h1>
<link rel="stylesheet" type="text/css" href="css/styleschiri.css">

</head>              
<body>

<form method="post"> 

    <br><br><br><br><br>
    <!-- DROPDOWN-RUNDEN AUSWAHL -->
    <label>
    Runde auswählen 
            <select name="dropdown_runde" size="1">
    <?php
            $abfrage = "SELECT DISTINCT runde FROM spiele";
            foreach($pdo->query($abfrage) as $row) 
            {        
    ?>
            <option value=<?php echo $row['runde'];?>>
    <?php 
            echo $row['runde']; 
    ?>
            </option>
    <?php 
            } 
    ?>
            </select>
    </label>
    <!-- DROPDOWN-RUNDEN AUSWAHL ENDE -->

    <!-- BUTTON-DATEN ABSENDEN -->
    <input type="submit" name="anzeigen" value="Runde bestätigen">

    <br><br>

    <?php
            if(isset($_POST['anzeigen']))
            {
            $selected_werte = $_POST['dropdown_runde'];  // gespeicherte/ausgewählte Werte in einer Variable
            echo "Aktuelle Runde: " .$selected_werte;  // Ausgabe der Runde
            }
    ?> 
    <br><br>
    <!-- BUTTON-DATEN ABSENDEN -->

    <!-- TISCH-NR AUSWAHL -->
    <label>
            <u>Tisch-Nr und Spielauswahl:</u>

    <?php
            if(isset($_POST['anzeigen']))
            {
            
            $runde=$_POST['dropdown_runde'];
            $abfrage = "SELECT tischnr,spiel_id FROM spiele Where runde=$runde";
            
                foreach($pdo->query($abfrage) as $row) 
                {  

                $spielid= $row['spiel_id'];
        ?>    
                <tr>
                    <td>
                    <p></p>
                <input type="checkbox" name="tischnr" value="<?php echo $row['spiel_id']?>" onclick="tische(this);"> 
        <?php 
                echo "Tisch-Nr: ".$row['tischnr'];   
        ?>

        <?php 
                echo "Spiel-ID: ".$row['spiel_id'];
        ?>
                    </td>				
                </tr>
                <div id="<?php echo $row['spiel_id']?>"></div>
        <?php 
                }
            } 
    ?>	   
    </label>
    <!-- TISCH-NR AUSWAHL ENDE -->

    <!-- SKRIPT-TISCHE -->
    <script>

        function check(cb) 
        {
        //document.write(cb.value)

        if(cb.checked)
        {
            document.write(cb.value);
            //$test=$_POST['1_cup_1'];
            //echo "$test";
            //$statement = $pdo->prepare("UPDATE spiele SET 1_cup_1 = ? WHERE spielid = ?");
            //$statement->execute(array(0,1066));

            
        

        
            //document.write("TestAaaaaaaaaaaa");  
        }
        else
        {
            //document.write("ELSSSSSSE");
        }
    
        }

        
    </script>
    

<!-- TISCHANZEIGE SKRIPT-->

    <script>
    function tische(tischauswahl)
    {
        if(tischauswahl.checked)
        {
            var string ='<table style="width:60%">'+
                        '<tr>'+
                        '<td></td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>'+                      
                        '<label class="container">'+
                        '<input type="checkbox" id="1_cup_1" class="cups" name="1_cup_1" value='+tischauswahl.value+' onclick="check(this);">'+    
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<br><br>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td rowspan="7" style="background-color:black" align="center"></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="2_cup_1">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td></td>'+
                        '<td>'+            
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_5">'+
                        '<span class="checkmark"></span></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_5">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_2">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_8">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="2_cup_8">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="2_cup_2">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_6">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_1">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="2_cup_10">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>       '+ 
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="2_cup6">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>'+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_3">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_9">'+
                        '<span class="checkmark"></span> '+
                        '</td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>       '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="2_cup_9">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_3">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_7">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_7">'+
                        '<span class="checkmark"></span>'+
                        ' </td>'+
                        '<td></td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_4">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>        '+
                        '<label class="container">'+
                        '<input type="checkbox" class="cups" name="1_cup_4">'+
                        '<span class="checkmark"></span>'+
                        '</td>'+
                        '</tr>'+
                        '</table>'+
                        '<br>'+
                        '<br>';

            document.getElementById(tischauswahl.value).innerHTML = string;
        
        }
        else
        {
            var string = "";
            document.getElementById(tischauswahl.value).innerHTML = string;
        }
    }
    </script>



<!-- TISCHANZEIGE SKRIPT-->
    
        
    <?php
        /*

    if (isset($_POST['checkbox'])) 
    {

        $value = $_POST['checkbox'];


            if($value=="1"){
                mysql_query("UPDATE 1_cup_1 SET aktive =0 where spiel_id =1066" );
                echo "Wert wurde auf 0 gesetzt";
            }
            else if($value=="0"){
                mysql_query("UPDATE 1_cup_1 SET aktive = 1 where spiel_id =1066" );
                echo "Wert wurde auf 1 gesetzt";
            }
    }
    */
    ?>

    <!-- SKRIPT-CHECK NEU-->


    <!-- SKRIPT-CHECK ENDE -->








    <!-- SKRIPT-CHECK ALT-->

    <script>
    /*
        function check(cb) 
        {
        document.write(cb.value)

        if(cb.checked)
        {
            $abfrage2 = <?php /*"SELECT tischnr,spiel_id FROM spiele Where spielid=1050";*/?>

            document.write("TestAaaaaaaaaaaa");  
        }
        else
        {
            document.write("ELSSSSSSE");
        }
    
        }

        */
    </script>
    <!-- SKRIPT-CHECK ENDE -->







</form>




</body>
</html>
