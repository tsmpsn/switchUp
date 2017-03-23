<?php

$con = mysqli_connect("localhost", "root", "edward", "switchUP");
$userID = $_SESSION["userID"];

if ($_POST) {
	$itemType = $_POST['itemtype'];
	$size = $_POST['size'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$condition = $_POST['condition'];
	$sold = 0;
	$itemID = getHighestItemID();
	$sql = "INSERT INTO item (itemID, userID, Type, Size, Price, Description, ItemCondition, UploadTime, Sold) VALUES ('$itemID', '$userID', '$itemType', '$size', '$price', '$description', $condition, now(), $sold)";
	$imageID = getHighestImageID();
	$imageURL = getImageURL();
	$sql2 = "INSERT INTO images (imageID, itemID, imageURL) VALUES ('$imageID', '$itemID', '$imageURL')";
	if(mysqli_query($con, $sql) && mysqli_query($con, $sql2)){
		echo "Records inserted successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
}

function getHighestItemID() {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$sql = "SELECT itemID FROM item ORDER BY itemID DESC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_object($result);
	$value = $row->itemID + 1;
	return $value;
}

function getHighestImageID() {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$sql = "SELECT imageID FROM images ORDER BY imageID DESC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_object($result);
	$value = $row->imageID + 1;
	return $value;
}

function getImageURL() {
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image1ToUpload"]["name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	$target_dir = "assets/img/";
	echo $_FILES["image1ToUpload"]["name"];
	$target_file = $target_dir . $_FILES["image1ToUpload"]["name"];
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	return $target_file;
}

?>