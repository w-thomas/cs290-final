<?php 
session_start();
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "thomasw-db", "s824hShW4EKidis5", "thomasw-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0) {

	if(!($stmt = $mysqli->prepare("INSERT INTO userData(username, password) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ss",$_POST['username'], $_POST['password']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	}

	$_SESSION['username'] = $_POST['username'];
	$data['success'] = true;
	$data['username'] = $_POST['username'];
	$data['redirect'] = 'http://web.engr.oregonstate.edu/~thomasw/cs290/final/home.php';

} else {
	$data['success'] = false;
	$data['message'] =  'Invalid input! Please enter a username and password';
}

echo json_encode($data);

?>