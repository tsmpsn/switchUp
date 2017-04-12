<?php
	require 'init.php';
	
	$con = mysqli_connect("localhost", "root", "edward", "switchUp");
	if ($_POST) {
		$userID = getHighestuserID();
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password-repeat'];
		
		// Gets user display picture information
		$i = -1;
		$imageURL = getImageURL($i);
		
		// Checks the user entered their password correctly
		if ($password != $password2) {
			echo '<script language="javascript">';echo 'alert("Passwords do not match")';echo '</script>';
		} else if (usernameAlreadyExists($username)) {
			echo '<script language="javascript">';echo 'alert("That username is taken, please try a different one")';echo '</script>';
		} else {
			// Attempt insert query execution
			$password = md5($password);
			$dob = $_POST['dob'];
			$sql = "INSERT INTO users (id, username, fullname, email, displayURL, password, dob, joined) VALUES ('$userID', '$username', '$fullname', '$email', '$imageURL', '$password', '$dob', now())";

			if(mysqli_query($con, $sql)){
				$_SESSION['userID'] = $userID;
				$_SESSION['username'] = $username;
				echo "Records inserted successfully.";
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
			}
		}
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
                    <li role="presentation"><a href="home.php">Home </a></li>
                    <li role="presentation"><a href="profile.php">Profile </a></li>
                    <li role="presentation"><a href="help.php">Help </a></li>
                    <li role="presentation"><a href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <form method="post" enctype="multipart/form-data">
                <h2 class="text-center"><strong>Create an account</strong></h2>
                <div class="form-group">
                    <input class="form-control maxlength20" type="text" name="fullname" placeholder="Fullname">
                </div>
                <div class="form-group">
                    <input class="form-control .maxlength20" type="text" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input class="form-control .maxlength30" type="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="dob">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)">
                </div>
                <div class="form-group">
                    <input class="form-control" type="file" name="displaypicture">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">register</button>
                </div>
            </form>
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
    <script src="assets/js/uploadform.js"></script>
</body>

</html>