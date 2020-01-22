<?php 
    include('config.php');
    $spiel_id=$_SESSION['spiel_id'];
    $_SESSION['spiel_id']=$spiel_id;

    $sqlstatement="SELECT 1_cup_1,1_cup_2,1_cup_3,1_cup_4,1_cup_5,1_cup_6,1_cup_7,1_cup_8,1_cup_9,1_cup_10,2_cup_1,2_cup_2,2_cup_3,2_cup_4,2_cup_5,2_cup_6,2_cup_7,2_cup_8,2_cup_9,2_cup_10 FROM `spiele` WHERE spiel_id=$spiel_id";
        foreach($pdo->query($sqlstatement) as $row)
        {
            $team1_cup_1=$row['1_cup_1'];
            $team1_cup_2=$row['1_cup_2'];
            $team1_cup_3=$row['1_cup_3'];
            $team1_cup_4=$row['1_cup_4'];
            $team1_cup_5=$row['1_cup_5'];
            $team1_cup_6=$row['1_cup_6'];
            $team1_cup_7=$row['1_cup_7'];
            $team1_cup_8=$row['1_cup_8'];
            $team1_cup_9=$row['1_cup_9'];
            $team1_cup_10=$row['1_cup_10'];
            $team2_cup_1=$row['2_cup_1'];
            $team2_cup_2=$row['2_cup_2'];
            $team2_cup_3=$row['2_cup_3'];
            $team2_cup_4=$row['2_cup_4'];
            $team2_cup_5=$row['2_cup_5'];
            $team2_cup_6=$row['2_cup_6'];
            $team2_cup_7=$row['2_cup_7'];
            $team2_cup_8=$row['2_cup_8'];
            $team2_cup_9=$row['2_cup_9'];
            $team2_cup_10=$row['2_cup_10'];
        }
    
?>
<!-- TISCHANZEIGE  -->
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styleschiri.css">
</head>
<body>
    <form method="post" action="./include/schiridb.php">
    
        <table style="width:60%">

            <tr>
                    <td></td>
            </tr>
        <!-- TableRow 1 -->
            <tr>

                <td>

                    <label class="container">
                        <?php 
                        if($team1_cup_1==0)
                        {
                            ?><input type="checkbox"  class="cups2" name="1_cup_1" value="<?php echo $team1_cup_1 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                        ?><input type="checkbox"  class="cups" name="1_cup_1" value="<?php echo $team1_cup_1 ?>">
                        <span class="checkmark"></span>
                        <?php
                        }
                        ?>  
                        
                    </label>
                </td>

                <br><br>

                <td colspan=3></td>
                <td rowspan="7" style="background-color:black; text-align=center"></td>
                <td colspan=4></td>
                <td>        
                    <label class="container">
                        <?php 
                            if($team2_cup_1==0)
                            {
                                ?><input type="checkbox"  class="cups2" name="2_cup_1" value="<?php echo $team2_cup_1 ?>">
                                <span class="checkmark2"></span>
                                <?php
                            }
                            else
                            {
                            
                                ?><input type="checkbox"  class="cups" name="2_cup_1" value="<?php echo $team2_cup_1 ?>">
                                <span class="checkmark"></span>
                            <?php
                            }
                            ?> 
                    
                        </label>
                </td>
            </tr>
            <!-- Reihe 2-->
            <tr>
                <td></td>
                <td>            
                    <label class="container">
                    <?php 
                        if($team1_cup_5==0)
                        {
                            
                            ?><input type="checkbox"  class="cups2" name="1_cup_5" value="<?php echo $team1_cup_5 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_5" value="<?php echo $team1_cup_5 ?>">
                            <span class="checkmark"></span>
                        <?php
                        }
                        ?> 
                    
                    </label>
                </td>
                <td colspan=6></td>
                <td>        
                    <label class="container">
                        <?php 
                        if($team2_cup_5==0)
                        {
                            
                            ?><input type="checkbox"  class="cups2" name="2_cup_5" value="<?php echo $team2_cup_5 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_5" value="<?php echo$team2_cup_5 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
            </tr>
            <!-- TableRow 3 -->
            <tr>

                    <td>
                        <label class="container">
                            <?php 
                            if($team1_cup_2==0)
                            {
                                
                                ?><input type="checkbox"  class="cups2" name="1_cup_2" value="<?php echo $team1_cup_2 ?>">
                                <span class="checkmark2"></span>
                                <?php
                            }
                            else
                            {
                            
                                ?><input type="checkbox"  class="cups" name="1_cup_2" value="<?php echo $team1_cup_2 ?>"> 
                                <span class="checkmark"></span>
                                <?php
                            }
                            ?>
                        
                        </label>
                    </td>
                    <td></td>
                    <td>
                        <label class="container">
                        <?php 
                        if($team1_cup_8==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_8" value="<?php echo $team1_cup_8 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_8" value="<?php  echo$team1_cup_8 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                            
                        </label>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team2_cup_8==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_8" value="<?php echo $team2_cup_8 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_8" value="<?php echo $team2_cup_8 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team2_cup_2==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_2" value="<?php echo $team2_cup_2 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_2" value="<?php echo $team2_cup_2 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
            </tr>
            <!--Reihe 4-->
            <tr>

                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team1_cup_6==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_6" value="<?php echo $team1_cup_6 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_6" value="<?php echo $team1_cup_6 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team1_cup_10==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_10" value="<?php echo $team1_cup_10 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_10" value="<?php echo $team1_cup_10 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team2_cup_10==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_10" value="<?php echo $team2_cup_10 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_10" value="<?php echo $team2_cup_10 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team2_cup_6==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_6" value="<?php echo $team2_cup_6 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_6" value="<?php echo $team2_cup_6 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                    
                    </label>
                </td>
                <td></td>
            </tr>
            <!--Reihe 5-->
            <tr>
                <td>        
                    <label class="container">
                    <?php 
                        if($team1_cup_3==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_3" value="<?php echo $team1_cup_3 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_3" value="<?php echo $team1_cup_3 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                    
                    </label>
                </td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team1_cup_9==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_9" value="<?php echo $team1_cup_9 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_9" value="<?php echo $team1_cup_9 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team2_cup_9==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_9" value="<?php echo $team2_cup_9 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_9" value="<?php echo $team2_cup_9 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td>       
                    <label class="container">
                    <?php 
                        if($team2_cup_3==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_3" value="<?php echo $team2_cup_3 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_3" value="<?php echo $team2_cup_3 ?>">
                            <span class="checkmark"></span>
                        <?php
                        }
                        ?>
                        
                    </label>
                </td>
            </tr>
            <!--Reihe 6-->
            <tr>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team1_cup_7==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_7" value="<?php echo $team1_cup_7 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_7" value="<?php echo $team1_cup_7 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>        
                    <label class="container">
                    <?php 
                        if($team2_cup_7==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_7" value="<?php echo $team2_cup_7 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_7" value="<?php echo $team2_cup_7 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
            </tr>
            <!--Reihe 7-->
            <tr>
                <td>       
                    <label class="container">
                    <?php 
                        if($team1_cup_4==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="1_cup_4" value="<?php echo $team1_cup_4 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="1_cup_4" value="<?php echo $team1_cup_4 ?>">
                            <span class="checkmark"></span>
                            <?php
                        }
                        ?>
                        
                    </label>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>        
                    <label class="container">
                        <?php 
                        if($team2_cup_4==0)
                        {
                            
                            ?><input type="checkbox"  class="" name="2_cup_4" value="<?php echo $team2_cup_4 ?>">
                            <span class="checkmark2"></span>
                            <?php
                        }
                        else
                        {
                        
                            ?><input type="checkbox"  class="cups" name="2_cup_4" value="<?php echo $team2_cup_4 ?>">
                            <span class="checkmark"></span>
                        <?php
                        }
                        ?>
                        
                    </label>
                </td>
            </tr>
        </table>
        <?php
        ?>
        <input type="submit" name="submit" id="<?php echo $spiel_id ?>" value="submit">
        <?php echo $spiel_id ?>    
    </form>
    <br>
    <br>

        <!-- TISCHANZEIGE ENDE -->
</body>
</html>