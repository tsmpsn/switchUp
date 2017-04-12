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
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		if ($i == -1) {
			$check = getimagesize($_FILES["displaypicture"]["name"]);
		} else if ($i = 0) {
			$check = getimagesize($_FILES["image1ToUpload"]["name"]);
		} else if ($i = 1) {
			$check = getimagesize($_FILES["image2ToUpload"]["name"]);
		} else if ($i = 2) {
			$check = getimagesize($_FILES["image3ToUpload"]["name"]);
		}
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	$target_dir = "assets/img/";
	if ($i == -1) {
		$target_file = $target_dir . $_FILES["displaypicture"]["name"];
		$j = "displaypicture";
	} else if ($i == 0) {
		$target_file = $target_dir . $_FILES["image1ToUpload"]["name"];
		$j = "image1ToUpload";
	} else if ($i == 1) {
		$target_file = $target_dir . $_FILES["image2ToUpload"]["name"];
		$j = "image2ToUpload";
	} else if ($i == 2) {
		$target_file = $target_dir . $_FILES["image3ToUpload"]["name"];
		$j = "image3ToUpload";

	}
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		return 0;
		$uploadOk = 0;
	} else {
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		} else {
			if (move_uploaded_file($_FILES[$j]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES[$j]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			}
	}
	return $target_file;
}
?>