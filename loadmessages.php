<?php
require_once 'init.php';
require_once 'functions.php';
$con = mysqli_connect("localhost", "root", "edward", "switchUP");

//Retrieve conversation messages
	$usersID = $_POST['action'];
	$loggedInUserID = $_SESSION['userID'];
	$noOfMessages = 0;
	$sql = "SELECT * FROM message WHERE (senderID = '$usersID' AND receiverID = '$loggedInUserID') OR (senderID = '$loggedInUserID' AND receiverID = '$usersID')";
	$result = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_object($result)) {
		$noOfMessages++;
		$messageIDDB[] = $row->messageID;
		$messageDB[] = $row->message;
		$senderIDDB[] = $row->senderID;
		$receiverIDDB[] = $row->receiverID;
		$timeSentDB[] = $row->timeSent;
	}
?>
	<h4 class="text-center" id="convousername"><?php echo getUsernameFromUserID($usersID) ?></h4>
<?php for ($i = 0; $i < $noOfMessages; $i++) { ?>
		<div class="row">
			<div class="col-md-12">
				<p <?php if ($receiverIDDB[$i] == $loggedInUserID) { echo "style='float:left;background-color:#fff;text-align:left'"; } else { echo "style='color:#fff;float:right;background-color:#a30d0d;text-align:right'"; } ?>"><?php echo $messageDB[$i] ?></p>
			</div>
		</div>
<?php } ?>