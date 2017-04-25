<?php

$con = mysqli_connect("localhost", "root", "edward", "switchUp");
	if (isset($_POST['registerbutton'])) {
		$userID = getHighestuserID();
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password-repeat'];
		
		// Gets user display picture information
		$i = -1;
		$imageURL = getImageURL($i);
		
		// Checks the username is unique
		if (usernameAlreadyExists($username)) {
			echo '<script language="javascript">';echo 'alert("That username is taken, please try a different one")';echo '</script>';
		} else {
			// Attempt insert query execution
			$password = md5($password);
			$dob = $_POST['dob'];
			$sql = "INSERT INTO users (id, username, fullname, email, displayURL, password, dob, joined) VALUES ('$userID', '$username', '$fullname', '$email', '$imageURL', '$password', '$dob', now())";
			if(mysqli_query($con, $sql)){
				$_SESSION['userID'] = $userID;
				$_SESSION['username'] = $username;
				header("location: home.php");
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
			}
		}
 }
 
?>