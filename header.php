<?php

session_start();
if(!isset($page_title)) { $page_title = 'Training'; }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo htmlspecialchars($page_title);?></title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/publishersdb.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
</head>
<body onload="displayAdminFields('admin1')">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            
            <li class="nav-item active"><a class="nav-link" href="index.html">Home<span class="sr-only">(current)</span></a></li>
            <li class="nav-item active"><a class="nav-link" href="about.html">About<span class="sr-only">(current)</span></a></li>
            <li class="nav-item active"><a class="nav-link" href="help.html">Help<span class="sr-only">(current)</span></a></li>
            <li class="nav-item active"><a class="nav-link" href="questions_list.php">Question List<span class="sr-only">(current)</span></a></li>
            
            <!-- Login / Logout Nav menu item
               Checks if there is a valid session and if so displays "logout"
               If there isn's a valid session display login. -->

            <!-- End Login / Logout Nav menu item -->
        </ul>
        <!--<form class="form-inline my-2 my-lg-0" action="index.php" method="POST">
            <input class="form-control mr-sm-2" type="search" type="text" name="search" placeholder="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="submit-search">Search</button>
        </form>-->
        <ul class="navbar-nav mr-right">
            <li class="nav-item">
                
            </li>
        </ul>
    </div>
</nav>
