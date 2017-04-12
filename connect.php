<?php

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

 
// Check connection
if(mysqli_connect_errno()){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>