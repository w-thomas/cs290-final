<?php
ini_set('display_errors', 'On');
session_start();
if(empty($_SESSION['username']))
{
header('Location: index.php');
}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "thomasw-db", "s824hShW4EKidis5", "thomasw-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if (!($stmt = $mysqli->prepare("SELECT id FROM userData WHERE username = ?"))) {
   echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
if(!($stmt->bind_param("s", $_SESSION['username']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($user_id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	$uid = $user_id;
}
$stmt->close();

if(!($stmt = $mysqli->prepare("INSERT INTO collection(uid, gid) VALUES (?,?)"))){
echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii",$uid, $_POST['gameid']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	if(!$stmt->errno == 1062) {
		echo "Success!";
	} else {
		echo "Game is already in your library!";
	}
}
	if(!$stmt->errno == 1062) {
		echo "Success!";
	}
$stmt->close();
?>


