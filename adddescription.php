<?php

// Add user description
if (isset( $_POST['userdesc'] )) {
	$con = mysqli_connect("localhost", "root", "edward", "switchUp");
	$description = $_POST['userdescription'];
	$userID = $_SESSION['userID'];

	$sql = "UPDATE users SET description='$description' WHERE id='$userID'";
	mysqli_query($con, $sql);
	
}

?>