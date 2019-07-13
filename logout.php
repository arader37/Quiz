<?php
/* Log out process, unsets and destroys session variables */
// echo "session_status(): " . session_status();
$session_existed = false;
if (session_status() == 2) {
  // session_status() value of 2 means a session is active
  $session_existed = true;
  session_unset();
  session_destroy();
}

// TODO: by including the header.php file, a session is automatically generated each time it's included.
// this means after logging out, the home page still thinks the user is logged in, giving them access to 
// admin functionality. This needs to be fixed later, somehow.
//include('header.php');
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
      if ($session_existed == true){
        echo "<p>You have been logged out!</p>";
      } else{
        echo "<p>Error: You are not logged in!</p>";
      }
    ?>

    <a href="index.php"><button class="button button-block">Home</button></a>
  </div>
</body>
</html>
