<?php

require('init.php');

if ($_POST) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) == true || empty($password) == true) {
		$errors[] = 'Enter your username and password';
	} else if (userExists($username) == false) {
		$errors[] = 'Username does not exist';
	} else {
		$login = userLogin($username, $password);
		if ($login == false) {
			$errors[] = 'Username and password do not match';
		} else {
			$_SESSION["userID"] = $login;
			$_SESSION["username"] = $username;
			header("location: home.php");
		}
	}
	print_r($errors);
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
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
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
    <div class="login-clean">
        <form method="post" action="login.php">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><img src="assets/img/fbpic.jpg" id="loginavatar"></div>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
            </div><a href="#" id="registerlink">Register </a><a href="#" class="forgot">Forgot your email or password?</a></form>
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
    <script src="assets/js/uploadform.js"></script>
	<script src="parsley.min.js"></script>
</body>

</html>