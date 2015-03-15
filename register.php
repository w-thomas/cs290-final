<?php
ini_set('display_errors', 'On');
session_start();
if(!empty($_SESSION['username']))
{
header('Location: home.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>CS 290 Final</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css">

    <link href="css/signin.css" rel="stylesheet">

	<script type="text/javascript">

	function login() {
		var username = document.getElementById('name').value;
		var password = document.getElementById('pass').value;
		var vars = 'username='+username+'&password='+password;
		var url = "creation.php";
		console.log(vars);
	    var req = new XMLHttpRequest();
	    if (!req) {
	    throw 'Unable to create HttpRequest.';
	    }

	    req.onreadystatechange = function() {
	        if (this.readyState === 4 && req.status === 200) {
	        	var return_data = JSON.parse(req.responseText);
	        	console.log(return_data);
	        	console.log(return_data.username);
	        	if(return_data.success)
	        	{
	        		location.href=return_data.redirect;
	        	} else {
	        	document.getElementById("status").innerHTML = return_data.message;
	        	}
	        }
	    };
	    req.open('POST', url, true);
	 	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    req.send(vars);
	    document.getElementById("status").innerHTML = "processing...";
	};

	</script>
</head>
<body>
<div class="jumbotron">
	<h1 class="text-center">Game Tracker Sign-up</h1>
	<p class="text-center">You are seconds away from tracking your game collection!</p>
</div>
<div class="container">
	<form class="form-signin">
		<h2 class="form-signin-heading">Register</h2>
	    <!-- <label for="name" class="sr-only">username</label> -->
	    <input type="text" id="name" class="form-control" placeholder="Username" autofocus>
	    <!-- <label for="pass" class="sr-only">Password</label> -->
	    <input type="text" id="pass" class="form-control" placeholder="Password">
	    <br/>
	    <input type="button" class="btn btn-lg btn-primary btn-block" value="Register" onclick="login()"/>
	    <!-- <button class="btn btn-lg btn-primary btn-block" onclick="login()">Sign in</button> -->
    </form>
</div>
<div class="text-center" id="status"></div>

</body>
</html>