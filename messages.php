<?php
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	
	
//Retrieve users conversations
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
	if ( isset($_POST['chatmessage'])) {
		$messageID = getHighestMessageID($con);
		$message = $_POST['messagetosend'];
		$senderID = $_SESSION['userID'];
		$receiverID = $_POST['sentto'];
		
		insertMessage($messageID, $message, $senderID, $receiverID, $con);
	}
	
	if ( isset($_POST['newchatmessage'])) {
		$messageID = getHighestMessageID($con);
		$message = $_POST['newmessagetosend'];
		$senderID = $_SESSION['userID'];
		$receiverID = getUserIDFromUsername($_POST['newsentto']);
		
		insertMessage($messageID, $message, $senderID, $receiverID, $con);
	}
	

// Functions
function getHighestMessageID($con) {
	$sql = "SELECT messageID FROM message ORDER BY messageID DESC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$value = $row['messageID'] + 1;
	return $value;
}

function insertMessage($messageID, $message, $senderID, $receiverID, $con) {
	
	$insertMessage = "INSERT INTO message (messageID, message, senderID, receiverID, timeSent) VALUES ('$messageID', '$message', '$senderID', '$receiverID', now())";
	mysqli_query($con, $insertMessage);
}

// Get messaged users
$MUcounter = 0;
$messagedUsers = "SELECT value FROM ( SELECT DISTINCT senderID AS value FROM message WHERE senderID = '$userID' OR receiverID = '$userID' UNION 
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
	for ($i = 0; $i < $MUcounter; $i++) {
		$sql = "SELECT * FROM message WHERE messageID = 
					(SELECT messageID FROM message WHERE (senderID = '$userID' OR receiverID = '$userID') AND (senderID = '$MuserIDs[$i]' OR receiverID = '$MuserIDs[$i]') 
						ORDER BY messageID DESC LIMIT 1)";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		$recentMessage[] = $row['message'];
		$recentTime[] = $row['timeSent'];
	}

?>