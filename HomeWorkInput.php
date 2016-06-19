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
	<form action="index.php" method="POST">
		Datum huiswerk af:<br>
		<input type="date" name="DatumDone"><br>
		What moet ik dan doen?:<br>
		<input type="text" name="HomeWorkToDo">
		<input type="submit" name="submit">
	</form>
	<?php
		$Valid = 0;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($_POST["DatumDone"])){
				echo"Vul een datum in waarop het huiswerk gedaan moet zijn.<br/>";
			}else{
				$Datum = $_POST["DatumDone"];
				$Datum = str_replace("-","",$Datum);				
				$Valid++;
			}
			
			if(!empty($_POST["HomeWorkToDo"])){
				$HomeWorkToDo = stripslashes($_POST["HomeWorkToDo"]);
				$HomeWorkToDo = trim($HomeWorkToDo);
				$Valid++;
			}else{
				echo "Vul Alle velden in.<br/> ";
			}
			if($Valid == 2){
				$Query = "INSERT INTO `homework`(`Datum`, `HomeWork`) VALUES('".$Datum."','".$HomeWorkToDo."')";
				$SubmitToServer = mysqli_query($DBConnect, $Query);
				echo "done";
				if(!$SubmitToServer){
					echo mysqli_error($DBConnect);
				}
			}
			
		}
	?>
</body>
</html>