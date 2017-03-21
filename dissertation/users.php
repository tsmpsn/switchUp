<?php

require_once 'init.php';

function userExists($username) {
	
	$username = sanitizeData($username);
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$query = "SELECT id FROM users WHERE username = '$username'";
	$result = mysqli_query($con, $query);
	
	if (mysqli_num_rows($result) == 1) {
		return true;
	} else {
		return false;
	}

    mysqli_free_result($result);
	mysqli_close($link);
}

function getUserIDFromUsername($username) {
	$username = sanitizeData($username);
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$query = "SELECT id FROM users WHERE username = '$username'";
	$result = mysqli_query($con, $query);
	$obj = mysqli_fetch_object($result);
	return $obj->id;
}

// Returns the userID if the login details are correct
function userLogin($username, $password) {
	$userID = getUserIDFromUsername($username);
	$username = sanitizeData($username);
	$password = md5($password);
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$query = "SELECT id, password FROM users WHERE username = '$username'";
	$result = mysqli_query($con, $query);
	$obj = mysqli_fetch_object($result);
	if ($obj->password == $password) {
		return $userID;
	} else {
		return false;
	}	
}

?>