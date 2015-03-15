<?php 
session_start();
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "thomasw-db", "s824hShW4EKidis5", "thomasw-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(isset($_POST['username']) && isset($_POST['password'])) {

}


echo 'Thank you '. $_POST['username'] . '. Your pass is ' . $_POST['password'] . ', says the PHP file';
?>