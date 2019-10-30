<?php
require('./includes/config.inc.php');
require(MYSQL);
if (isset($_SESSION['user_id'])) {
  $dbh = connect();
  $attendants = getAttendants($dbh);
} else {
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/admin.css">
  <title>Sisters Hangout | ADMIN</title>
</head>

<body>
  <div class="container">
    <h2>List of Attendees</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Full name</th>
            <th>Phone number</th>
            <th>Email Address</th>
            <th>Church / Fellowship</th>
            <th>Attending</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($attendants as $attendant) : ?>
            <tr>
              <td><?php echo $attendant['id']; ?></td>
              <td><?php echo $attendant['full_name']; ?></td>
              <td><?php echo $attendant['phone_num']; ?></td>
              <td><?php echo $attendant['email']; ?></td>
              <td><?php echo $attendant['church']; ?></td>
              <td><?php echo $attendant['attending']; ?></td>
              <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">View full details</button></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">BSF Sister's Hangout</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="formContent">
              <label for="name">Full name</label>
              <input type="text" name="name" id="name" placeholder="Enter full name (surname first)" required>
            </div>
            <div class="formContent">
              <label for="phonenumber">Phone Number</label>
              <input type="text" name="phonenumber" id="phonenumber" placeholder="Enter Phone number" required>
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
              <label for="">YES</label>
            </div>
            <div class="formAdjust">
              <label for="reminder">Do you want us to remind you a week to the event?</label>
              <label for="">YES</label>
            </div>
            <div class="button">
              <input type="submit" value="Remind Now">
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>



</body>

</html>