<?php
	require 'init.php';
	require_once 'pregister.php';
	
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    
    <div id="registercontent">
		<form method="post" id="registerform" enctype="multipart/form-data" data-parsley-validate="">
			<h2 class="text-center"><strong>Create an account</strong></h2>
			<div class="form-group">
				<input class="form-control" id="rfullname" type="text" name="fullname" placeholder="Fullname" data-parsley-minlength="8" required />
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="username" placeholder="Username" required data-parsley-minlength="4" />
			</div>
			<div class="form-group">
				<input class="form-control" type="email" name="email" placeholder="Email" required />
			</div>
			<div class="form-group">
				<input class="form-control" type="date" name="dob" placeholder="Date of Birth" required />
			</div>
			<div class="form-group">
				<input class="form-control" type="password" id="password" name="password" placeholder="Password" data-parsley-minlength="6" required />
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)" data-parsley-equalto="#password" required />
			</div>
			<div class="form-group">
				<input class="form-control" type="file" name="displaypicture" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit" name="registerbutton">register</button>
			</div>
		</form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/validations.js"></script>
    <script src="assets/js/uploadform.js"></script>
</body>

</html>