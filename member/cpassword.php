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
require 'header.php';
require '../DbConnection.php';
require '../Location.php';

$msg = '';
$Location = new Location();
$Dbconn = new DbConnection();

if (isset($_POST['submit'])) {
    $location = $_POST['location'];
    $distance = $_POST['distance'];

    
    $msg = $Location->addLocation($location, $distance, $Dbconn->conn);
}
// print_r($data);
// echo $data;

?>
<section>
    <div class="wrapper">
        <h3>Change Password</h3>
        <p><?php echo $msg; ?></p>
        <div class="container">
            <!-- <form action="addLocation.php" method="post"> -->
                <div class="form-group">
                    <label for="oldPass">Old Password <span>*</span></label>
                    <input type="password" name="oldPass" id="oldPass" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <label for="newPass">New Password <span>*</span></label>
                    <input type="password" name="newPass" id="newPass" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <label for="conNewPass">Confirm New Password <span>*</span></label>
                    <input type="password" name="conNewPass" id="conNewPass" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" value="Change Password" name="submit">
                </div>
            <!-- </form> -->
        </div>
    </div>
</section>



<?php
    require 'footer.php';
?>
