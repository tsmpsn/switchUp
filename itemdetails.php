<?php 

require_once 'init.php';
require_once 'traderequest.php';
	
	$userID = $_SESSION["userID"];
	$con = mysqli_connect("localhost", "root", "edward", "switchup");
	if(mysqli_connect_errno()) {
		echo "Error: Could not connect to database.";
		exit;
	}
	
	// Load selected item
	$selectedItemID = $_GET['id'];
	$getItemDetails = "SELECT * FROM item WHERE itemID = '$selectedItemID'";
	$result = mysqli_query($con, $getItemDetails);
	$itemDetails = mysqli_fetch_assoc($result);
		// Get item image
		$getImage = "SELECT imageURL FROM image WHERE itemID = '$selectedItemID'";
		$result = mysqli_query($con, $getImage);
		$image = mysqli_fetch_assoc($result);
	
	// Get users items
	$retrieveUserItems = "SELECT itemName FROM item WHERE userID = '$userID'";
	$result = mysqli_query($con, $retrieveUserItems);
	$counter = 0;
	
	while ($row = mysqli_fetch_assoc($result)) {
		$itemNameDB[] = $row['itemName'];
		$counter++;
	}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dissertation</title>
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
    <div class="team-boxed maincontainer">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand navbar-link" href="#"><img src="assets/img/logo.png" id="sitelogo"></a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li role="presentation"><a href="home.php">Home </a></li>
                        <li role="presentation"><a href="profile.php">Profile </a></li>
                        <li role="presentation"><a href="help.php">Help </a></li>
                        <li role="presentation"><a href="login.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" id="tradecontent">
            <div class="col-md-4 col-sm-6 item">
                <div class="articles box"><img class="img-rounded profileimage" src="<?php echo $image['imageURL'] ?>">
                    <h3 class="name"><?php echo $itemDetails['itemName'] ?></h3>
                    <p class="title"><?php echo $itemDetails['Price'] ?></p>
                    <p class="description"><?php echo $itemDetails['Description'] ?></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6" id="tradingform">
                <h1>Trade? </h1>
                <form action='traderequest.php?id=<?php echo $_GET['id'];?>' method="post" id="requestatrade">
                    <div class="form-group">
                        <select class="form-control" name="itemname">
                            <?php for ($i = 0; $i < $counter; $i++) { ?>
								<option value="<?php printf($itemNameDB[$counter-1]); ?>"><?php printf($itemNameDB[$i]); ?></option>
							<?php } ?>
                        </select>
                    </div>
					<div class="form-group">
                        <select class="form-control" name="tradetype">
                            <optgroup label="">
                                <option value="1">Postal Delivery</option>
                                <option value="2">Meet Up</option>
                                <option value="3">Middleman</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" type="submit" id="confirmtrade">Confirm trade request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Tom Simpson © 2017</h5></div>
                <div class="col-sm-6 social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/formvalidation.js"></script>
    <script src="assets/js/homepanel.js"></script>
    <script src="assets/js/profilepanel.js"></script>
    <script src="assets/js/uploadform.js"></script>
</body>

</html>