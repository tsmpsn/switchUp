<?php
    include 'init.php';
	session_destroy();
	$_SESSION = [];
	header('Location: login.php');
?>