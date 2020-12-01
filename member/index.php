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

require 'header.php';
require '../Ride.php';
require '../DbConnection.php';

$Dbconn = new DbConnection();
$Ride = new Ride();

if (isset($_SESSION['ride'])) {
    echo "<script>alert('Your Ride Request Send Successfully !')</script>";
}

$totalSpent = $Ride->totalCabSpent($Dbconn->conn);
$pendingRides = $Ride->totalPendingRides($Dbconn->conn);
// print_r($pendingRides);
$allRidesTotal = $Ride->allRidesTotal($Dbconn->conn);

?>
<section>
    <div class="wrapper">
        <div class="mainDiv">
            <div class="box2">
                <?php 
                if ($totalSpent[0] != "") {
                    ?>
                <h4><?php echo "Rs. " . $totalSpent[0] . "/-"; ?></h4>
                <p>Total Spent On Cab</p>
                <div class="link"><a href="">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
                    <?php
                } else {
                    ?>
                <h4><?php echo "Rs. 0 /-"; ?></h4>
                <p>Total Spent On Cab</p>
                <div class="link"><a href="">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
                    <?php
                }
                ?>
            </div>
            <div class="box2">
                <h4><?php echo $pendingRides[0];  ?></h4>
                <p>Pending Rides</p>
                <div class="link"><a href="pendingRides.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box2">
                <h4><?php echo $allRidesTotal[0]; ?></h4>
                <p>All Rides</p>
                <div class="link"><a href="allRides.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
        </div>
    </div>
</section>

<?php
    require 'footer.php';
?>