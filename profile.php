<?php
require_once 'init.php';
require 'upload.php';
//require 'loadProfile.php';
require_once 'loadreviews.php';

$con = mysqli_connect("localhost", "root", "edward", "switchup");

if (isSet($_SESSION["userID"])) {
	
	//loadProfile();
	// Get user details
	$query = "SELECT description FROM users WHERE id = '$userID'";
	$result = mysqli_query($con, $query);
	$user = mysqli_fetch_assoc($result);
	$userDescription = $user['description'];

	// Get users items
	$retrieveUserItems = "SELECT * FROM item WHERE userID = '$userID'";
	$result = mysqli_query($con, $retrieveUserItems);
	$counter = 0;

	while ($row = mysqli_fetch_object($result)) {
		$counter++;
		$itemIDDB[] = $row->itemID;
		$itemNameDB[] = $row->itemName;
		$sizeDB[] = $row->Size;
		$priceDB[] = $row->Price;
		$descriptionDB[] = $row->Description;
		$conditionDB[] = $row->ItemCondition;
	}

	// Get display picture
	$retrieveDisplayPicture = "SELECT displayURL FROM users WHERE id = '$userID'";
	$result = mysqli_query($con, $retrieveDisplayPicture);
	$row = mysqli_fetch_assoc($result);
	$displayPicture = $row['displayURL'];

	// Get images
	$retrieveUserImages = "SELECT imageURL, itemID FROM image WHERE itemID IN (
							SELECT itemID FROM item WHERE userID = '$userID')";
	$result = mysqli_query($con, $retrieveUserImages);
	while ($row = mysqli_fetch_assoc($result)) {
		$imageURLS[] = $row['imageURL'];
	}
} else {
	header("location: login.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                    <li role="presentation"><a href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
	<div class="col-md-3 panel">
        <div class="row" id="rowcontent">
            <div class="col-md-6 panelheader" id="loaddetails"><a href="#"><h4>User Info</h4></a></div>
            <div class="col-md-6 panelheader" id="loadreviews"><a href="#"><h4>Reviews </h4></a></div>
            <div class="col-md-12" id="uploadform">
                <form method="post" enctype="multipart/form-data">
                    <h4 class="text-center">Tell us about your item</h4>
                    <div class="form-group imgfile">
                        <input type="file" name="image1ToUpload" id="image1ToUpload">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="itemname" placeholder="Name this item">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="itemtype">
                            <optgroup label="Item Type">
                                <option value="jackets">Jackets</option>
                                <option value="tops">Tops</option>
                                <option value="bottoms">Bottoms</option>
                                <option value="shoes">Shoes</option>
                                <option value="accessories">Accessories</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="size">
                            <optgroup label="Size">
                                <option value="xs" selected="">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                                <option value="xxl">XXL</option>
                            </optgroup>
                            <optgroup label="Shoe Size">
                                <option value="UK1">UK1</option>
                                <option value="UK2">UK2</option>
                                <option value="UK3">UK3</option>
                                <option value="UK4">UK4</option>
                                <option value="UK5">UK5</option>
                                <option value="UK6">UK6</option>
                                <option value="UK7">UK7</option>
                                <option value="UK8">UK8</option>
                                <option value="UK9">UK9</option>
                                <option value="UK10">UK10</option>
                                <option value="UK11">UK11</option>
                                <option value="UK12">UK12</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="description" placeholder="Describe your item">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="condition" value="Condition">
                            <optgroup label="Condition">
                                <option value="1" selected="">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">NEW</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" id="uploaditem">Upload Item</button>
                        <button class="btn btn-primary btn-block" type="reset" id="uploadcancel">cancel</button>
                    </div>
				</form>
            </div>
            <div class="col-md-12">
                <div id="userdetails" class="panelcontent">
					<div class="row">
                        <div class="col-md-12">
							<div id="displaypicture"><img class="img-rounded avatar" src="<?php if ($displayPicture == NULL) { echo "assets/img/defaultpicture.jpg"; } else { echo $displayPicture; }?>" alt="User Avatar"></div>
						</div>
					</div>
					<div class="row">
                        <div class="col-md-12">
							<h2 class="text-center" id="profileusername"><?php if (isSet($_SESSION['userID'])) {echo"Welcome " . $_SESSION['username'];}?></h2>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><?php if ($userDescription == '') { ?> <a>Add Description</a><?php } else { echo $userDescription; }?></p>
                        </div>
                    </div>
                    <button class="btn btn-default" type="button" id="loaduploadform">upload item</button>
				</div>
                <div id="userreviews" class="panelcontent">
				<?php for ($i = 0; $i < $noOfReviews; $i++) { ?>
                    <div class="row">
						<div class="col-md-4"><img class="img-rounded starrating userreviewstars" src="assets/img/stars.png" alt="User rating"></div>
                        <div class="col-md-8"><h5><?php echo $leftByDB[$i] ?></h5></div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h5><?php echo $dateLeftDB[$i] ?></h5></div>
						<div class="col-md-8">
							<p class="reviewdescription"><?php echo $RdescriptionDB[$i] ?></p>
						</div>
					</div>
				<?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container items">
        <div class="row people">
            <?php for ($i = 0; $i < $counter; $i++) { ?>
			<div class="col-md-4 col-sm-6 item">
				<div class="articles box">	
					<h3 class="name"><?php echo $itemNameDB[$i]?></h3>
					<a href="itemdetails.php?id=<?php echo $itemIDDB[$i];?>">
						<img class="img-rounded profileimage" id="<?php echo $itemIDDB[$i]; ?>" src="<?php echo $imageURLS[$i] ?>"></a>
					</a>
					<p class="price"><?php echo "£" . $priceDB[$i];?></p>
					<p class="condition"><?php if ($conditionDB[$i] == 11) { echo "NEW"; } else { echo $conditionDB[$i]; } ?></p>
					<p class="description"><?php echo $sizeDB[$i] . "\t"; echo $descriptionDB[$i];?></p>
				</div>
			</div>
			<?php } ?>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/formvalidation.js"></script>
	<script src="assets/js/homepanel.js"></script>
    <script src="assets/js/profilepanel.js"></script>
    <script src="assets/js/uploadform.js"></script>
</body>

</html>