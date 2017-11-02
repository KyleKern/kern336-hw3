<?php

$bArray = array();


for($k = 0; $k < 16; $k++ ){
    $bArray[$k] = $k + 1;
}


function shuffleBalls(){
    global $bArray;
    $evenscore = 0;
    $oddscore = 0;
    $row = (int)$_GET['rows'];
    $col = (int)$_GET['cols'];
    
    if(isset($_GET['ball8'])){
        $set = "y";
    }
    
    echo "<table align='center'>";
    echo "<tr>";
    
    for($x=0; $x < $row; $x++){
    
        for($y=0; $y < $col; $y++){
            $t = rand(0,15);
             
            if($t%2==1){
                echo "<td style='background-color:green;'>";
            }else{
                echo "<td style='background-color:yellow;'>";
            }
            echo "<img src = 'billiards/billiards/$t.png' />";
           
            
            echo "</td>";
            if($t%2==1){
                    $oddcore = $oddscore + $t;
                }else{
                    $evenscore = $evenscore + $t;
                }
            } 
            echo "</tr>";
        } 
    echo "</table>";
    
    echo "Even Balls Points: ".$evenscore;
    echo "-";
    echo "Odd Balls Points: ".$oddscore;
    
    if($evenscore > $oddscore){
        echo "<br />";
        echo "<h2>Even balls win!</h2>";
    }
    
    if($oddscore > $evenscore){
        echo "<br />";
        echo "<h2>Odd balls win!</h2>";
    }
    
    if($oddscore = $evenscore){
        echo "<br />";
        echo "<h2>Its a tie!</h2>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Billiards!</title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        
    <h1>Billiards: Even vs Odd!</h1>
    <?=shuffleBalls()?>
    <hr>
        <form method="GET">
        <h2>Customize Output</h2>
          Rows: <input type="text" name="rows" size="3" maxlength="2" value="2"/> 
          Columns: <input type="text" name="cols" size="3" maxlength="2" value="2"/>
          (Values must not exceed 4)

          <br /> <br />
          <input type="checkbox" name="ball8" value="y"> Include 8 ball </input>
          <br /> <br />
          
          Order Balls: 
          <input type="radio" name="order" value="a" id="asc"><label for="asc"> Ascending </label>
          <input type="radio" name="order" value="d" id="desc"> <label for="desc">  Descending </label>
          
          <br /> <br />
          
          <input type="submit" value="Display" name="display"/>
          
          </form> 
    </body>
</html>