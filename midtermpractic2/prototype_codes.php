//This file contains code base for an HTML form and a table in PHP.

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

        <form method="GET">
          Text Statement: <input type="text" name="" size="25" maxlength="16" placeholder="Type message" />
          <br /><br />
          
          Select Statement:
          <select name="">
              <option value=""> </option>    
              <option>Option without specific value</option>    
          </select>
          
          <br /> <br />
          
          Radio Buttons: 
          <input type="radio" name="radio" value="y" id="cpcYes"><label for="cpcYes"> Yes </label>
          <input type="radio" name="radio" value="n" id="cpcNo"> <label for="cpcNo">  No </label>
          
          <br /> <br />
          
          Checkbox:
          <input type="checkbox" name="vehicle" value="hi"> life man<br>
          <input type="checkbox" name="vehicle" value="bye" checked>
          
          
           <br /> <br />
         
          Submit button:
          <input type="submit" value="click here" name="submitForm"/>
          
          </form> 
          
    </body>
</html>

<?php

echo "<table border = 1>";
echo "<tr>";

//for(some number){ rows
    //for(some number){ columns

echo "<td>";
//echo "data to be printed"
echo "</td>";
//    } //endFor columns
echo "</tr>";
//    } //endFor rows
echo "</table>";

?>