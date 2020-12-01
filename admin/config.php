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

 global $conn;

 $hostname = "localhost";
 $hostuser = "root";
 $hostpass = "";
 $hostdb = "cedcoss";

 $conn = mysqli_connect($hostname, $hostuser, $hostpass, $hostdb);

if (!$conn) {
    echo "Connection Error: " . mysqli_connect_error();
}
// echo "connection successfully";

?>