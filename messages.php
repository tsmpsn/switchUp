<?php
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	
	
//Retrieve users messages
	$sql = "SELECT * FROM message WHERE senderID OR receiverID = '$userID'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_object($result);
	while ($row = mysqli_fetch_object($result)) {
		//$noOfMessages++;
		$messageIDDB[] = $row->messageID;
		$messageDB[] = $row->message;
		$senderIDDB[] = $row->senderID;
		$receiverIDDB[] = $row->receiverID;
		$timeSentDB[] = $row->timeSent;
	}
	
// Insert new message	

	//$messageID = getHighestMessageID($con);
	//$message = $_POST['message'];
	//$senderID = $_SESSION['userID'];
	//$receiverID = getUserIDFromUsername(xxxxx);
	
	//$insertMessage = "INSERT INTO message (messageID, message, senderID, receiverID, timeSent) VALUES ('$messageID', '$message', '$senderID', '$receiverID', now())";
	//if (mysqli_query($con, $insertMessage)) {
		
	//} else {
		//"failed";
	//}
	

// Functions
function getHighestMessageID($con) {
	$sql = "SELECT imageID FROM image ORDER BY imageID DESC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$value = $row['imageID'] + 1;
	return $value;
}

// Get messaged users
$MUcounter = 0;
$messagedUsers = "SELECT value FROM ( SELECT DISTINCT senderID AS value FROM message WHERE senderID OR receiverID = '$userID' UNION 
					SELECT DISTINCT receiverID AS value FROM message WHERE senderID OR receiverID = '$userID') AS derived";
$result = mysqli_query($con, $messagedUsers);
$numrows = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
	if ($row['value'] != $userID) {
		$MuserIDs[] = $row['value'];
		$MUcounter++;
	}
}

// Get most recent message and time
for ($i = 0; $i < count($MuserIDs); $i++) {
	$sql = "SELECT * FROM message WHERE messageID = 
				(SELECT messageID FROM message WHERE (senderID = '$userID' OR receiverID = '$userID') AND (senderID = '$MuserIDs[$i]' OR receiverID = '$MuserIDs[$i]') 
					ORDER BY messageID DESC LIMIT 1)";
	$result = mysqli_query($con, $sql);
	$obj = mysqli_fetch_object($result);
	$recentMessage[] = $obj->message;
	$recentTime[] = $obj->timeSent;
	
}

?>