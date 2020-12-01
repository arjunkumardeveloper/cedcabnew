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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
//         $(document).ready(function() {
//     // $('#userItem').hide();
//     $('#userToggle').click(function() {
//         // console.log('click');
//         // alert('click');
        
//         $('#userItem').toggle();
//     });
// });
    </script>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div class="heading">Hi, <?php echo $_SESSION['name']; ?></div>
        <div class="sidebar">
            <ul>
                <a href="index.php">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Dashboard
                    </li>
                </a>
                <a href="">
                    <li>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        Users
                        <ul>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="pendingUser.php">Pending user request</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="approvedUser.php">Approved User Request</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
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
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="allRide.php">All Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="pendingRide.php">Pending Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="completeRide.php">Completed Rides</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="cancleRide.php">Canceled Rides</a>
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
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <a href="addLocation.php">Add New Location</a>
                            </li>
                            <li>
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
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
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
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
