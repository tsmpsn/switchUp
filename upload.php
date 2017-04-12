<?php
require_once 'images.php';

$con = mysqli_connect("localhost", "root", "edward", "switchUP");
$userID = $_SESSION["userID"];
$noOfImages = 0;

if ($_POST) {
	$itemID = getHighestItemID();
	$itemName = $_POST['itemname'];
	$itemType = $_POST['itemtype'];
	$size = $_POST['size'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$condition = $_POST['condition'];
	$swapped = 0;
	$sql = "INSERT INTO item (itemID, userID, Type, Size, Price, Description, ItemCondition, UploadTime, Swapped) VALUES ('$itemID', '$userID', '$itemType', '$size', '$price', '$description', $condition, now(), $swapped)";
	mysqli_query($con, $sql);
	$noOfImages = getNoOfImages($noOfImages);
	for ($i = 0; $i < $noOfImages; $i++) {
		$imageID = getHighestImageID();
		$imagetype = "item";
		$imageURL = getImageURL($imagetype, $i);
		$sql2 = "INSERT INTO image (imageID, imageURL, itemID) VALUES ('$imageID', '$imageURL', '$itemID')";
		mysqli_query($con, $sql2);
	}
}


function getHighestItemID() {
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$sql = "SELECT itemID FROM item ORDER BY itemID DESC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$value = $row['itemID'] + 1;
	return $value;
}

function getNoOfImages($noOfImages) {
	if(empty($_FILES['image1ToUpload']['name'])) {
		echo"Please upload an image";
	} else if (empty($_FILES['image2ToUpload']['name'])) {
		$noOfImages = 1;
	} else if (empty($_FILES['image3ToUpload']['name'])) {
		$noOfImages = 2;
	} else {
		$noOfImages = 3;
	}
	return $noOfImages;
	
}

?>