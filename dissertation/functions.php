<?php 
	function sanitizeData($con, $data) {
		return mysqli_real_escape_string($con, $data);
	}
	
	function usernameAlreadyExists($username) {
		$con = mysqli_connect("localhost", "root", "edward", "dissertation");
		$username = sanitizeData($con, $username);
		$usernameExistsCheck = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($con, $usernameExistsCheck);
		if (mysqli_num_rows($result) == 1) {
			return true;
		} else {
			return false;
		}
	}
?>