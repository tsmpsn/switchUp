<?php
require_once 'init.php';

$con = mysqli_connect("localhost", "root", "edward", "switchUP");
if (isset($_SESSION["userID"])) {
	$userID = $_SESSION["userID"];
	require_once 'trades.php';
	require_once 'leavereview.php';
	require_once 'messages.php';
}

require_once 'Phome.php';


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/AXY-Contact-Us.css">
    <link rel="stylesheet" href="assets/css/AXY-Contact-Us1.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean-1.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
    
	
    <div class="col-md-3 panel">
        <div class="row" id="tmrow">
            <div class="col-md-6 panelheader" id="loadtrades"><a href="#"><h4>Trades </h4></a></div>
            <div class="col-md-6 panelheader" id="loadmessages"><a href="#"><h4>Messages </h4></a></div>
            <div class="col-md-12 panelcontent" id="trademessages">
                <div id="usertrades">
				<?php if ( isset($_SESSION["userID"])) { ?>
					<div id="trequests">
						<h4 class="text-center">Trade Requests</h4>
						<?php
							if ( $RnoOfTrades == 0 ) { ?>
								<div class="row" id="<?php echo $RtradeIDDB[$i] ?>">
								<div class="col-md-6">
									<h5> </h5></div>
								<div class="col-md-6">
									<h5> </h5></div>
							</div>
						<?php 
							} else {
								for ($i = 0; $i < $RnoOfTrades; $i++) { ?>
						<div class="row" id="<?php echo $RtradeIDDB[$i] ?>">
							<div class="col-md-6">
								<h5><?php echo getitemNameFromItemID($RitemID1DB[$i]) ?></h5></div>
							<div class="col-md-6">
								<h5><?php echo getitemNameFromItemID($RitemID2DB[$i]) ?></h5></div>
						</div>
						<div class="row tradereq">
							<div class="col-md-4">
                                <h5><?php if ($RuserID1DB[$i] == $userID) { echo $RuserID21DB[$i]; } else { echo $RuserID1DB[$i];} ?></h5></div>
							<div class="col-md-8 tradedecision">
								<form method="post">
									<input class="form-control hidden" type="text" name="tradeID" value="<?php echo $RtradeIDDB[$i]?>">
									<input class="form-control hidden" type="text" name="itemID1" value="<?php echo $RitemID1DB[$i]?>">
									<input class="form-control hidden" type="text" name="itemID2" value="<?php echo $RitemID2DB[$i]?>">
									<button class="btn btn-default btn-xs" name="dsubmit" type="submit">decline </button>
									<button class="btn btn-default btn-xs" name="asubmit" type="submit">accept </button>
								</form>
							</div>
						</div>
						<?php }} ?>
					</div>
					<div id="taccepted">
                        <h4 class="text-center">Trades Accepted</h4>
                        <?php
							if ( $AnoOfTrades == 0 ) { ?>
								<div class="row" id="<?php echo $AtradeIDDB[$i] ?>">
								<div class="col-md-6">
									<h5> </h5></div>
								<div class="col-md-6">
									<h5> </h5></div>
							</div>
						<?php 
							} else {
								for ($i = 0; $i < $AnoOfTrades; $i++) { ?>
						<div class="row" id="<?php echo $AtradeIDDB[$i] ?>">
							<div class="hidden" id="passTradeID"><?php echo $AtradeIDDB[$i] ?></div>
							<div class="col-md-6">
								<h5><?php echo getitemNameFromItemID($AitemID1DB[$i]) ?></h5></div>
							<div class="col-md-6">
								<h5><?php echo getitemNameFromItemID($AitemID2DB[$i]) ?></h5></div>
						</div>
						<div class="row tradereq">
                            <div class="col-md-5">
                                <h5 id="lfu"><?php if ($AuserID1DB[$i] == $userID) { echo getUsernameFromUserID($AuserID2DB[$i]); } else { echo getUsernameFromUserID($AuserID1DB[$i]);} ?></h5></div>
                            <div class="col-md-7 tradedecision">
                                <form method="post">
                                    <input class="form-control hidden" type="text" name="tradeID" value="<?php echo $AtradeIDDB[$i]?>">
									<input class="form-control hidden" type="text" name="itemID1" value="<?php echo $AitemID1DB[$i]?>">
									<input class="form-control hidden" type="text" name="itemID2" value="<?php echo $AitemID2DB[$i]?>">
                                    <button class="btn btn-default btn-xs lvreview" name="lvreview" type="button">leave a review </button>
                                </form>
                            </div>
                        </div>
						<?php }} ?>
                    </div>
					<div id="tdeclined">
                        <h4 class="text-center">Trades Declined</h4>
                        <?php
							if ( $DnoOfTrades == 0 ) { ?>
								<div class="row" id="<?php echo $DtradeIDDB[$i] ?>">
								<div class="col-md-6">
									<h5> </h5></div>
								<div class="col-md-6">
									<h5> </h5></div>
							</div>
						<?php 
							} else {
								for ($i = 0; $i < $DnoOfTrades; $i++) { ?>
						<div class="row" id="<?php echo $DtradeIDDB[$i] ?>">
							<div class="col-md-6">
								<h5><?php echo getitemNameFromItemID($DitemID1DB[$i]) ?></h5></div>
							<div class="col-md-6">
								<h5><?php echo getitemNameFromItemID($DitemID2DB[$i]) ?></h5></div>
						</div>
						<?php }} ?>
                    </div>
					<div id="tcompleted">
                        <h4 class="text-center">Trades Completed</h4>
                        <?php
							if ( $CnoOfTrades == 0 ) { ?>
								<div class="row" id="<?php echo $CtradeIDDB[$i] ?>">
								<div class="col-md-6">
									<h5> </h5></div>
								<div class="col-md-6">
									<h5> </h5></div>
							</div>
						<?php 
							} else {
								for ($i = 0; $i < $CnoOfTrades; $i++) { ?>
								<div class="row" id="<?php echo $CtradeIDDB[$i] ?>">
									<div class="col-md-6">
										<div class="row tradereq">
											<div class="col-md-12">
												<h5><?php echo getitemNameFromItemID($CitemID1DB[$i]) ?></h5></div>
										</div>
										<div class="row tradereq">
											<div class="col-md-12">
												<h5>username</h5></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row tradereq">
											<div class="col-md-12">
												<h5><?php echo getitemNameFromItemID($CitemID2DB[$i]) ?></h5></div>
										</div>
										<div class="row tradereq">
											<div class="col-md-12">
												<h5>27/03/17 </h5></div>
										</div>
									</div>
								</div>
						<?php }} ?>
                    </div>
				<?php } else { ?>
					<a href="login.php"><h2 style="color:#a30d0d;padding: 3%">Please login to view trades </h2></a>
				<?php } ?>
				</div>
                <div id="usermessages">
                <?php 
				if (isset($_SESSION['userID'])) {
					for ($i = 0; $i < $MUcounter; $i++) { ?>
					<a href="#" class="showconvo"><div class="row">
                        <div class="col-md-3">
                            <h6><?php echo getUsernameFromUserID($MuserIDs[$i]) ?></h6></div>
                        <div class="col-md-7 messagecontent">
                            <h6><?php echo $recentMessage[$i] ?></h6></div>
                        <div class="col-md-2">
                            <h6><?php echo $recentTime[$i] . " " ?></h6></div>
                    </div></a>
					<div id="conversation">
						<h4 class="text-center" id="convousername"><?php echo getUsernameFromUserID($MuserIDs[$i]) ?></h4>
						<?php //for ($i = 0; $i < $numMessages; $i++) { ?>
						<div class="row">
							<div class="col-md-12">
								<p>Paragraph</p>
							</div>
						</div>
						<?php// } ?>
						<form method="post" id="messageuser">
							<div class="form-group">
								<textarea class="form-control" form="userreviewform" maxlength="50"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-default btn-xs" type="button" id="submitreview">send</button>
							</div>
							<input class="form-control hidden" type="text" name="tradeID">
						</form>
					</div>
				<?php }} else { ?>
				<a href="login.php"><h2 style="color:#a30d0d;padding: 3%">Please login to view messages </h2></a>
				<?php } ?>
                </div>
				<div id="leavereview">
                    <h4 class="text-center" id="reviewheader"></h4>
                    <form id="userreviewform" method="post">
                        <div class="form-group">
                            <textarea name="description" class="form-control" form="userreviewform" maxlength="50"></textarea>
                        </div>
						<div class="form-group">
							<select name="rating">
								<optgroup label="rating">
									<option value="5" selected="">5</option>
									<option value="4">4</option>
									<option value="3">3</option>
									<option value="2">2</option>
									<option value="1">1</option>
								</optgroup>
							</select>
						</div>
						<input class="form-control hidden" type="text" name="tradeID" id="submitTradeID"/>
						<input class="form-control hidden" type="text" name="leftFor" id="submitLeftFor"/>
						<div class="form-group">
							<button class="btn btn-default btn-xs" name="rsubmit" type="submit" id="submitreview">submit</button>
						</div>
					</form>
                    <p>Please remember, reviews are permenant and cannot be changed</p>
                </div>
			</div>
        </div>
    </div>
    <div class="container items">
    <div class="row people">
		<?php for ($j = 0; $j < $counter; $j++) { ?>
            <div class="col-md-4 col-sm-6 item">
                <div class="box">
                    <a href="itemdetails.php?id=<?php echo $itemIDDB[$j];?>">
					<h3 class="name"><?php echo $itemNameDB[$j]?></h3>
					<div class="row">
						<div class="col-md-12"><img class="img-rounded profileimage" src="<?php echo $imageURLS[$j];?>"></div>
					</div>
					</a>
					<div class="row">
                        <div class="col-md-6">
							<p class="price"><?php echo "£" . $priceDB[$j]; ?></p>
						</div>
						<div class="col-md-6">
							<p class="condition"><?php if ($conditionDB[$j] == 11) { echo "NEW"; } else { echo $conditionDB[$j]; } ?></p>
						</div>
					</div>
					<div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-default btn-xs messagebutton" type="button">message</button>
                        </div>
                        <div class="col-md-6">
                            <a href="userprofile.php?<?php echo $usernameDB[$j] ?>"><p class="username"><?php echo $usernameDB[$j] ?></p></a>
                        </div>
                    </div>
                    <p class="description"><?php echo $descriptionDB[$j]; ?></p>
                </div>
            </div>
			<div id="messagebackgrounddiv" class=".messagepopup"></div>
			<div id="messagenewuser">
				<h3>Message <?php echo $usernameDB[$i] ?></h3>
				<form method="post" class=".messagepopup">
					<div class="form-group">
						<textarea class="form-control" form="userreviewform" maxlength="50"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-default btn-xs" type="button" id="submitreview">send</button>
					</div>
					<input class="form-control hidden" type="text" name="tradeID">
				</form>
			</div>
		<?php } ?>
    </div>
	</div>
	<script type="text/javascript">
		var txt = "Leave Review for ";
		document.getElementById("reviewheader").innerHTML = txt.concat(document.getElementById("lfu").textContent);
		document.getElementById("submitTradeID").value = document.getElementById("passTradeID").textContent;
		document.getElementById("submitLeftFor").value = document.getElementById("lfu").textContent;
		//document.getElementById("convousername").innerHTML = txt.concat(document.getElementById("lfu").textContent);
	</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/formvalidation.js"></script>
    <script src="assets/js/homepanel.js"></script>
    <script src="assets/js/profilepanel.js"></script>
    <script src="assets/js/uploadform.js"></script>
	<script src="assets/js/messagenewuser.js"></script>
</body>

</html>