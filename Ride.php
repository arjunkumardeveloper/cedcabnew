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

// session_start();

/**
 * Template Class Doc Comment
 * 
 * Template Class
 * 
 * @category Template_Class
 * @package  Template_Class
 * @author   Arjun <author@domain.com>
 * @license  https://www.cedcoss.com cedcoss
 * @link     http://localhost/
 */



class Ride
{
    public $ride_id;
    public $ride_date;
    public $pickup;
    public $droplocation;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $status;
    public $customer_user_id;
    public $conn;

    /**
     * Function For Insert Ride
     * 
     * @param ride_date      $ride_date      comment
     * @param pickup         $pickup         comment
     * @param droplocation   $droplocation   comment
     * @param total_distance $total_distance comment
     * @param luggage        $luggage        comment
     * @param total_fare     $total_fare     comment
     * @param cab            $cab            comment
     * @param conn           $conn           comment
     * 
     * @return insertRide()
     */
    function insertRide($ride_date, $pickup, $droplocation, $total_distance, $luggage, $total_fare, $cab, $conn)
    {   
        $uid = $_SESSION['userid'];
        $sql = "INSERT INTO `tbl_ride` (`ride_date`, `pickup`, `droplocation`, `total_distance`, `luggage`, `total_fare`, `cab`, `customer_user_id`) VALUES ('$ride_date', '$pickup', '$droplocation', '$total_distance', '$luggage', '$total_fare', '$cab', '$uid')";
        // return $sql;
        // exit();
        if (mysqli_query($conn, $sql)) {
            return "success";
        } else {
            return "false";
        }
    }

    /**
     * Fetch Ride Information
     * 
     * @param conn $conn comment
     * 
     * @return fetchRide()
     */
    function fetchRide($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_ride` ";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for cancle ride
     * 
     * @param ride_id $ride_id comment
     * @param conn    $conn    comment
     * 
     * @return deleteRide()
     */
    function deleteRide($ride_id, $conn)
    {
        $sql = "DELETE FROM `tbl_ride`  WHERE `ride_id` = '$ride_id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Ride Delete !";
        } else {
            $msg = "Ride Deletion Faild !";
        }
        return $msg;
    }

    /**
     * Function for fetch pending ride
     * 
     * @param conn $conn comment
     * 
     * @return fetchPendingRide()
     */
    function fetchPendingRide($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 1";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for approved ride
     * 
     * @param ride_id $ride_id comment
     * @param conn    $conn    comment
     * 
     * @return approvedRide()
     */
    function approvedRide($ride_id, $conn)
    {
        $sql = "UPDATE `tbl_ride` SET `status` = 2 WHERE `ride_id` = '$ride_id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Ride Approved !";
        } else {
            $msg = "Approved Error !";
        }
        return $msg;
    }

    /**
     * Function For Fetch Approved Ride
     * 
     * @param conn $conn comment
     * 
     * @return fetchCompeleteRide()
     */
    function fetchCompeleteRide($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 2";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch cancle ride information
     * 
     * @param conn $conn comment
     * 
     * @return fetchCancleRide()
     */
    function fetchCancleRide($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 3";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Fetch Ride For User
     * 
     * @param conn $conn comment
     * 
     * @return fetchUserRide()
     */
    function fetchUserRide($conn)
    {
        $row = array();
        $user_id = $_SESSION['userid']; 

        $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' ";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch pending ride for user
     * 
     * @param conn $conn comment
     * 
     * @return fetchPendingRideUser()
     */
    function fetchPendingRideUser($conn)
    {
        $row = array();
        $user_id = $_SESSION['userid']; 

        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 1 AND `customer_user_id` = '$user_id' ";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function For Fetch Approved Ride
     * 
     * @param conn $conn comment
     * 
     * @return fetchCompeleteRide()
     */
    function fetchCompeleteRideUser($conn)
    {
        $row = array();
        $user_id = $_SESSION['userid']; 

        $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 2 AND `customer_user_id` = '$user_id' ";
        // echo $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for approved ride
     * 
     * @param ride_id $ride_id comment
     * @param conn    $conn    comment
     * 
     * @return cancleRide()
     */
    function cancleRide($ride_id, $conn)
    {
        $sql = "UPDATE `tbl_ride` SET `status` = 3 WHERE `ride_id` = '$ride_id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Ride Cancled !";
        } else {
            $msg = "Approved Error !";
        }
        return $msg;
    }

    /**
     * Function for count total no. of ride
     * 
     * @param conn $conn comment
     * 
     * @return findTotalRide()
     */
    function findTotalRide($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_ride` ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for count total no. of ride
     * 
     * @param conn $conn comment
     * 
     * @return findCompleted()
     */
    function findCompleted($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_ride` WHERE `status` = 2 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for count all pending of ride
     * 
     * @param conn $conn comment
     * 
     * @return findPendingRide()
     */
    function findPendingRide($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_ride` WHERE `status` = 1 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for count all Cancle of ride
     * 
     * @param conn $conn comment
     * 
     * @return findCancleRide()
     */
    function findCancleRide($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_ride` WHERE `status` = 3 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for total earning
     * 
     * @param conn $conn comment
     * 
     * @return toalEarning()
     */
    function totalEarning($conn)
    {
        $sql = "SELECT SUM(`total_fare`) FROM `tbl_ride` WHERE `status` = 2 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for sorting ride information
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return fetchSortRide()
     */
    function fetchSortRide($data, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];
        if ($data == 'ride_date') {
            // SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `ride_date` DESC ";
        } else {
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `total_fare` DESC ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for total spent on cab
     * 
     * @param conn $conn comment
     * 
     * @return toalEarning()
     */
    function totalCabSpent($conn)
    {
        $user_id = $_SESSION['userid'];

        $sql = "SELECT SUM(`total_fare`) FROM `tbl_ride` WHERE `status` = 2 AND `customer_user_id` = '$user_id' ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for filter ride month or week wise
     * 
     * @param sdata $sdata comment
     * @param conn  $conn  comment
     * 
     * @return fetchFilterRide()
     */
    function fetchFilterRide($sdata, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];

        if ($sdata == 'week') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 7 DAY) AND `customer_user_id` = '$user_id' ORDER BY `ride_date`";
        } else if ($sdata == 'month') {
            // $sql = "SELECT * FROM `tbl_ride` WHERE MONTH(`ride_date`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH)) AND `customer_user_id` = '$user_id' ";
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 30 DAY) AND `customer_user_id` = '$user_id' ORDER BY `ride_date`";
        } else if ($sdata == 'cedmicro') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmicro' AND `customer_user_id` = '$user_id' ";
        } else if ($sdata == 'cedmini') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmini' AND `customer_user_id` = '$user_id' ";
        } else if ($sdata == 'cedroyal') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedroyal' AND `customer_user_id` = '$user_id' ";
        } else if ($sdata == 'cedsuv') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedsuv' AND `customer_user_id` = '$user_id' ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for filter ride month or week wise
     * 
     * @param sdata $sdata comment
     * @param conn  $conn  comment
     * 
     * @return fetchPendingFilterRide()
     */
    function fetchPendingFilterRide($sdata, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];

        if ($sdata == 'week') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 7 DAY) AND `customer_user_id` = '$user_id' AND `status` = 1 ORDER BY `ride_date`";
        } else if ($sdata == 'month') {
            // $sql = "SELECT * FROM `tbl_ride` WHERE MONTH(`ride_date`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH)) AND `customer_user_id` = '$user_id' AND `status` = 1 ";
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 30 DAY) AND `customer_user_id` = '$user_id' AND `status` = 1 ORDER BY `ride_date`";
        } else if ($sdata == 'cedmicro') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmicro' AND `customer_user_id` = '$user_id' AND `status` = 1 ";
        } else if ($sdata == 'cedmini') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmini' AND `customer_user_id` = '$user_id' AND `status` = 1 ";
        } else if ($sdata == 'cedroyal') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedroyal' AND `customer_user_id` = '$user_id' AND `status` = 1 ";
        } else if ($sdata == 'cedsuv') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedsuv' AND `customer_user_id` = '$user_id' AND `status` = 1 ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for sort pending ride
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return sortPendingRide()
     */
    function sortPendingRide($data, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];
        if ($data == 'ride_date') {
            // SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = 1 ORDER BY `ride_date` DESC ";
        } else {
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = 1 ORDER BY `total_fare` DESC ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for sort pending ride
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return sortPendingRide()
     */
    function sortCompleteRide($data, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];
        if ($data == 'ride_date') {
            // SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = 2 ORDER BY `ride_date` DESC ";
        } else {
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = 2 ORDER BY `total_fare` DESC ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch complete ride filter
     * 
     * @param sdata $sdata comment
     * @param conn  $conn  comment
     * 
     * @return fetchCompleteFilterRide()
     */
    function fetchCompleteFilterRide($sdata, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];

        if ($sdata == 'week') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 7 DAY) AND `customer_user_id` = '$user_id' AND `status` = 2 ORDER BY `ride_date`";
        } else if ($sdata == 'month') {
            // $sql = "SELECT * FROM `tbl_ride` WHERE MONTH(`ride_date`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH)) AND `customer_user_id` = '$user_id' AND `status` = 2 ";
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 30 DAY) AND `customer_user_id` = '$user_id' AND `status` = 2 ORDER BY `ride_date`";
        }  else if ($sdata == 'cedmicro') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmicro' AND `customer_user_id` = '$user_id' AND `status` = 2 ";
        } else if ($sdata == 'cedmini') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmini' AND `customer_user_id` = '$user_id' AND `status` = 2 ";
        } else if ($sdata == 'cedroyal') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedroyal' AND `customer_user_id` = '$user_id' AND `status` = 2 ";
        } else if ($sdata == 'cedsuv') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedsuv' AND `customer_user_id` = '$user_id' AND `status` = 2 ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }


    /**
     * Function for sort all ride in admin panel
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return sortAllRide()
     */
    function sortAllRide($data, $conn)
    {
        $row = array();
        $user_id = $_SESSION['userid'];
        if ($data == 'ride_date') {
            // SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC
            $sql = "SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC ";
        } else {
            $sql = "SELECT * FROM `tbl_ride` ORDER BY `total_fare` DESC ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fiter ride in admin
     * 
     * @param sdata $sdata comment
     * @param conn  $conn  comment
     * 
     * @return filterAllRide()
     */
    function filterAllRide($sdata, $conn)
    {
        $row = array();

        if ($sdata == 'week') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY `ride_date`";
        } else if ($sdata == 'month') {
            // $sql = "SELECT * FROM `tbl_ride` WHERE MONTH(`ride_date`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH))";
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY `ride_date`";
        } else if ($sdata == 'cedmicro') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmicro' ";
        } else if ($sdata == 'cedmini') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmini' ";
        } else if ($sdata == 'cedroyal') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedroyal' ";
        } else if ($sdata == 'cedsuv') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedsuv' ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch all pendits rides for users
     * 
     * @param conn $conn comment
     * 
     * @return totalPendingRides()
     */
    function totalPendingRides($conn)
    {
        $user_id = $_SESSION['userid'];

        $sql = "SELECT COUNT(*) FROM `tbl_ride` WHERE `status` = 1 AND `customer_user_id` = '$user_id' ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for fetch all rides for user
     * 
     * @param conn $conn comment
     * 
     * @return allRidesTotal()
     */
    function allRidesTotal($conn)
    {
        $user_id = $_SESSION['userid'];

        $sql = "SELECT COUNT(*) FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for sort pending ride for admin
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return sortPendingRide()
     */
    function sortPendingRideAdmin($data, $conn)
    {   
        $row = array();
        if ($data == 'ride_date') {
            // SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 1 ORDER BY `ride_date` DESC ";
        } else {
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 1 ORDER BY `total_fare` DESC ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for filter pending ride for admin
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return filterPendingRideAdmin()
     */
    function filterPendingRideAdmin($data, $conn)
    {
        $row = array();

        if ($data == 'week') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 7 DAY) AND `status` = 1 ORDER BY `ride_date`";
        } else if ($data == 'month') {
            // $sql = "SELECT * FROM `tbl_ride` WHERE MONTH(`ride_date`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH))";
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 30 DAY)  AND `status` = 1 ORDER BY `ride_date`";
        } else if ($data == 'cedmicro') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmicro' AND `status` = 1 ";
        } else if ($data == 'cedmini') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmini' AND `status` = 1 ";
        } else if ($data == 'cedroyal') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedroyal' AND `status` = 1 ";
        } else if ($data == 'cedsuv') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedsuv' AND `status` = 1 ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Functionf or sort completed ride by admin
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return sortCompleteRideAdmin()
     */
    function sortCompleteRideAdmin($data, $conn)
    {
        $row = array();
        if ($data == 'ride_date') {
            // SELECT * FROM `tbl_ride` ORDER BY `ride_date` DESC
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 2 ORDER BY `ride_date` DESC ";
        } else {
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` = 2 ORDER BY `total_fare` DESC ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }


    /**
     * Functionf or sort completed ride by admin
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return sortCompleteRideAdmin()
     */
    function filterCompleteRideAdmin($data, $conn)
    {
        $row = array();

        if ($data == 'week') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 7 DAY) AND `status` = 2 ORDER BY `ride_date`";
        } else if ($data == 'month') {
            // $sql = "SELECT * FROM `tbl_ride` WHERE MONTH(`ride_date`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH))";
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_date` > DATE_SUB(NOW(), INTERVAL 30 DAY)  AND `status` = 2 ORDER BY `ride_date`";
        } else if ($data == 'cedmicro') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmicro' AND `status` = 2 ";
        } else if ($data == 'cedmini') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedmini' AND `status` = 2 ";
        } else if ($data == 'cedroyal') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedroyal' AND `status` = 2 ";
        } else if ($data == 'cedsuv') {
            $sql = "SELECT * FROM `tbl_ride` WHERE `cab` = 'cedsuv' AND `status` = 2 ";
        }
        // return $sql;
        // exit();
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Fetch invoice
     * 
     * @param id   $id   comment
     * @param conn $conn comment
     * 
     * @return fetchInvoice()
     */
    function fetchInvoice($id, $conn)
    {
        $sql = "SELECT * FROM `tbl_ride` WHERE `ride_id` = '$id' ";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);
        return $data;
    }
}
?>