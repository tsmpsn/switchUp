<?php

// LEAVE REVIEW
	if ( isset($_POST['rsubmit'])) {
		$con = mysqli_connect("localhost", "root", "edward", "switchUP");
		$reviewID = getHighestReviewID($con);
		$rating = $_POST['rating'];
		$description = $_POST['description'];
		$tradeID = $_POST['tradeID'];
		$leftFor = getUserIDFromUsername($_POST['leftFor']);
		$leftBy = getUserIDFromUsername($_SESSION['username']);
		$addReview = "INSERT INTO review (reviewID, rating, description, leftFor, leftBy, dateLeft) VALUES ( '$reviewID', '$rating', '$description', '$leftFor', '$leftBy', now())";
		if(mysqli_query($con, $addReview)) {
			
		} else {
			echo "review upload failed";
		}
		updateTradeReviews($con, $tradeID);
	}

// FUNCTIONS
	
	function getHighestReviewID($con) {
		$sql = "SELECT reviewID FROM review ORDER BY reviewID DESC";
		$result = mysqli_query($con, $sql);
		if ( mysqli_num_rows($result) == 0 ) {
			return 1;
		}
		$row = mysqli_fetch_assoc($result);
		$value = $row['reviewID'] + 1;
		return $value;
	}
	
	function updateTradeReviews($con, $tradeID) {
		$getUserIDs = "SELECT userID1, userID2 FROM trade WHERE tradeID = '$tradeID'";
		$result = mysqli_query($con, $getUserIDs);
		$uids = mysqli_fetch_assoc($result);
		
		if ($uids['userID1'] == $_SESSION['userID']) {
			$updateCompletionStatus = "UPDATE trade SET reviewID1 = 1 WHERE tradeID = '$tradeID'";
			mysqli_query($con, $updateCompletionStatus);
			checkCompleted($tradeID, $con);
		} else if ($uids['userID2'] == $_SESSION['userID']) {
			$updateCompletionStatus = "UPDATE trade SET reviewID2 = 1 WHERE tradeID = '$tradeID'";
			mysqli_query($con, $updateCompletionStatus);
			checkCompleted($tradeID, $con);
		} else {
			echo "problem";
		}
	}
	
	function checkCompleted($tradeID, $con) {
		$completionStatus = "SELECT reviewID1, reviewID2 FROM trade WHERE tradeID = '$tradeID'";
		$result = mysqli_query($con, $completionStatus);
		$values = mysqli_fetch_assoc($result);
		if (($values['reviewID1'] == 1) && ($values['reviewID2'] == 1)) {
			$status = 2;
			updateTrade($status, $con);
		}
	}
	
?>