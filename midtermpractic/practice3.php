<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="main.css">
  <title>Midterm 1</title>
</head>
<body>
  
  
    <table border="1" width="600">
    <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
    <tr style="background-color:#99E999">
      <td>1</td>
      <td>The page includes the basic form elements as in the Program Sample: Text boxes, Checkbox, radio buttons</td>
      <td width="20" align="center">3</td>
    </tr>
    <tr style="background-color:#FFC0C0">
      <td>2</td>
      <td>When accessing the webpage directly, a 3x3 table with random balls is displayed</td>
      <td width="20" align="center">5</td>
    </tr> 
    <tr style="background-color:#FFC0C0">
      <td>3</td>
      <td>The balls are NOT duplicated </td>
      <td align="center">5</td>
    </tr>    
	<tr style="background-color:#FFC0C0">
      <td>4</td>
      <td>Even balls have a yellow background. The cue ball (the white ball) is even </td>
      <td align="center">3</td>
    </tr> 
    <tr style="background-color:#FFC0C0">
      <td>5</td>
      <td>Odd balls have a green background</td>
      <td align="center">3</td>
    </tr>
    <tr style="background-color:#FFC0C0">
      <td>6</td>
      <td>The sum of ball values is displayed below the table</td>
      <td align="center">3</td>
    </tr>       
    <tr style="background-color:#FFC0C0">
      <td>7</td>
      <td>When submitting the form, a table with random balls is created using the custom number of rows and columns</td>
      <td align="center">8</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>8</td>
      <td>There is validation for empty number of rows and columns, and rows and columns greater than 4  </td>
      <td align="center">5</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>9</td>
      <td>When the  "Include the 8 ball" checkbox is checked, the 8 ball must be displayed within the table, in a random position </td>
      <td align="center">5</td>
    </tr>    
    <tr style="background-color:#FFC0C0">
      <td>10</td>
      <td>The balls are displayed in ascending order if "Ascending" is checked. </td>
      <td align="center">5</td>
    </tr>        
    <tr style="background-color:#FFC0C0">
      <td>11</td>
      <td>The balls are displayed in descending order if "Descending" is checked. </td>
      <td align="center">5</td>
    </tr> 
    <tr style="background-color:#FFC0C0">
      <td>12</td>
      <td>The total number of even and odd balls is properly displayed. </td>
      <td align="center">5</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>13</td>
      <td>The right winner (even or odd balls) is displayed. </td>
      <td align="center">5</td>
    </tr>              
    <tr style="background-color:#FFC0C0">
      <td>14</td>
      <td>The global number of total games won by the even or odd balls is properly displayed. </td>
      <td align="center">10</td>
    </tr>              
    <tr style="background-color:#99E999">
      <td>15</td>
      <td>This rubric is properly included AND UPDATED (BONUS)</td>
      <td width="20" align="center">2</td>
    </tr>     
     <tr>
      <td></td>
      <td>T O T A L </td>
      <td width="20" align="center"><b></b></td>
    </tr> 
  </tbody></table>
        
    <form method = "GET">
       
    <h2>Billards</h2>
    <br>
    Number of Rows:
    <input type="text" name="rows" size="10"/><br>
    Number of Columns:
    <input type="text" name="columns" size="10"/>
    <br>
     <input type="radio" name="8ball" value="8ball"> Include 8 ball<br>
      <input type="checkbox" name="Ascending" value="Ascending"> Ascending<br>
      <input type="checkbox" name="Descending" value="Descending"> Descending<br>
      
    <button type = "submit" value = "Submit">Submit</button>
    
    <?php
    $used = array();
    for ($i = 0; $i < 4; $i++){
		$used[$i] = array();
	}
	$rows = $_GET['rows'];
	$columns = $_GET['columns'];
    if ( $_GET['rows'] *$_GET['columns'] > 39 )
    {
    
    }
    if($_GET['rows'] *$_GET['columns']  == 0)
    {
        
    }
    else 
    {
        echo "<center><table border='1'>";
	
	for ($c = 0; $c < $rows; $c++ )
	{
		echo "<tr>";
		
		for($r = 0; $r < $columns; $r++)
		{
			$ball = "ball/";
			$suit = rand(0, 3);
			$number .= getnumber($ball);
			
			$number = rand(1, 13);
			
			while ($number == in_array($number, $used[$suit]))
			{
				$number = rand(1,13);
			}
			
			$card .= $number . ".png";
			if ($number == 13)
			{
			    echo "<td style='background-color:#33CCFF'> <img src='" . $card . "'/></td>";
			} 
			else if ($number == 1)
			{
				echo "<td style='background-color:#F8FF24'> <img src='" . $card . "'/></td>";
			} 
			else 
			{
				echo "<td style='background-color:#FFFFFF'> <img src='" . $card . "'/></td>";
			}
		}
		echo "</tr>";
	    }
	
	echo "</table></center>";
    }
    
    function getCard($num)
    {
    	if ($num == 0){
    	
    	} else if ($num == 1){
    	
    	} else if ($num == 2){
    		
    	} else {
    
    	}
    }

    
    ?>


                            
    </body>
</html>