<!DOCTYPE html>
<?php
include("inc_db_HomeWorkSite.php");
?>
<html>
<head>
    <title>HomeWorkPlanner</title>
	<meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="CSS/LogIn.css">
</head>
<body>
	<div id="header">
		<span class="TopLogo">HuiswerkPlanner.nl</span>
    </div>

<form action="login.php" method="POST">
		UserName:<br>
		<input type="text" name="UserName"><br>
		Password:<br>
		<input type="password" name="Password">
		<input type="submit" name="submit">
</form>
<?php
		$Valid = 0;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			//if there's no data collum with inputted username returns message
			$Response = false;
			if(empty($_POST["Password"])){
				echo"Vul Wachtwoord.<br/>";
			}else{
				$Password = $_POST["Password"];				
				$Valid++;
			}
			
			if(!empty($_POST["UserName"])){
				$UserName = stripslashes($_POST["UserName"]);
				$UserName = trim($UserName);
				$Valid++;
			}else{
				echo "Vul een gebruikersnaam in.<br/> ";
			}
			if($Valid == 2){
				//when input is valid select corrosponding data and checks if input is right.
				$LogInValid = 0;
				$Query = "SELECT UserPass, UserName, UserId, UserEmail FROM siteuser Where UserName='".$UserName."'";
				if($GetUserName = mysqli_query($DBConnect, $Query)){
					while($row = mysqli_fetch_array($GetUserName)){
						$Response = true;
						if($row[0]==$Password){
							$LogInValid++;
						}
						else{
							echo "Wachtwoord incorrect.";
						}
						if($row[1]==$UserName){
							$LogInValid++;
						}else{
							echo "Gebruikersnaam incorrect.";
						}
						if($LogInValid==2){
							session_start();
							$_SESSION["UserId"] = $row[2];
							$_SESSION["UserEmail"] = $row[3];
							$_SESSION["UserName"] = $row[0];
							$_SESSION["LogIn"] = true;
							header('Location: index.php');
							die();
						}
					}					
				}
			}
			// corrosponding if statement see begin php block
			if(!$Response){
				echo"Incorrect UserName and/or pass";
			}
		}
?>
</body>
</html>