<?php
require_once 'init.php';

$con = mysqli_connect("localhost", "root", "edward", "switchUP");
$userID = $_SESSION["userID"];

// Get users items
$retrieveUserItems = "SELECT * FROM item";
$result = mysqli_query($con, $retrieveUserItems);
$counter = 0;

while ($row = mysqli_fetch_object($result)) {
    $counter++;
	$itemIDDB[] = $row->itemID;
	$sizeDB[] = $row->Size;
    $priceDB[] = $row->Price;
    $descriptionDB[] = $row->Description;
    $conditionDB[] = $row->ItemCondition;
}

// Get images
$retrieveUserImages = "SELECT * FROM images";
$result = mysqli_query($con, $retrieveUserImages);
while ($row = mysqli_fetch_object($result)) {
	$imageURL[] = $row->imageURL;
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsfeed</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/AXY-Contact-Us.css">
    <link rel="stylesheet" href="assets/css/AXY-Contact-Us1.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
	<div class="uploadpopup">
        <form method="post">
            <h2 class="text-center">Tell us about your item</h2>
            <div class="form-group">
                <input type="file" name="image1ToUpload" id="image1ToUpload">
            </div>
            <div class="form-group">
                <select class="form-control" name="itemtype">
                    <optgroup label="Item Type">
                        <option value="jackets">Jackets</option>
                        <option value="tops" selected="">Tops</option>
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
                <button class="btn btn-primary btn-block uploadclose" type="submit">Upload Item</button>
            </div>
        </form>
    </div>
    <div class="team-boxed maincontainer">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">switchUp</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li role="presentation"><a id="upload">Upload </a></li>
                        <li role="presentation"><a href="home.php">Home </a></li>
                        <li role="presentation"><a href="messages.php">Messages </a></li>
                        <li role="presentation"><a href="profile.php">Profile </a></li>
                        <li role="presentation"><a href="help.php">Help </a></li>
                        <li role="presentation"><a href="login.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="intro">
                <h2 class="text-center"><?php if (isSet($_SESSION['userID'])) {echo"Welcome " . $_SESSION['username'];}?></h2></div>
				<div class="row articles">
					<?php for ($i = 0; $i < $counter; $i++) { ?>
						<div class="col-md-4 col-sm-6 item">
						<a href="#"><img class="img-responsive" src="<?php echo $imageURL[$i];?>"></a>
						<h4 class="itemh3"><?php echo "£" . $priceDB[$i];?></h4><h4 class="item3"><?php echo $sizeDB[$i] . "\t";if ($conditionDB == 11) {echo "NEW";} else {$conditionDB[$i];} echo $descriptionDB[$i];?></h4>
						</div>
					<?php } ?>
				</div>
        </div>
	</div>
		<section></section>
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
		<script src="assets/js/uploadform.js"></script>
</body>

</html>