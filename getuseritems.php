<?php 

if (isSet($_SESSION["userID"])) {
	// Get user details
	$query = "SELECT description FROM users WHERE id = '$userID'";
	$result = mysqli_query($con, $query);
	$user = mysqli_fetch_assoc($result);
	$userDescription = $user['description'];

	// Get users items
	$retrieveUserItems = "SELECT * FROM item WHERE userID = '$userID'";
	$result = mysqli_query($con, $retrieveUserItems);
	$counter = 0;

	while ($row = mysqli_fetch_object($result)) {
		$counter++;
		$itemIDDB[] = $row->itemID;
		$itemNameDB[] = $row->itemName;
		$sizeDB[] = $row->Size;
		$priceDB[] = $row->Price;
		$descriptionDB[] = $row->Description;
		$conditionDB[] = $row->ItemCondition;
	}

	// Get display picture
	$retrieveDisplayPicture = "SELECT displayURL FROM users WHERE id = '$userID'";
	$result = mysqli_query($con, $retrieveDisplayPicture);
	$row = mysqli_fetch_assoc($result);
	$displayPicture = $row['displayURL'];

	// Get images
	$retrieveUserImages = "SELECT imageURL, itemID FROM image WHERE itemID IN (
							SELECT itemID FROM item WHERE userID = '$userID')";
	$result = mysqli_query($con, $retrieveUserImages);
	while ($row = mysqli_fetch_assoc($result)) {
		$imageURLS[] = $row['imageURL'];
	}

?>