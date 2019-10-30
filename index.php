<?php
require('./includes/config.inc.php');
require(MYSQL);
$reg_errors = array();
$userData = array();
# Include the  mailgun Autoloader
require './vendor/autoload.php';

use Mailgun\Mailgun;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $dbh = connect();

  if (preg_match('/^[A-Z \'.-]{2,40}$/i', $_POST['name'])) {
    $userData['name'] =  $_POST['name'];
  } else {
    $reg_errors['name'] = 'Please enter your full name!';
  }

  if (filter_var($_POST['reminder'], FILTER_VALIDATE_BOOLEAN)) {
    $userData['reminder'] = $_POST['reminder'];
  } else {
    $reg_errors['reminder'] = 'Please indicate if you want us to remind you!';
  }

  if (preg_match('/^[A-Za-z0-9\'.-]{2,30}$/i', $_POST['fellowship'])) {
    $userData['church'] = $_POST['fellowship'];
  } else {
    $reg_errors['church'] = 'Please enter your church/fellowship name!';
  }

  if (filter_var($_POST['membership'])) {
    $userData['attending'] = $_POST['membership'];
  } else {
    $reg_errors['membership'] = 'Please indicate your membership!';
  }
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $userData['email'] =  $_POST['email'];
  } else {
    $reg_errors['email'] = 'Please enter a valid email address!';
  }

  if (filter_var($_POST['phone'])) {
    $userData['phone'] =  $_POST['phone'];
  } else {
    $reg_errors['phone'] = 'Please a valid phone number!';
  }

  if (!empty($_POST['suggestions'])) {
    if (filter_var($_POST['suggestions'])) {
      $userData['suggestion'] = $_POST['suggestions'];
    } else {
      $reg_errors['suggestion'] = 'please enter your suggestions!';
    }
  }


  if (empty($reg_errors)) {
    if ($q = insertAttentdant($dbh, $userData)) {

      echo <<< _RESPONSE
           <h3>Thanks!</h3><p>Thank you for registering!</p>
        _RESPONSE;

      # First, instantiate the SDK with your API credentials
      $mg = Mailgun::create('k3qQRS3PUNwKNNX'); // i used my api key, you can change it to yours

      # Now, compose and send your message.
      # $mg->messages()->send($domain, $params);
      $mg->messages()->send('YOUR_DOMAIN_NAME', [ //you have to register for mailgun and configure your domain
        'from'    => 'adegokeddj236@gmail.com', //your email here
        'to'      => $userData['email'],
        'subject' => 'Thanks for Registering',
        'text'    => 'Thank you for registering for BSF fellowsing!' //you can add more here
      ]);

      exit();
    } else {
      trigger_error('You could not be registered due to a system error. We
                      apologize for any inconvenience.');
    }
  }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" screen and (max-width:768px) href="./css/mobile.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <title>Sister's Hangout | Registration</title>
</head>

<body>
  <div id="Wrapper">
    <div id="container_1">
      <div class="ContentWrap">
        <div class="logo">
          <div class="logo_align">
            <img src="./img/logo.png" alt="logo">
            <h2>Baptist Student Fellowship</h2>
          </div>
          <h2 class="m-heading">University of Ilorin</h2>
          <h3 class="s-heading p-top">Agape center</h3>
        </div>
        <div class="content">
          <h2 class="adj">Presents</h2>
          <div class="P-Content">
            <h1>Sister's Hangout</h1>
            <div class="m-content">
              <h2>THEME: Giortazo (Celebrate!)</h2>
              <h2>VENUE: Anticipate!</h2>
              <h2>DATE: Anticipate!</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="container_2">
      <div class="formWrap">
        <h1>Hello Sister! Kindly fill the form here to register</h1>
        <form method="POST" action='index.php'>
          <div class="alert alert-danger" role="alert">

            <div class="formContent">
              <label for="name">Full name</label>
              <input type="text" name="name" id="name" placeholder="Enter full name (surname first)" required>
            </div>
            <div class="formContent">
              <label for="phonenumber">Phone Number</label>
              <input type="tel" name="phone" id="phonenumber" placeholder="Enter Phone number" required>
            </div>
            <div class="formContent">
              <label for="email">Email Address</label>
              <input type="email" name="email" id="email" placeholder="Enter Email address" autocomplete="on" required>
            </div>
            <div class="formContent">
              <label for="fellowship">Church / Fellowship</label>
              <input type="text" name="fellowship" id="fellowship" placeholder="(E.g BSF)" required>
            </div>
            <div class="formContent">
              <label for="suggestions">Suggestion(s)</label>
              <textarea name="suggestions" id="suggestions" cols="30" rows="5" placeholder="What are your suggestions for the program?"></textarea>
            </div>
            <div class="formAdjust">
              <label for="membership">Will you be attending?</label>
              <div class="formAlign">
                <input type="radio" name="membership" value="Yes" id="membership" checked>Yes
                <input type="radio" name="membership" value="No" id="membership">No
                <input type="radio" name="membership" value="Maybe" id="membership">Maybe
              </div>
            </div>
            <div class="formAdjust">
              <label for="reminder">Do you want us to remind you a week to the event?</label>
              <div class="formAlign">
                <input type="radio" name="reminder" value="yes" id="reminder" required>Yes
                <input type="radio" name="reminder" value="no" id="reminder" required>No
              </div>
            </div>
            <div class="button">
              <input type="submit" name='submit' value="Register me">
            </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>