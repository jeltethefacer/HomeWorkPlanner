<?php
	$DBName = "homeworksite";
	$DBConnect = mysqli_connect("localhost", "root", "");
	if ($DBConnect === FALSE){
		echo "<p>Connection error: ". mysqli_error() . "</p>\n";
	}
	else{
		if(!(mysqli_select_db($DBConnect, $DBName))){
			echo"<p>could not select the \"$DBName\" database". mysqli_error($DBConnect) ."<?p>\n";
			mysqli_close($DBConnect);
			$DBConnect = FALSE;
		}
	}
?>