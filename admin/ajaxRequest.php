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
require '../DbConnection.php';
require '../User.php';
require '../Location.php';
require '../Ride.php';

$Dbconn = new DbConnection();
$User = new User();
$Location = new Location();
$Ride = new Ride();

if ($_POST['action'] == 'changePass') {
    // echo "success";
    $oldPass = $_POST['oldpass'];
    $newPass = $_POST['newpass'];
    $conNewPass = $_POST['connewpass'];

    $msg = $User->changePass($oldPass, $newPass, $conNewPass, $Dbconn->conn);
    echo $msg;
}

if ($_POST['action'] == 'fetchForUpdate') {
    $locid = $_POST['locid'];
    $msg = $Location->fetchLocationUpdate($locid, $Dbconn->conn);
    // print_r($msg); 
    // print_r(json_encode($msg));
    echo json_encode($msg);
}

if ($_POST['action'] == 'Update') {
    $name = $_POST['name'];
    $distance = $_POST['distance'];
    $locid = $_POST['locid'];

    $msg = $Location->updateLocation($name, $distance, $locid, $Dbconn->conn);
    echo $msg;

}

if ($_POST['action'] == 'sorting') {
    $sdata = $_POST['sdata'];

    $sortRide = $Ride->sortAllRide($sdata, $Dbconn->conn);
    echo json_encode($sortRide);
}

if ($_POST['action'] == 'allRideFilter') {
    $sdata = $_POST['sdata'];

    $filterAllRide = $Ride->filterAllRide($sdata, $Dbconn->conn);
    echo json_encode($filterAllRide);
}

if ($_POST['action'] == 'pendingRideSort') {
    $sdata = $_POST['sdata'];

    $sortPendingRide = $Ride->sortPendingRideAdmin($sdata, $Dbconn->conn);
    echo json_encode($sortPendingRide);
}

if ($_POST['action'] == 'pendingRideFilter') {
    $sdata = $_POST['sdata'];

    $filterPendingRide = $Ride->filterPendingRideAdmin($sdata, $Dbconn->conn);
    echo json_encode($filterPendingRide);
}

if ($_POST['action'] == 'compeleteRideSort') {
    $sdata = $_POST['sdata'];

    $sortCompleteRide = $Ride->sortCompleteRideAdmin($sdata, $Dbconn->conn);
    echo json_encode($sortCompleteRide);
}

if ($_POST['action'] == 'compeleteRideFilter') {
    $sdata = $_POST['sdata'];

    $filterCompleteRide = $Ride->filterCompleteRideAdmin($sdata, $Dbconn->conn);
    echo json_encode($filterCompleteRide);
}

?>