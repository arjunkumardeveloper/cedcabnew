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

if ($_SESSION['name'] == "") {
    header('location: ../index.php');
}


if (($_SESSION['is_admin'] == 1)) {
    header('location: ../admin/index.php');
}

// echo $_SESSION['is_admin'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div class="heading"><a class="navbar-brand" href="#">CED <span class="brandspan">CAB</span></a><span class="sessname">Hi, <?php echo $_SESSION['name']; ?></span></div>
        <div class="sidebar">
            <ul>
                <a href="index.php">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Dashboard
                    </li>
                </a>
                <a href="../index.php">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Book New Ride
                    </li>
                </a>
                <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Rides
                        <ul>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="pendingRides.php">Pending Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="completeRides.php">Completed Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="allRides.php">All Rides</a>
                            </li>
                        </ul>
                    </li>
                </a>
                <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Account
                        <ul>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="updateInfo.php">Update information</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="cpassword.php">Change Password</a>
                            </li>
                        </ul>
                    </li>
                </a>
                <!-- <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        View Location
                    </li>
                </a> -->
                <a href="logout.php">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Logout
                    </li>
                </a>
            </ul>
        </div>
    </div>
