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
            <form action="addLocation.php" method="post" >
                <div class="form-group">
                    <label for="location">Add Location</label>
                    <input type="text" name="location" id="location" 
                    class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="distance">Add Distance (in km)</label>
                    <input type="text" name="distance" id="distance" 
                    class="form-control" onkeypress="return checkNum()" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Location" name="submit" onclick="return validate()">
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function checkNum() {
        if ((event.keyCode > 47) && (event.keyCode < 58)) {
            return true;
        } else {
            alert("Please enter numeric value only !");
            return false;
        }   
    }
    function checkChar() {
        if ((event.keyCode > 64) && (event.keyCode < 123)) {
            return true;
        } else {
            alert("Please enter alphabet value only !");
            return false;
        }
    }

    function validate() {  
        $letter = /^[a-zA-Z0-9_]+$/;
        var num=document.getElementById("location").value;  
        if (!isNaN(num)) {    
            alert("Location name can't be only numeric value !");
            document.getElementById("location").focus();
            return false;  
        } else if (!(num.match($letter))) {
            alert("Special character are not allowed !");
            return false;
        } 
        else {  
            return true;  
        }  

    }        
</script>

<?php
    require 'footer.php';
?>
