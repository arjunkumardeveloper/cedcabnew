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
        <h3>Add Location</h3>
        <p><?php echo $msg; ?></p>
        <div class="container">
            <form action="addLocation.php" method="post">
                <div class="form-group">
                    <label for="location">Add Location</label>
                    <input type="text" name="location" id="location" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <label for="distance">Add Distance</label>
                    <input type="text" name="distance" id="distance" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Location" name="submit">
                </div>
            </form>
        </div>
    </div>
</section>



<?php
    require 'footer.php';
?>
