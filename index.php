<!DOCTYPE html>
<?php
include("inc_db_HomeWorkSite.php");
?>
<html>
<head>
    <title>HomeWorkPlanner</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css">
	<?php
		session_start();
	?>
</head>
<body>
    <div id="header">
        <span class="TopLogo">HuiswerkPlanner.nl</span>
		<span class="UserNameHeader">| <?php 
			if(isset($_SESSION["LogIn"])){
				echo $_SESSION["UserName"];
			}
		?></span>
    </div>

    <div id="HomeWorkInput">
        <?php include("HomeWorkInput.php"); ?>
    </div>
    <div id="HomeWorkCalander">
		<?php
			if(!isset($_SESSION["CurrentMonth"])){
				$_SESSION["CurrentMonth"] = date("m");
			}
			if($_SERVER["REQUEST_METHOD"] == "GET"){
				if(isset($_GET["Change"])){
					if($_GET["Change"]=="back"){
						$_SESSION["CurrentMonth"]--;
					}else{
						$_SESSION["CurrentMonth"]++;
					}
				}
			}
			$CurrentMonth = $_SESSION["CurrentMonth"];
			$MonthName = date('F', mktime(0, 0, 0, $CurrentMonth, 10));
			
			echo "<div class='CurrentMonth'>";
			echo "<a href='index.php?Change=back'><-</a>".$MonthName."<a href='index.php?Change=forward'>-></a>";
			echo "</div><hr/>";
			
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $CurrentMonth, 2016); $i++){
				echo "<div class='CalanderDay'><div class='Date'>";
				if($i== date("d") && date("m")== $CurrentMonth){
					echo "<span style='color: red; font-weight: bold;'>$i ". $MonthName."<br/></span>";
				}else{
					echo "$i ". $MonthName."<br/>";
				}
				echo "</div>";
				echo"<div class= 'HomeWork'>";
				$query = "SELECT HomeWork, Datum, HomeWorkDone, ID, UserId FROM HomeWork";
				$hoer = mysqli_query($DBConnect, $query);
				while($row = mysqli_fetch_array($hoer))
				{
					$Date = $row[1];
					$DateArray = explode("-",$Date);
					if(isset($_SESSION["UserId"])){
						if($i == $DateArray[2] && $row[4]== $_SESSION["UserId"] && $DateArray[1]==$CurrentMonth){
							if($row[2]==0){
								echo"<a href='index.php?id=".$row[3]."&To=Done'><span class='HomeWorkToDo'>".$row[0]."<br/></span></a>";
							}else{
								echo"<a href='index.php?id=".$row[3]."&To=NotDone'<span class='HomeWorkDone'>".$row[0]."<br/></span></a>";
							}
						}
					}
				}
				echo"</div></div>";
			}
		?>
    </div>
</body>
<?php
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if(isset($_GET["To"])){
			if($_GET["To"]=="Done"){
				$Query = "UPDATE homework set HomeWorkDone=1 where id='".$_GET["id"]."'";
			}else{
				$Query = "UPDATE homework set HomeWorkDone=0 where id='".$_GET["id"]."'";
			}
			$ChangeDoneSetting = mysqli_query($DBConnect, $Query);
		}
	}	
?>
</html>
