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
    <link rel="stylesheet" href="assets/css/extra.css">
</head>

<body>
	<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand navbar-link" href="home.php"> <img src="assets/img/logo.png" id="sitelogo"></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="home.php">Home </a></li>
                    <li role="presentation"><a href="profile.php">Profile </a></li>
                    <li role="presentation"><a href="help.php">Help </a></li>
                    <li role="presentation"><a <?php if ( isset($_SESSION['userID'])) { echo "href='logout.php'";} else { echo "href='login.php'"; } ?> >Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
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
								<div class="traderow row">
									<div class="col-md-12">
										<h5>No trade requests</h5>
									</div>
								</div>
						<?php 
							} else {
								for ($i = 0; $i < $RnoOfTrades; $i++) { ?>
						<div class="traderow">
                            <div class="row tradeitems">
                                <div class="col-md-6">
                                    <h5><?php echo getitemNameFromItemID($RitemID1DB[$i]) ?></h5></div>
                                <div class="col-md-6">
                                    <h5><?php echo getitemNameFromItemID($RitemID2DB[$i]) ?></h5></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><?php if ($RuserID1DB[$i] == $userID) { echo getUsernameFromUserID($RuserID2DB[$i]); } else { echo getUsernameFromUserID($RuserID1DB[$i]);} ?></h5></div>
                                <div class="col-md-6">
                                    <h5><?php echo getTradeType($tradeTypeDB[$i]); ?></h5></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 tradedecision">
                                    <form method="post">
										<input class="form-control hidden" type="text" name="tradeID" value="<?php echo $RtradeIDDB[$i]?>">
										<input class="form-control hidden" type="text" name="itemID1" value="<?php echo $RitemID1DB[$i]?>">
										<input class="form-control hidden" type="text" name="itemID2" value="<?php echo $RitemID2DB[$i]?>">
                                        <button class="btn btn-default btn-sm" name="asubmit" type="submit" style="color:green;">confirm </button>
                                        <button class="btn btn-default btn-sm" name="dsubmit" type="submit">decline </button>
                                    </form>
                                </div>
                            </div>
                        </div>
						<?php }} ?>
					</div>
					<div id="taccepted">
                        <h4 class="text-center">Trades Accepted</h4>
                        <?php
							if ( $AnoOfTrades == 0 ) { ?>
								<div class="traderow row">
									<div class="col-md-12">
										<h5>No accepted trades</h5>
									</div>
								</div>
						<?php 
							} else {
								for ($i = 0; $i < $AnoOfTrades; $i++) { ?>
						<div class="traderow" id="<?php echo $AtradeIDDB[$i] ?>">
							<div class="row">
								<div class="hidden" id="passTradeID"><?php echo $AtradeIDDB[$i] ?></div>
								<div class="col-md-6">
									<h5><?php echo getitemNameFromItemID($AitemID1DB[$i]) ?></h5></div>
								<div class="col-md-6">
									<h5><?php echo getitemNameFromItemID($AitemID2DB[$i]) ?></h5></div>
							</div>
							<div class="row tradereq">
								<div class="col-md-6">
									<h5 id="lfu"><?php if ($AuserID1DB[$i] == $userID) { echo getUsernameFromUserID($AuserID2DB[$i]); } else { echo getUsernameFromUserID($AuserID1DB[$i]);} ?></h5></div>
								<div class="col-md-6 tradedecision leavereviewbtn">
									<form method="post">
										<input class="form-control hidden" type="text" name="tradeID" value="<?php echo $AtradeIDDB[$i]?>">
										<input class="form-control hidden" type="text" name="itemID1" value="<?php echo $AitemID1DB[$i]?>">
										<input class="form-control hidden" type="text" name="itemID2" value="<?php echo $AitemID2DB[$i]?>">
										<button class="btn btn-default btn-xs lvreview" name="lvreview" type="button">leave a review </button>
									</form>
								</div>
							</div>
						</div>
						<?php }} ?>
                    </div>
					<div id="tdeclined">
                        <h4 class="text-center">Trades Declined</h4>
                        <?php
							if ( $DnoOfTrades == 0 ) { ?>
								<div class="traderow row">
									<div class="col-md-12">
										<h5>No declined trades</h5>
									</div>
								</div>
						<?php 
							} else {
								for ($i = 0; $i < $DnoOfTrades; $i++) { ?>
						<div class="traderow">
							<div class="row" id="<?php echo $DtradeIDDB[$i] ?>">
								<div class="col-md-6">
									<h5><?php echo getitemNameFromItemID($DitemID1DB[$i]) ?></h5></div>
								<div class="col-md-6">
									<h5><?php echo getitemNameFromItemID($DitemID2DB[$i]) ?></h5></div>
							</div>
						</div>
						<?php }} ?>
                    </div>
					<div id="tcompleted">
                        <h4 class="text-center">Trades Completed</h4>
                        <?php
							if ( $CnoOfTrades == 0 ) { ?>
								<div class="traderow row">
									<div class="col-md-12">
										<h5>No completed trades</h5>
									</div>
								</div>
						<?php 
							} else {
								for ($i = 0; $i < $CnoOfTrades; $i++) { ?>
					<div id="tcompleted">
						<div class="traderow" id="<?php echo $CtradeIDDB[$i] ?>">
							<div class="row">
								<div class="col-md-6">
									<h5><?php echo getitemNameFromItemID($CitemID1DB[$i]) ?></h5></div>
								<div class="col-md-6">
									<h5><?php echo getitemNameFromItemID($CitemID2DB[$i]) ?></h5></div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5><?php if ($AuserID1DB[$i] == $userID) { echo getUsernameFromUserID($AuserID2DB[$i]); } else { echo getUsernameFromUserID($AuserID1DB[$i]);} ?></h5></div>
								<div class="col-md-6">
									<h5><?php echo $CtimeCompletedDB[$i] ?></h5></div>
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
					if ($MUcounter == 0) { ?>
						<div class="row convorow" style="border:0;">
							<h5 style="color:#a30d0d;">You have no messages </h5>
						</div>
					<?php } else {
						for ($i = 0; $i < $MUcounter; $i++) { ?>
						<div class="row convorow" style='<?php if( $i == $MUcounter -  1 ) { echo "border:0;"; }?>'>
							<a href="#" id="<?php echo $MuserIDs[$i] ?>" onClick="convo_clicked(this.id)">
								<div class="col-md-4 convodetails">
									<p><?php echo getUsernameFromUserID($MuserIDs[$i]) ?></p>
									<p><?php echo $recentTime[$i] ?></p>
								</div>
								<div class="col-md-8 messagecontent">
									<p><?php echo $recentMessage[$i] ?></p>
								</div>
							</a>
						</div>
					<?php }} ?>
					<div id="conversation">
						<div id="messages" style="text-align:center;">
							<!-- Printed through Ajax -->
						</div>
						<div class="row">
							<div class="col-md-12">
								<form id="messageuserform" method="post">
									<div class="col-md-8">
										<input class="form-control" type="text" name="messagetosend"/>
									</div>
									<input class="form-control hidden" type="text" id="sentto" name="sentto" value=""/>
									<div class="col-md-4">
										<button class="btn btn-default btn-xs" type="submit" name="chatmessage" id="sendchatmessage">send</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } else { ?>
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
		<?php for ($j = $counter - 1; $j > 0; $j--) { 
			$float = getItemFloat($j);
		?>
		<div class="col-md-4 col-sm-6 item"style="float='<?php echo $float; ?>'">
				<a href="itemdetails.php?id=<?php echo $itemIDDB[$j];?>">
				<h3 class="name"><?php echo $itemNameDB[$j]?></h3>
				<div class="row">
					<div class="col-md-12"><img class="img-rounded profileimage" src="<?php echo $imageURLS[$j];?>"></div>
				</div>
				</a>
				<div class="iteminfo">
					<div class="row">
						<div class="col-md-6">
							<p><?php echo $sizeDB[$j]; ?></p>
							<?php if (isset($_SESSION['userID'])) { 
									if ($usernameDB[$j] == getUsernameFromUserID($_SESSION['userID'])) { ?>
										<button class="btn btn-default btn-xs messagebutton" type="button" id="passitemusername" value="<?php echo $itemIDDB[$j]?>">delete</button>
									<?php } 
									else { ?>
										<button class="btn btn-default btn-xs messagebutton" type="button" id="passitemusername" value="<?php echo $usernameDB[$j]?>">message</button>
							<?php }} ?>
						</div>
						<div class="col-md-6">
							<p class="condition"><?php if ($conditionDB[$j] == 11) { echo "NEW"; } else { echo $conditionDB[$j] . "/10"; } ?></p>
							<a href="userprofile.php?<?php echo $usernameDB[$j] ?>" id="itemusername" class="username">
								<?php echo $usernameDB[$j] ?>
							</a>
						</div>
						<div class="col-md-12">
							<p class="description"><?php echo $descriptionDB[$j]; ?></p>
						</div>
					</div>
				</div>
        </div>
			<div id="messagebackgrounddiv" class=".messagepopup"></div>
			<div id="messagenewuser">
				<h3 id="msgreceiverID"></h3>
				<form method="post" class=".messagepopup">
					<div class="form-group">
						<textarea class="form-control" maxlength="50" name="newmessagetosend"></textarea>
					</div>
					<input class="form-control hidden" type="text" name="newsentto" id="msgreceiverID2" value="" />
					<div class="form-group">
						<button class="btn btn-default btn-xs" type="submit" name="newchatmessage">send</button>
					</div>
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
		/* Pass item user to popup message box */
		var msg = "Message ";
		document.getElementById("msgreceiverID").innerHTML = msg.concat(document.getElementById("passitemusername").value);
		document.getElementById("msgreceiverID2").value = document.getElementById("passitemusername").value;
		function convo_clicked(id) {
			var MuserID = id;
			$("#sentto").val(MuserID);
			$.ajax({
				type: "POST",
				url: "loadmessages.php",
				dataType: "html",
				data:{action:MuserID},
				success: function(data) {
					$("#messages").html(data);
				}
			});
		}
	</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/formvalidation.js"></script>
    <script src="assets/js/homepanel.js"></script>
    <script src="assets/js/profilepanel.js"></script>
    <script src="assets/js/uploadform.js"></script>
	<script src="assets/js/messagenewuser.js"></script>
	<script src="assets/js/loadmessages.js"></script>
</body>

</html>