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

if(!($stmt = $mysqli->prepare("SELECT g.id, g.title, g.release_year FROM game g INNER JOIN collection c ON g.id = c.gid INNER JOIN userData u ON c.uid = u.id WHERE u.id = ? ORDER BY title"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_SESSION['id']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	if($mysqli->connect_errno == 1062) {
		echo "Game is already in your library!";
	} else {
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
}
if(!$stmt->bind_result($id, $name, $date)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

echo "<table class='table table-striped'>
	<tr>
		<th>Title</th>
		<th>Release Year</th>
		<th>Summary</th>
		<th>Add to Library</th>
	</tr>";

while($stmt->fetch()){
	echo "<tr>";
	echo "<td>" . $name . "</td>";
	echo "<td>" . $date . "</td>";
	echo "<td><input type='button' class='btn btn-default' value='View Summary' onclick='gameSummary(" . $id . ")'/></td>";
	echo "<td><input type='button' class='btn btn-default' value='Review' onclick='addReview(" . $id . ")'/></td>";
	echo "</tr>";
}
echo "</table>";