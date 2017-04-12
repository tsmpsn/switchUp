<?php

// get user reviews
$noOfReviews = 0;
$getUserReviews = "SELECT * FROM review WHERE leftFor = '$userID'";
$result = mysqli_query($con, $getUserReviews);
while ($row = mysqli_fetch_object($result)) {
	$noOfReviews++;
	$reviewIDDB[] = $row->reviewID;
	$ratingDB[] = $row->rating;
	$RdescriptionDB[] = $row->description;
	$leftByDB[] = $row->leftBy;
	$dateLeftDB[] = $row->dateLeft;
	$timeRequestedDB[] = $row->lastChanged;
}

?>