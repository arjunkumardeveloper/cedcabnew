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

class User
{
    public $user_id;
    public $user_name;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $isblock;
    public $password;
    public $is_admin;
    public $conn;

    /**
     * Function for registration
     * 
     * @param user_name    $user_name    comment
     * @param name         $name         comment
     * @param dateofsignup $dateofsignup comment
     * @param mobile       $mobile       comment
     * @param password     $password     comment
     * @param conn         $conn         comment
     * 
     * @return registration()
     */
    function registration($user_name, $name, $dateofsignup, $mobile, $password, $conn)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_name` LIKE '$user_name'";
        $query = $conn->query($sql);
        
        if ($query->num_rows > 0) {
            $msg = "<p class='text-danger'>Username Already Exists</p>";
            return $msg;
        } else {

            
            $sql = "INSERT INTO `tbl_user` (`user_name`, `name`, `dateofsignup`, `mobile`, `password`) VALUES ('$user_name', '$name', '$dateofsignup', '$mobile', '$password' ) ";
            if ($conn->query($sql)) {
                $msg = "<p class='text-success'>Registration Successfully</p>";
            } else {
                $msg = "Registration Faild...try again";
            }
            return $msg;
        }
    }



    /**
     * Function for user login
     * 
     * @param user_name $user_name comment
     * @param password  $password  comment
     * @param conn      $conn      comment
     * 
     * @return login()
     */
    function login($user_name, $password, $conn) 
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_name` = '$user_name'
        AND `password` = '$password' AND `isblock` = 1 ";

        $res = mysqli_query($conn, $sql);
        // $data = mysqli_fetch_assoc($res);
        if (mysqli_num_rows($res) > 0) {
            $data = mysqli_fetch_assoc($res);
            // print_r($data);
            if ($data['is_admin'] == 1) {
                $msg = $data;
            } else {
                $msg = $data;
            }
        } else {
            $msg = "Login Faild !";
        }
        return $msg;
    }

    /**
     * Fetch Registerd User
     * 
     * @param conn $conn comment
     * 
     * @return fetchUser()
     */
    function fetchUser($conn)
    {
        $sql = "SELECT * FROM tbl_user";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch pending user information
     * 
     * @param conn $conn comment 
     * 
     * @return fetchPendingUser()
     */
    function fetchPendingUser($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 0";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for fetch approved user information
     * 
     * @param conn $conn comment
     * 
     * @return approvedUser()
     */
    function approvedUser($conn)
    {
        $row = array();

        $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for change admin password 
     * 
     * @param oldPass    $oldPass    comment
     * @param newPass    $newPass    comment
     * @param conNewPass $conNewPass comment
     * @param conn       $conn       comment
     * 
     * @return changePass()
     */
    function changePass($oldPass, $newPass, $conNewPass, $conn)
    {
        $uid = $_SESSION['userid'];
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$uid' AND `password` = '$oldPass' ";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $sql = "UPDATE `tbl_user` SET `password` = '$newPass' WHERE `user_id` = '$uid' ";
            if (mysqli_query($conn, $sql)) {
                return true;
            }
        } else {
            $msg = "Incorrent Old Password !";
        }
        return $msg;
    }

    /**
     * Function for delete user information
     * 
     * @param user_id $user_id comment
     * @param conn    $conn    comment
     * 
     * @return deleteUser()
     */
    function deleteUser($user_id, $conn)
    {
        $sql = "DELETE FROM `tbl_user` WHERE `user_id` = '$user_id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Delete Successfully !";
        } else {
            $msg = "Faild !";
        }
        return $msg;
    }

    /**
     * Function for approved user record
     * 
     * @param isblock $isblock comment
     * @param user_id $user_id comment
     * @param conn    $conn    comment
     * 
     * @return unblockUser()
     */
    function unblockUser($isblock, $user_id, $conn)
    {
        $sql = "UPDATE `tbl_user` SET `isblock` = 1 WHERE `user_id` = '$user_id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "User Approved for login !";
        } else {
            $msg = "Faild !";
        }
        return $msg;
    }

    /**
     * Fetch User information for update
     * 
     * @param conn $conn comment
     * 
     * @return fetchUser()
     */
    function fetchUserInfo($conn)
    {
        $user_id = $_SESSION['userid'];

        $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1 AND `user_id` = '$user_id' ";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }


    /**
     * Fetch Registerd User for update
     * 
     * @param conn $conn comment
     * 
     * @return fetchUser()
     */
    function fetchUserUpdate($conn)
    {
        $user_id = $_SESSION['userid'];

        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$user_id' ";
        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }

    /**
     * Function for update user information
     * 
     * @param name   $name   comment
     * @param mobile $mobile comment
     * @param conn   $conn   comment
     * 
     * @return updateUserRecord()
     */
    function updateUserRecord($name, $mobile, $conn)
    {
        $user_id = $_SESSION['userid'];

        $sql = "UPDATE `tbl_user` SET `name` = '$name', `mobile` = '$mobile' WHERE `user_id` = '$user_id' ";
        if (mysqli_query($conn, $sql)) {
            $msg = "Your Record Has Been Successfully Updated !";
        }
        return $msg;
    }

    /**
     * Function for fetch total no. of user
     * 
     * @param conn $conn comment
     * 
     * @return findTotalUser()
     */
    function findTotalUser($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_user` ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }


    /**
     * Function for fetch total no. of user
     * 
     * @param conn $conn comment
     * 
     * @return findTotalApprovedUser()
     */
    function findTotalApprovedUser($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_user` WHERE `isblock` = 1 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for fetch total no. of user
     * 
     * @param conn $conn comment
     * 
     * @return findTotalPendingUser()
     */
    function findTotalPendingUser($conn)
    {
        $sql = "SELECT COUNT(*) FROM `tbl_user` WHERE `isblock` = 0 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        return $row;
    }

    /**
     * Function for sort userDetails by admin
     * 
     * @param data $data comment
     * @param conn $conn comment
     * 
     * @return userSortByAdmin()
     */
    function userSortByAdmin($data, $conn)
    {
        $row = array();

        if ($data == 'descuname') {
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1 ORDER BY `user_name` DESC ";
        } else if ($data == 'ascuname') {
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1 ORDER BY `user_name` ASC ";
        } else if ($data == 'descdate') {
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1 ORDER BY `dateofsignup` DESC ";
        } else if ($data == 'ascdate') {
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1 ORDER BY `dateofsignup` ASC ";
        } else {
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = 1";
        }

        $res = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($res)) {
            $row[] = $data;
        }
        return $row;
    }
}



?>