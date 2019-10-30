<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('./includes/config.inc.php');
	require(MYSQL);
	//require('./includes/login.inc.php;');
	$dbh = connect();
	$loginData =  array();
	$errors = array();
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$loginData['email'] =  $_POST['email'];
	} else {
		$errors['email'] = 'Please enter a valid email address!';
	}
	if (filter_var($_POST['pass'])) {
		$loginData['password'] =  sha1(($_POST['pass'])); //i used sha1 encryption for the password
		//if you want to enter the psd to the database try to sha1('passphrase ') first
	} else {
		$errors['password'] = 'Please enter a valid password!';
	}
	if (empty($errors)) {
		login($dbh, $loginData);
	} else {
		echo <<< _REPLY
			<p style="background-color:light-red; color:white; font-weight:bolder;"> either the password or the email could not match those on file </p>
			<p>please enter correct data <a href='login.php> here</a>
		_REPLY;
	}
} else {
	echo <<< _HTML
		<!DOCTYPE html>
	<html>

	<head>
		<title>SISTERS HANGOUT | LOGIN</title>
		<style>
			body {
				margin: 0;
				padding: 0;
				background: wheat;
				font-family: Arial, Helvetica, sans-serif;
			}

			.LogInbox {
				width: 320px;
				height: 450px;
				background: #4c6ca0;
				color: #ffff;
				top: 50%;
				left: 50%;
				position: absolute;
				transform: translate(-50%, -50%);
				box-sizing: border-box;
				padding: 20px 30px;
			}

			.avarta {
				width: 70px;
				height: 70px;
				border-radius: 50%;
				top: 10px;
				margin-left: auto;
				margin-right: auto;
				position: relative;
			}

			h1 {
				margin: 0;
				padding: 0 0 20px;
				text-align: center;
				font-size: 22px;
			}

			.LogInbox p {
				margin: 0;
				padding: 0;
				font-weight: bold;
			}

			.LogInbox input {
				width: 100%;
				margin-bottom: 20px;
				border-radius: 15px;
			}

			.LogInbox input[type="email"],
			input[type="password"] {
				outline: none;
				height: 40px;
				color: #fff;
				font-size: 16px;
				padding: 0.2rem 0.5rem;
			}

			.LogInbox input[type="submit"] {
				border: none;
				outline: none;
				height: 40px;
				background: #fb2525;
				color: #fff;
				font-size: 18px;
				border-radius: 20px;
			}

			form {
				margin-top: 2rem;
			}
		</style>

	<body>
		<div class="LogInbox" style="text-align:center;">
			<img src="./img/logo.png" class="avarta">
			<!-- <h1>Login Here</h1> -->
			<form method="post">
				<p>Email Address</p>
				<input type="email" name="email" placeholder="Enter Email">
				<p>Password</p>
				<input type="password" name="pass" placeholder="Enter Password"> <br />
				<input type="Submit" name="" value="Login"> <br>
				<a href="#"> Lost your password?</a><br>
				<a href="#"> Don't have an account?</a><br>
			</form>
		</div>
	</body>
	</head>

	</html>
_HTML;
}
