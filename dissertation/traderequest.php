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
            <h1 class="text-center">Request a Trade</h1>
            <div class="col-md-4 col-sm-6 item">
                <a href="#"><img class="img-responsive" src="assets/img/Image1.jpg"></a>
                <h4 class="itemh3">£50 </h4>
                <h4 class="itemh3">Vans Old Skools</h4>
                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="glyphicon glyphicon-circle-arrow-right"></i></a></div>
            <form
            method="post" id="requestatrade">
                <div class="form-group">
                    <select class="form-control" name="itemtype">
                        <optgroup label="">
                            <option value="jackets">Jackets</option>
                            <option value="tops">Tops</option>
                            <option value="bottoms">Bottoms</option>
                        </optgroup>
                    </select>
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
                <button class="btn btn-default" type="submit">Confirm </button>
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