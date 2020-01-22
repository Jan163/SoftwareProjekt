<?php  
    include('./include/config.php');

    $turnier_id = $_SESSION['turnier_id']; //Das ist die aktuelle Turnier_id;
    $_SESSION['turnier_id'] = $turnier_id;

    
?>


<!DOCTYPE html>
<html>

    <head>
        <title>Ansicht Schiedsrichter</title>
        <link rel="stylesheet" type="text/css" href="css/styleschiri.css">
    </head>              
    <body>
    <div class="card">
        <table class="tablewatch">
                <tr>
                    <td><h1>Schiedsrichter</h1></td>
                </tr>
        </table>
        <script>
            function myFunction(cb) 
            {
                var id=cb.value;
                var x = document.getElementById(id);
                if (x.style.display === "none") 
                {
                    x.style.display = "block";
                }
                else
                {
                    x.style.display = "none";
                }
            }
        </script>
            <table class="tablewatch" >
                <tr>
                    <td >
                        <form method="post"> 
                            <!-- DROPDOWN-RUNDEN AUSWAHL -->
                            <label>
                                Runde auswählen 

                                        <select name="dropdown_runde" size="1">
                                <?php
                                        $abfrage = "SELECT DISTINCT runde FROM spiele WHERE turnier_id=$turnier_id Order By runde ASC";
                                        foreach($pdo->query($abfrage) as $row) 
                                        {        
                                            if($row['runde']==1000)
                                            {
                                                $row['runde']="Achtelfinale";
                                            }
                                            else if($row['runde']==1001)
                                            {
                                                $row['runde']="Viertelfinale";
                                            }
                                            else if($row['runde']==1002)
                                            {
                                                $row['runde']="Halbfinale";
                                            }
                                            else if($row['runde']==1003)
                                            {
                                                $row['runde']="Finale";
                                            }
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
                    </td>
                    <td rowspan=2>
                        <a href="manager.php?turnier_id=$turnier_id">Manager-Seite</a>
                    </td>
                </tr>
                <tr>
                    <td >                
                            <!-- DROPDOWN-RUNDEN AUSWAHL ENDE -->
                        
                            <!-- BUTTON-DATEN ABSENDEN -->
                            <input type="submit" name="anzeigen" value="Runde bestätigen">
                        </form>
                    </td>
                </tr>
            </table>
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
                        if($runde=="Achtelfinale")
                        {
                            $runde=1000;
                        }
                        else if($runde=="Viertelfinale")
                        {
                            $runde=1001;
                        }
                        else if($runde=="Halbfinale")
                        {
                            $runde=1002;
                        }
                        else if($runde=="Finale")
                        {
                            $runde=1003;
                        }
                        $abfrage = "SELECT tischnr,spiel_id FROM spiele Where runde='$runde' and turnier_id=$turnier_id";
                        
                        foreach($pdo->query($abfrage) as $row) 
                        {  

                            $spiel_id= $row['spiel_id'];
                            ?>    
                                <tr>
                                    <td>
                                        <p></p>
                                        <input type="checkbox" name="spiel_id" value="<?php echo $row['spiel_id']?>" onclick="myFunction(this)"> 
                                        <?php 
                                            echo "Tisch-Nr: ".$row['tischnr'];   
                                        ?>

                                        <?php 
                                            echo "Spiel-ID: ".$row['spiel_id'];
                                        ?>
                                    </td>				
                                </tr>
                            
                                <form method="post" action="./include/schiridb.php">
                                    <div style="display:none" id="<?php echo $row['spiel_id']?>">
                                        <?php 
                                            $_SESSION['spiel_id']=$spiel_id; 
                                            include('./include/tischanzeige.php');
                                        ?> 
                                    </div>
                                </form> 
                                <?php 
                            }
                        } 
                            ?>	   
                </label>
        </div>
    </body>
</html>
