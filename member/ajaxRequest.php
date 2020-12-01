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
require '../Ride.php';

$Dbconn = new DbConnection();
$User = new User();
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
    $msg = $User->fetchUserUpdate($Dbconn->conn);
    // print_r($msg); 
    // print_r(json_encode($msg));
    echo json_encode($msg);
}

if ($_POST['action'] == 'Update') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    // $id = $_SESSION['userid'];

    $msg = $User->updateUserRecord($name, $mobile, $Dbconn->conn);
    echo $msg;

}


if ($_POST['action'] == 'sorting') {
    // $Ride->fetch
    // echo "success";
    $data = $_POST['sdata'];
    $sortride = $Ride->fetchSortRide($data, $Dbconn->conn);
    // print_r($sortride);
    echo json_encode($sortride);
}


if ($_POST['action'] == 'filter') {
    $sdata = $_POST['sdata'];
    // echo $sdata;
    $filterRide = $Ride->fetchFilterRide($sdata, $Dbconn->conn);
    echo json_encode($filterRide);
}

if ($_POST['action'] == 'pendingFilter') {
    $sdata = $_POST['sdata'];

    $filterPendingRide = $Ride->fetchPendingFilterRide($sdata, $Dbconn->conn);
    echo json_encode($filterPendingRide);
}

if ($_POST['action'] == 'sortPendingRide') {
    $sdata = $_POST['sdata'];
    $sortPendingRide = $Ride->sortPendingRide($sdata, $Dbconn->conn);
    echo json_encode($sortPendingRide);
}

if ($_POST['action'] == 'sortCompleteRide') {
    $sdata = $_POST['sdata'];
    $sortCompleteRide = $Ride->sortCompleteRide($sdata, $Dbconn->conn);
    echo json_encode($sortCompleteRide);
}

if ($_POST['action'] == 'completeFilter') {
    $sdata = $_POST['sdata'];

    $filterCompleteRide = $Ride->fetchCompleteFilterRide($sdata, $Dbconn->conn);
    echo json_encode($filterCompleteRide);
}
?>