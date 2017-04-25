<?php
// LOADING PAGE
		
// Get users items
$retrieveUserItems = "SELECT * FROM item";
$result = mysqli_query($con, $retrieveUserItems);
$counter = 0;

while ($row = mysqli_fetch_object($result)) {
    $counter++;
	$itemIDDB[] = $row->itemID;
	$itemNameDB[] = $row->itemName;
	$usernameDB[] = getUsernameFromUserID($row->userID);
	$sizeDB[] = $row->Size;
    $descriptionDB[] = $row->Description;
    $conditionDB[] = $row->ItemCondition;
}

// Get images
$getUserImages = "SELECT imageURL FROM image";
$result = mysqli_query($con, $getUserImages);
while ($row = mysqli_fetch_assoc($result)) {
	$imageURLS[] = $row['imageURL'];
}

?>