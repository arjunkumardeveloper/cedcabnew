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

require 'config.php';

/**
 * Fetch User Information
 * 
 * @return fetchUser()
 */
function fetchUser() 
{
    global $conn;
    $row = array();

    $sql = "SELECT * FROM tbl_user";
    $res = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($res)) {
        $row[] = $data;
    }
    return $row;
}

?>
