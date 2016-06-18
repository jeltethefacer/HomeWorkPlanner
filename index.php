﻿<!DOCTYPE html>
<?php
include("inc_db_HomeWorkSite.php");
?>
<html>
<head>
    <title>HomeWorkPlanner</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css">
</head>
<body>
    <div id="header">
        <span class="TopLogo">HuiswerkPlanner.nl</span>
    </div>

    <div id="HomeWorkInput">
        hello
    </div>
    <div id="HomeWorkCalander">
	<?php
		$CurrentMonth = date("m");
		$MonthName = date('F', mktime(0, 0, 0, $CurrentMonth, 10));
		
		
		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $CurrentMonth, 2016); $i++){
			echo "<div class='CalanderDay'><div class='Date'>";
			echo "$i ". $MonthName."<br/>";
			echo "</div>";
			echo"<div class= 'HomeWork'>";
			$query = "SELECT HomeWork, Datum FROM HomeWork";
			$hoer = mysqli_query($DBConnect, $query);
			while($row = mysqli_fetch_array($hoer))
			{
				$Date = $row[1];
				$DateArray = explode("-",$Date);
				if($i == $DateArray[2]){
					echo $row[0]." ";					
				}
			}
			echo"</div></div>";
		}
	?>
    </div>
</body>
</html>
