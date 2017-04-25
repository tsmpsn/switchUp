<?php

function getHighestImageID() {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$sql = "SELECT imageID FROM image ORDER BY imageID DESC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$value = $row['imageID'] + 1;
	return $value;
}

function getImageURL($i) {
	if ($i == -1) {
		if (file_exists($_FILES['displaypicture']['tmp_name'])) {
			$check = getimagesize($_FILES["displaypicture"]["tmp_name"]);
		} else { return 2; }
	} else if ($i == 0) {
		if (file_exists($_FILES['image1ToUpload']['tmp_name'])) {
			$check = getimagesize($_FILES["image1ToUpload"]["tmp_name"]);
		} else { return 2; }
	}
	if($check !== false) {
		$uploadOk = 1;
		
	} else {
		$uploadOk = 0;
	}
	$target_dir = "assets/img/";
	if ($i == -1) {
		$target_file = $target_dir . $_FILES["displaypicture"]["name"];
		$j = "displaypicture";
	} else if ($i == 0) {
		$target_file = $target_dir . $_FILES["image1ToUpload"]["name"];
		$j = "image1ToUpload";
	}
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "gif" ) {
		$message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		return 0;
		$uploadOk = 0;
	} else {
		if ($uploadOk != 0) {
			move_uploaded_file($_FILES[$j]["tmp_name"], $target_file);
		}
	}
	return $target_file;
}
?>