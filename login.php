<?php 
ini_set('display_errors', 'On');
session_start();
if(!empty($_SESSION['username']))
{
header('Location: home.php');
}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "thomasw-db", "s824hShW4EKidis5", "thomasw-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(isset($_POST['username']) && isset($_POST['password'])) {
	$count = 0;
	if(!($stmt = $mysqli->prepare("SELECT username, password FROM userData WHERE username = ? AND password = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ss",$_POST['username'], $_POST['password']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($name, $pass)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		$count += 1;
	}

	if($count == 1) {
		$_SESSION['username'] = $_POST['username'];
		$data['success'] = true;
		$data['redirect'] = 'http://web.engr.oregonstate.edu/~thomasw/cs290/final/home.php';
	} else {
		$data['success'] = false;
		$data['message'] =  'Username or Password not found, try again.';
	}

	echo json_encode($data);
}

