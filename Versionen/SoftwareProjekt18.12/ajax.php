<?php  
    include('./include/config.php');
    include('./include/TeamsDB.php'); 

    ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/styleschiri.css">
</head>
<body>
<form method="post"> 
<label>
                Runde auswählen 
                        <select name="dropdown_runde" size="1">
                <?php
                        $abfrage = "SELECT DISTINCT testrunde FROM testtabelle";
                        foreach($pdo->query($abfrage) as $row) 
                        {        
                ?>
                        <option value=<?php echo $row['testrunde'];?>>
                <?php 
                        echo $row['testrunde']; 
                ?>
                        </option>
                <?php 
                        } 
                ?>
                        </select>
            </label>




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




<!-- TISCH-NR AUSWAHL -->
<label>
                <u>Tisch-Nr und Spielauswahl:</u>

                <?php
                    if(isset($_POST['anzeigen']))
                    {
                    
                    $runde=$_POST['dropdown_runde'];
                    $abfrage = "SELECT testspielid FROM testtabelle Where testrunde=$runde";
                    
                    foreach($pdo->query($abfrage) as $row) 
                    {  

                        $spielid= $row['testspielid'];
                        ?>    
                            <tr>
                                <td>
                                    <p></p>
                                    

                                    <!--
                                    <input type="checkbox" name="tischnr" value="<?php echo $row['testspielid']?>" onclick="tische(this);"> 
                    -->
                    <input type="checkbox" name="tischnr" value="<?php echo $row['testspielid']?>";> 
                                    
                                    
                                    <?php 
                                        //echo "Tisch-Nr: ".$row['tischnr'];   
                                    ?>

                                    <?php 
                                        echo "Spiel-ID: ".$row['testspielid'];
                                    ?>
                                </td>				
                            </tr>
                        <div id="<?php echo $row['testspielid']?>"></div>
                        <?php 
                            }
                            } 
                        ?>	   
            </label>



            </form> 




<script>

                function check(cb) 
                {
                    if(cb.checked)
                    {
                        document.write(cb.value); 
                        
                        if(cb.value ==$.POST['testspielid'])
                        {
                            
                        }
                        
                        <?php
                        //$statement = $pdo->prepare("UPDATE spiele SET 1_cup_1 = ? WHERE spielid = cb.value");
                        //$statement->execute(array(0,cb.value));  
                        ?>

                        $(document).ready(function() {

                        $("#type").change(function() {
                        var val = $(this).val();

                        $.post('ajaxquery.php', {'brand' : val}, function(data){
                        var jsonData = JSON.parse(data); // turn the data string into JSON
                        var newHtml = ""; // Initialize the var outside of the .each function
                        $.each(jsonData, function(item) {
                        newHtml += "<option>" + item['model'] + "</option>";
                        })
                        $("#size").html(newHtml);
                        });
                        });
                        });




                    }
                    else
                    {
                        document.write("ELSSSSSSE");
                    }
            
                }   
                
                // TISCHANZEIGE SKRIPT
                function tische(tischauswahl)
                {
                    if(tischauswahl.checked)
                    {
                        var string ='<input type="checkbox" class="cups" name="testcup1" value='+tischauswahl.value+' onclick="check(this);">'+                                                          
                                    '<input type="checkbox" class="cups" name="testcup2" value='+tischauswahl.value+' onclick="check(this);">';

                        document.getElementById(tischauswahl.value).innerHTML = string;
                    }
                    else
                    {
                        var string = "";
                        document.getElementById(tischauswahl.value).innerHTML = string;
                    }
                }

              </script>
</body>
</html>