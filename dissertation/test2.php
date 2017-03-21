<?php
require_once 'init.php';

$con = mysqli_connect("localhost", "root", "edward", "dissertation");
$userID = $_SESSION["userID"];
$retrieveUserItems = "SELECT itemID FROM item WHERE userID = '$userID'";
$result = mysqli_query($con, $retrieveUserItems);
$row = mysqli_fetch_all($result, MYSQLI_NUM);
//foreach ($row as $value) {
	//echo $value[0] . " ";
//}
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
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
    <div id="background">
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
    </div>
    <div class="article-list">
        <div class="container">
            <div class="intro">
                <h2 class="text-center"><?php if (isSet($_SESSION['userID'])) {echo"Welcome " . $_SESSION['username'];}?></h2>
            </div>
            <div class="row articles">
			
			<?php foreach ($row as $value) { ?>
                <div class="col-md-4 col-sm-6 item">
                    <a href="#"><img class="img-responsive" src="assets/img/Image1.jpg"></a>
                    <h3 class="name"><?php echo $value[0] . " ";?></h3>
			<?php } ?>
<!--                   <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="glyphicon glyphicon-circle-arrow-right"></i></a></div>
                <div class="col-md-4 col-sm-6 item">
                    <a href="#"><img class="img-responsive" src="assets/img/Image2.jpg"></a>
                    <h3 class="name">echo $value[0] . " ";</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="glyphicon glyphicon-circle-arrow-right"></i></a></div>
				<div class="col-md-4 col-sm-6 item">
					<a href="#"><img class="img-responsive" src="assets/img/Image3.jpg"></a>
					<h3 class="name">echo $value[0] . " ";</h3>
					<p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="glyphicon glyphicon-circle-arrow-right"></i></a></div>
			-->
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