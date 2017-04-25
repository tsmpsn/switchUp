<?php

// TRADES


// get user trade requests
	$RnoOfTrades = 0;
	$getUserTradeRequests = "SELECT * FROM trade WHERE status = 0 AND userID1 = '$userID'";
	$result = mysqli_query($con, $getUserTradeRequests);
	while ($row = mysqli_fetch_object($result)) {
		$RnoOfTrades++;
		$RtradeIDDB[] = $row->tradeID;
		$RitemID1DB[] = $row->itemID1;
		$RitemID2DB[] = $row->itemID2;
		$RuserID1DB[] = $row->userID1;
		$RuserID2DB[] = $row->userID2;
		$tradeTypeDB[] = $row->tradeType;
		$RtimeRequestedDB[] = $row->lastChanged;
	}

// Accept or deny trade request
	if ( isset( $_POST['asubmit'] )) {
			$status = 1;
			updateTrade($status, $con);
		} else if ( isset( $_POST['dsubmit'] )) {
			$status = -1;
			updateTrade($status, $con);
		}
	
//get user's accepted trades
	$AnoOfTrades = 0;
	$getUserAcceptedTrades = "SELECT * FROM trade WHERE status = 1 AND (userID1 = '$userID'OR userID2 = '$userID')";
	$result = mysqli_query($con, $getUserAcceptedTrades);
	$no = mysqli_num_rows($result);
	while ($row = mysqli_fetch_object($result)) {
		$AnoOfTrades++;
		$AtradeIDDB[] = $row->tradeID;
		$AitemID1DB[] = $row->itemID1;
		$AitemID2DB[] = $row->itemID2;
		$AuserID1DB[] = $row->userID1;
		$AuserID2DB[] = $row->userID2;
		$AtimeAcceptedDB[] = $row->lastChanged;
	}

//get user's declined trades
	$DnoOfTrades = 0;
	$getUserDeclinedTrades = "SELECT * FROM trade WHERE status = -1 AND (userID1 = '$userID'OR userID2 = '$userID')";
	$result = mysqli_query($con, $getUserDeclinedTrades);
	while ($row = mysqli_fetch_object($result)) {
		$DnoOfTrades++;
		$DtradeIDDB[] = $row->tradeID;
		$DitemID1DB[] = $row->itemID1;
		$DitemID2DB[] = $row->itemID2;
		$DtimeDeclinedDB[] = $row->lastChanged;
	}

// Get user's completed trades
	$CnoOfTrades = 0;
	$getUserCompletedTrades = "SELECT * FROM trade WHERE status = 2 AND (userID1 = '$userID'OR userID2 = '$userID')";
	$result = mysqli_query($con, $getUserCompletedTrades);
	while ($row = mysqli_fetch_object($result)) {
		$CnoOfTrades++;
		$CtradeIDDB[] = $row->tradeID;
		$CitemID1DB[] = $row->itemID1;
		$CitemID2DB[] = $row->itemID2;
		$CtimeCompletedDB[] = $row->lastChanged;
	}

function updateTrade($status, $con) {
	// Update trade table
	$tradeID = $_POST['tradeID'];
	$updateTradeStatus = "UPDATE trade SET status='$status', lastChanged=now() WHERE tradeID = '$tradeID'";
	// Mark items as swapped
	$itemID1 = $_POST['itemID1'];
	$itemID2 = $_POST['itemID2'];
	$markItemsSwapped = "UPDATE item SET Swapped=1 WHERE itemID = '$itemID1' OR '$itemID2'";
	
	if (mysqli_query($con, $updateTradeStatus) && mysqli_query($con, $markItemsSwapped)) {
		
	}
}

function getTradeType($typeNo) {
	if ($typeNo == 1) {
		echo "Postal Delivery";
	} else if ($typeNo == 2) {
		echo "Meet Up";
	} else if ($typeNo == 3) {
		echo "Middleman";
	}
}
	

?>