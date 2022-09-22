<?php

include_once "db.inc.php";
$name = mysqli_real_escape_string($conn, $_REQUEST['uname']);
$pass = mysqli_real_escape_string($conn, $_REQUEST['pass']);

$query = "SELECT * FROM users WHERE uname = '$name'";
$res = mysqli_query($conn, $query);
if(mysqli_num_rows($res) == 0){
	echo "false";
} else {
	$row = mysqli_fetch_array($res);
	if (password_verify($pass, $row['pass'])) {
		echo "true";
	} else {
		echo "flase";
	}
}