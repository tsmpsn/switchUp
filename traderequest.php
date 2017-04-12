<?php 
require_once 'init.php';

if ($_POST) {
	
	$tradeID = getHighestTradeID();
	$userID1 = getUserIDFromItemID($_GET['id']);
	$userID2 = getUserIDFromUsername($_SESSION['username']);
	$itemID1 = $_GET['id'];
	$itemID2 = getitemIDFromItemName($_POST['itemname']);
	$tradetype = $_POST['tradetype'];
	$status = 0;
	$con = mysqli_connect("localhost", "root", "edward", "switchUP");
	$makeTradeRequest = "INSERT INTO trade (tradeID, userID1, userID2, itemID1, itemID2, tradeType, status, lastChanged) VALUES ( '$tradeID', '$userID1', '$userID2', '$itemID1', '$itemID2', '$tradetype', '$status', 'now()' )";
	if(mysqli_query($con, $makeTradeRequest)) {
		echo "trade request made";
	} else {
		echo "trade request failed";
	}
	header("location: home.php");
}
	
	function getHighestTradeID() {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$sql = "SELECT tradeID FROM trade ORDER BY tradeID DESC";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		$value = $row['tradeID'] + 1;
		return $value;
	}
	
	function getUserIDFromItemID($itemID) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$username = sanitizeData($con, $itemID);
		$query = "SELECT userID FROM item WHERE itemID = '$itemID'";
		$result = mysqli_query($con, $query);
		$userid = mysqli_fetch_assoc($result);
		return $userid['userID'];
	}
	
	function getitemIDFromItemName($itemName) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$query = "SELECT itemID FROM item WHERE itemName = '$itemName'";
		$result = mysqli_query($con, $query);
		$itemName = mysqli_fetch_assoc($result);
		return $itemName['itemID'];
	}
?>