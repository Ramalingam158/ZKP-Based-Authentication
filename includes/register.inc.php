<?php

include_once "db.inc.php";
$name = mysqli_real_escape_string($conn, $_REQUEST['uname']);
$pPass = mysqli_real_escape_string($conn, $_REQUEST['pass']);
$pass = password_hash($pPass, PASSWORD_DEFAULT);
$query = "SELECT s_no FROM users WHERE uname = '$name'";
$res = mysqli_query($conn, $query);
if(mysqli_num_rows($res) > 0){
	echo "This mail already exists";
} else {
	$query = "INSERT INTO users (uname, pass) VALUES('$name', '$pass')";
	$res = mysqli_query($conn, $query);
	echo "true";
}
