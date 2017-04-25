<?php
require_once 'images.php';

$con = mysqli_connect("localhost", "root", "edward", "switchUP");
$userID = $_SESSION["userID"];
$noOfImages = 0;

if (isset($_POST['uploadbutton'])) {
	$itemID = getHighestItemID();
	$itemName = $_POST['itemname'];
	$itemGender = $_POST['gender'];
	$itemType = $_POST['itemtype'];
	$size = $_POST['size'];
	$description = $_POST['description'];
	$condition = $_POST['condition'];
	$swapped = 0;
	$sql = "INSERT INTO item (itemID, itemName, userID, Type, Gender, Size, Description, ItemCondition, UploadTime, Swapped) VALUES ('$itemID', '$itemName', '$userID', '$itemType', '$itemGender', '$size', '$description', $condition, now(), $swapped)";
	if (checkImageUploaded() == true) {
		$imageID = getHighestImageID();
		$imageURL = getImageURL($i);
		if ($imageURL == 2) {
			echo "Image size too large";
		} else {
			$sql2 = "INSERT INTO image (imageID, imageURL, itemID) VALUES ('$imageID', '$imageURL', '$itemID')";
			mysqli_query($con, $sql);
			mysqli_query($con, $sql2);
		}
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

function checkImageUploaded() {
	if(empty($_FILES['image1ToUpload']['name'])) {
		$message = "Please upload an image";
		echo "<script type='text/javascript'>alert('$message');</script>";
		return false;
	} else {
		return true;
	}
}

?>