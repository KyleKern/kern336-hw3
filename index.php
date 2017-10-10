<?php

function isFormValid() {
    
   $conditions = [isset($_GET['submitForm']), isset($_GET['love']), isset($_GET['type1']), isset($_GET['duelType']), isset($_GET['fName'])];
    
   if (array_sum($conditions) == count($conditions)) {
        return true;
        }
    else{
        echo "Invalid form!";
   }
  }

$water = array("Squirtle", "Milotic", "Pyukumuku","Toxapex", "Seismitoad");
$grass = array("Bulbasaur", "Chespin", "Lurantis","Odish", "pumpkaboo");
$fire = array("Litten", "Charmander", "Torchic","Blaziken", "Houndoom");

$pokeLove = $_GET['love'];
$type1 = $_GET['type1'];
$duelType = $_GET['duelType'];
$newPokemon ="";


function pokemon(){
    global $water, $grass,  $fire, $pokeLove, $type1, $duelType;
    $fName = $_GET['fName'];
    
    if($pokeLove == 'n'){
        echo "<strong>";
        echo "You don't love pokemon so you don't get any pokemon.";
        echo "</strong>";
    } else {
        
        if($type1 == "g" && $duelType == "n"){
            echo  "<h1>".$fName." should have a ".$grass[0]." or ".$grass[1]." or ".$grass[2]."<h1/>";
        } 
        if($type1 == "g" && $duelType == "y"){
            echo  "<h1>".$fName." should have a ".$grass[3]." or ".$grass[4]."<h1/>";
        } 
        if($type1 == "w" && $duelType == "n"){
            echo  "<h1>".$fName." should have a ".$water[0]." or ".$water[1]." or ".$water[2]."<h1/>";
        } 
        if($type1 == "w" && $duelType == "y"){
            echo  "<h1>".$fName." should have a ".$water[3]." or ".$water[4]."<h1/>";
        } 
        if($type1 == "f" && $duelType == "n"){
            echo  "<h1>".$fName." should have a ".$fire[0]." or ".$fire[1]." or ".$fire[2]."<h1/>";
        } 
        if($type1 == "f" && $duelType == "y"){
            echo "<h1>".$fName." should have a ".$fire[3]." or ".$fire[4]."<h1/>";
        }
    }
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title> Assignment 3</title>
        <style>
            @import url("css/styles.css");
            
        </style>
    </head>
    <body>

    <h1>What pokemon should you get?</h1>
    
    <br /> <br />
    
    <form method="GET">
          <strong>What is your first name?:</strong> <input type="text" name="fName" size="25" maxlength="16" placeholder="Type first name" />
          <br /><br />
          
          <strong>Should type of pokemon do you like?</strong>
          <select name="type1">
              <option value="w"> water </option>
              <option value="f"> fire </option>
               <option value="g"> grass </option>
          </select>
          
          <br /> <br />
          
         <strong>Should it be duel type?</strong>
          <select name="duelType">
              <option value="y"> yes </option>
              <option value="n"> no </option>
             
          </select>
          
          <br /> <br />
          
          <strong>Do you love pokemon?</strong>
          <input type="radio" name="love" value="y" id="lYes"><label for="lYes"> Yes </label>
          <input type="radio" name="love" value="n" id="lNo"> <label for="lNo">  No </label>
          
          <br /> <br />
          
          <input type="submit" value="Click to see what pokemon you should get!" name="submitForm" id="button" />
        
          </form>
          <?php
           if (isFormValid()){
               pokemon();
           }
           
          ?>
          
    </body>
</html>