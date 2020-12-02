<?php
/**
 * The file doc comment
 * php version 7.2.10
 * 
 * @category Class
 * @package  Package
 * @author   Original Author <author@example.com>
 * @license  https://www.cedcoss.com cedcoss 
 * @link     link
 */
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@700&family=Monoton&family=Sansita+Swashed&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Online Taxi Booking</title>
  </head>
  <body>
    <section>
        <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="index.php">CED <span class="brandspan">CAB</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <?php
          // echo $_SESSION['is_admin'];
        if (isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 0)) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="member/index.php">Dashboard</a>
            </li>
            <a class="nav-link" href="member/logout.php">Logout</a>
            <?php
        } else {
            ?>
            <a class="nav-link" href="login.php">Login</a>
            <li class="nav-item">
              <a class="nav-link" href="register.php">SignUp</a>
            </li>
            
            <?php
        }
        ?>
      </li>
    </ul>
  </div>
</nav>
        </div>
    </section>