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

class Location
{
    public $id;
    public $name;
    public $distance;
    public $is_available;
    public $conn;
    public $status;

    /**
     * Function for add location
     * 
     * @param name     $name     comment
     * @param distance $distance comment
     * @param conn     $conn     commnet
     * 
     * @return addLocation()
     */
    function addLocation($name, $distance, $conn)
    {
        $sql = "INSERT INTO `tbl_location` (`name`, `distance`) VALUES ('$name', '$distance')";
        if (mysqli_query($conn, $sql)) {
            $msg = "Location Add !";
        } else {
            $msg = "Error";
        }
        return $msg;
    }

    /**
     * Function for fetch locaiton
     * 
     * @param conn $conn comment
     * 
     * @return fetchLocation();
     */
    function fetchLocation($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_location` ORDER BY id DESC";
        // return $sql;
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch available locaiton
     * 
     * @param conn $conn comment
     * 
     * @return fetchLocationAvai();
     */
    function fetchLocationAvai($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_location` WHERE `is_available` = 1 ";
        // return $sql;
        $res = mysqli_query($conn, $sql);
        // while ($data = mysqli_fetch_assoc($res)) {
        //     $row[] = $data;
        // }
        // return $row;
        // $data = mysqli_fetch_assoc($res);
        return $res;
    }

    /**
     * Function for delete location
     * 
     * @param id   $id   comment
     * @param conn $conn comment
     * 
     * @return deleteLocation()
     */
    function deleteLocation($id, $conn)
    {
        $sql = "DELETE FROM `tbl_location` WHERE `id` = '$id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Location Delete Success !";
        } else {
            $msg = "Deletion Faild !";
        }
        return $msg;
    }

    /**
     * Function for stop ride
     * 
     * @param id     $id     comment
     * @param status $status comment
     * @param conn   $conn   comment
     * 
     * @return stopRide()
     */
    function stopRide($id, $status, $conn) 
    {
        $sql = "UPDATE `tbl_location` SET `is_available` = '$status' WHERE `id` = $id ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Ride Stop !";
        }
        return $msg;
    }

    /**
     * Fetch Location for update
     * 
     * @param id   $id   comment
     * @param conn $conn comment
     * 
     * @return fetchLocationUpdate()
     */
    function fetchLocationUpdate($id, $conn)
    {

        $sql = "SELECT * FROM `tbl_location` WHERE `id` = '$id' ";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for update location
     * 
     * @param name     $name     comment
     * @param distance $distance comment
     * @param id       $id       comment
     * @param conn     $conn     comment
     * 
     * @return updateLocation()
     */
    function updateLocation($name, $distance, $id, $conn)
    {
        $sql = "UPDATE `tbl_location` SET `name` = '$name', `distance` = '$distance' WHERE `id` = '$id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Location Successfully Update";
        }
        return $msg;
    }

    /**
     * Function for count total no. of location
     * 
     * @param conn $conn comment
     * 
     * @return findTotalLocation()
     */
    function findTotalLocation($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_location` ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }
}

?>