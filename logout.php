<?php
include('header.php');
/* Log out process, unsets and destroys session variables */
// echo "session_status(): " . session_status();
$was_logged_in = false;
if (session_status() == 2) {
  // session_status() value of 2 means a session is active
  if (isset($_SESSION['role']) == true) {
    $was_logged_in = true; // session value "role" is set when the user is logged in
  }
  session_unset();
  session_destroy();
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Logged out</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">
    <h1>Thanks for stopping by</h1>
    <?php 
      if ($was_logged_in == true){
        echo "<p>You have been logged out!</p>";
      } else{
        echo "<p>Error: You are not logged in!</p>";
      }
    ?>

    <a href="index.php"><button class="button button-block">Home</button></a>
  </div>
</body>
</html>
