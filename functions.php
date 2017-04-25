<?php 
	function sanitizeData($con, $data) {
		return mysqli_real_escape_string($con, $data);
	}
	
	function usernameAlreadyExists($username) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUp");
		$username = sanitizeData($con, $username);
		$usernameExistsCheck = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($con, $usernameExistsCheck);
		if (mysqli_num_rows($result) == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function getHighestUserID() {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$sql = "SELECT id FROM users ORDER BY id DESC";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) == 0) {
			return 1;
		} else {
			$row = mysqli_fetch_object($result);
			$value = $row->id + 1;
			return $value;
		}
	}
	
	function getUserIDFromUsername($username) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$username = sanitizeData($con, $username);
		$query = "SELECT id FROM users WHERE username = '$username'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	}
	
	function getUsernameFromUserID($userID) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$username = sanitizeData($con, $userID);
		$query = "SELECT username FROM users WHERE id = '$userID'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($result);
		return $row['username'];
	}
	
	function getitemNameFromItemID($itemID) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$query = "SELECT itemName FROM item WHERE itemID = '$itemID'";
		$result = mysqli_query($con, $query);
		$itemID = mysqli_fetch_assoc($result);
		return $itemID['itemName'];
	}
	
	function getItemFloat($x) {
	$r = $x % 3;
	if ($r == 0) {
		return 'left';
	} else if ($r == 1) {
		return 'none';
	} else if ($r == 2) {
		return 'right';
	}
		
}

?>