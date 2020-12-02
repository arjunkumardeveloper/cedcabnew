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
    unset($_SESSION['ride']);
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
                <div class="link"><a href="">Total Expenses Till Now
                <!-- <i class="fa fa-angle-double-right" aria-hidden="true"></i> -->
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
        <?php
        $sr = 1;
        $data = $Ride->fetchLastUserPendingRide($Dbconn->conn);
        if ($data != 0) :
        ?>
        <h3>Your Last Pending Ride</h3>
        <table>
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Ride Date</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance</th>
                <th>Luggage Weight</th>
                <th>Total Fare</th>
                <th>Cab Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($data['ride_date'])); ?></td>
                        <td><?php echo $data['pickup']; ?></td>
                        <td><?php echo $data['droplocation']; ?></td>
                        <td><?php echo $data['total_distance']; ?></td>
                        <td>
                            <?php 
                            if ($data['luggage']) {
                                echo $data['luggage'];
                            } else {
                                echo "--";
                            }
                            ?>
                            </td>
                        <td><?php echo $data['total_fare']; ?></td>
                        <td><?php echo $data['cab']; ?></td>
                        <td>
                        <?php
                        if ($data['status'] == 1) {
                            ?>
                            <marquee behavior="10" direction="" style="color: red;">Pending..</marquee>
                            <?php
                        } else if ($data['status'] == 2) {
                            echo "Approved";
                        } else {
                            echo "Cancle";
                        }
                        ?>
                        </td>
                    </tr>

            </tbody>
        </table>
                    <?php endif; ?>

        <!-- <h3>Your Last Completed Ride</h3>
        <table>
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Ride Date</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance</th>
                <th>Luggage Weight</th>
                <th>Total Fare</th>
                <th>Cab Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody> -->
            <?php
            //$sr = 1;
            //$data = $Ride->fetchLastUserCompletedRide($Dbconn->conn)
                ?>
                    

            </tbody>
        </table>
    </div>
</section>

<?php
    require 'footer.php';
?>