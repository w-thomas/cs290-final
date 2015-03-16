<?php
ini_set('display_errors', 'On');
session_start();
if(empty($_SESSION['username']))
{
header('Location: index.php');
}

$query = urldecode($_POST['search']);

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "thomasw-db", "s824hShW4EKidis5", "thomasw-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(!($stmt = $mysqli->prepare("SELECT id, title, release_year FROM game WHERE title LIKE CONCAT('%', ?, '%') ORDER BY title"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s", $query))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
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
	echo "<td><input type='button' class='btn btn-default' value='Add to Library' onclick='addLibrary(" . $id . ")'/></td>";
	echo "</tr>";
}
echo "</table>";

?>
