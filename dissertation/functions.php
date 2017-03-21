<?php 
	function sanitizeData($data) {
		return mysql_real_escape_string($data);
	}
	
	function usernameAlreadyExists($username) {
		$username = sanitizeData($username);
		$con = mysqli_connect("localhost", "root", "edward", "dissertation");
		$usernameExistsCheck = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($con, $usernameExistsCheck);
		if (mysqli_num_rows($result) == 1) {
			return true;
		} else {
			return false;
		}
	}
?>