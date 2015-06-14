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
$_SESSION['id'] = $uid;
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Game Tracker Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">

    <script src="searches.js"></script> 


  </head>

  <body>
    <div class="container">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CS 290 Final</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="logout.php">Log out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Game Tracker</h1>
        <p>Hello <?php echo $_SESSION['username'] ?>! Browse your collection, or search for games to add below!</p>
      </div>
    </div> <!-- /container -->
      <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Search</h2>
          <p>Search for games here. You don't have to know the exact title to search. **Summary page feature under construction</p>
          <form>
          <input type="text" class="form-control" placeholder="Mario" id="searchTitle">
          <br/>
          <input type="button" class="btn btn-default btn-primary" value="Run Search" onclick="createList()">
          </form>
        </div>
        <div class="col-md-4">
          <h2>Review Collection</h2>
          <p>Pick a game from your collection to review. All games will be listed below. **List will generate with your collection, but review and summary pages are not yet complete.</p>
          <input type="button" class="btn btn-default btn-primary" value="Show my Games" onclick="myList()">
       </div>
        <div class="col-md-4">
          <h2>Add Game to Database</h2>
          <p>If you can't find the game you are looking for add it to the database with this form.</p>
          <input type="text" class="form-control" placeholder="Game Title" id="title">
          <br/>
          <input type="text" class="form-control" placeholder="Release Year" id="year">
          <br/>
          <input type="button" class="btn btn-default btn-primary" value="Add to database" onclick="addGame()">
        </div>
      </div>
      <hr>
      <div id="results"></div>
      <hr>
      <footer>
        <p>&copy; Psyphon zlc, 2015</p>
      </footer>
    </div> <!-- /container -->