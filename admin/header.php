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


if (($_SESSION['is_admin'] == 0)) {
    header('location: ../member/index.php');
}
// echo $_SESSION['is_admin'];

// $filename = basename('index.php', 'pendingUser.php', 'approvedUser.php', 'registerUser.php', 'allRide.php', 'pendingRide.php', 'completeRide.php', 'cancleRide.php', 'addLocation.php', 'locationList.php', 'changePassword.php');
$filename = basename($_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <title>Document</title>
    <style>
        .current {
            color: yellowgreen;
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <div class="heading"><a class="navbar-brand" href="index.php">CED <span class="brandspan">CAB</span></a><span class="sessname">Hi, <?php echo $_SESSION['name']; ?></span></div>
        <div class="sidebar">
            <ul>
                <a href="index.php">
                    <li>
    <i class="fa fa-th-large <?php if ($filename == 'index.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                        Dashboard
                    </li>
                </a>
                <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Users
                        <ul>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'pendingUser.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="pendingUser.php">Pending user request</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'approvedUser.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="approvedUser.php">Approved User Request</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'registerUser.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="registerUser.php">All User</a>
                            </li>
                        </ul>
                    </li>
                </a>
                <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Rides
                        <ul>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'allRide.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="allRide.php">All Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'pendingRide.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="pendingRide.php">Pending Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'completeRide.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="completeRide.php">Completed Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'cancleRide.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="cancleRide.php">Cancelled Rides</a>
                            </li>
                        </ul>
                    </li>
                </a>
                <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Location
                        <ul>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'addLocation.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="addLocation.php">Add New Location</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow <?php if ($filename == 'locationList.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="locationList.php">Location List</a>
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
                            <i class="fa fa-location-arrow <?php if ($filename == 'changePassword.php') : ?> current <?php endif; ?>" aria-hidden="true"></i>
                            <a href="changePassword.php">Change Password</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </a>
            </ul>
        </div>
    </div>
