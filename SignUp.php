<!DOCTYPE html>
<html>
<?php global $ErrorCount; ?>
<body>

<form action="SignUp.php" method="post" enctype="multipart/form-data">
	username:<br/>		   <input type="text" name="UserName"/><br/><br/>
	password:	<br/>	   <input type="password" name="Password"/><br/>
	confirm password: <br/><input type="password" name="PasswordConfirmed"/><br/><br/>
	email:<br/>            <input type="text" name="Email"/><br/><br/>
	
    <input type="submit" value="Sign Up" name="submit">
 </form>
<?php
	include("inc_db_HomeWorkSite.php");
	if(isset($_POST["submit"])){
		if(empty($_POST["UserName"]) && empty($_POST["Password"]) && empty($_POST["PasswordConfirmed"]) && empty($_POST["Email"])){
			echo"please fill in all forms";
			$ErrorCount++;
		}else{

		}
		
		
		$UserName = stripslashes($_POST["UserName"]);
		$Pass1 = stripslashes($_POST["Password"]);
		$Pass2 = stripslashes($_POST["PasswordConfirmed"]);
		$Email = stripslashes($_POST["Email"]);
		
		
		$SQLstring = "SELECT UserName, UserPass, UserEmail FROM siteuser";
		
		if ( $Result = mysqli_query($DBConnect, $SQLstring)){
			while($Row= mysqli_fetch_row($Result)){
				if($Row[0]==$UserName){
					$ErrorCount++;
					echo"username already in use.";
				}
				if($Pass1==$Pass2){
					if($Row[1]==$Pass1){
						$ErrorCount++;
						echo"password in use.";
					}
				}else{
					echo"password don't match.";
				}
				if($Row[2]==$Email){
					$ErrorCount++;
					echo"Email already in use";
				}
				
			}
		} 		
		
		if($ErrorCount==0){
			$SQLstring = "INSERT INTO siteuser (UserName, UserPass, UserEmail) VALUES('".$UserName."','".$Pass1."','".$Email."')";
			if(mysqli_query($DBConnect, $SQLstring)){
				echo"account made";
				header("Location: index.php");
			}else{
				echo "error ". mysqli_error($DBConnect);
			}
		}
		
	}
?> 
 
</body>

</html> 