<!DOCTYPE html>
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
		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $CurrentMonth, 2016); $i++){
			echo "<div class='CalanderDay'>";
			echo "$i <br/>";

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

			echo "</div>";
		}
	?>
    </div>
</body>
</html>
