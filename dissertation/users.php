<?php

require_once 'init.php';

function userExists($username) {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$username = sanitizeData($con, $username);
	$query = "SELECT id FROM users WHERE username = '$username'";
	$result = mysqli_query($con, $query);
	
	if (mysqli_num_rows($result) == 1) {
		return true;
	} else {
		return false;
	}

    mysqli_free_result($result);
}

function getUserIDFromUsername($username) {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$username = sanitizeData($con, $username);
	$query = "SELECT id FROM users WHERE username = '$username'";
	$result = mysqli_query($con, $query);
	$obj = mysqli_fetch_object($result);
	return $obj->id;
}

function getUsernameFromUserID($userID) {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$username = sanitizeData($con, $userID);
	$query = "SELECT username FROM users WHERE id = '$userID'";
	$result = mysqli_query($con, $query);
	$obj = mysqli_fetch_object($result);
	return $obj->username;
}

function userLogin($username, $password) {
	$userID = getUserIDFromUsername($username);
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$username = sanitizeData($con, $username);
	$password = md5($password);
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