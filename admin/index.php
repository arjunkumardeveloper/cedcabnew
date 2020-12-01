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

require '../DbConnection.php';
require '../User.php';
require '../Ride.php';
require '../Location.php';
require 'header.php';

$User = new User();
$Ride = new Ride();
$Location = new Location();
$Dbconn = new DbConnection();

$tuser = $User->findTotalUser($Dbconn->conn);
$approuser = $User->findTotalApprovedUser($Dbconn->conn);
$pendinguser = $User->findTotalPendingUser($Dbconn->conn);

$tride = $Ride->findTotalRide($Dbconn->conn);
$completed = $Ride->findCompleted($Dbconn->conn);
$pendingride = $Ride->findPendingRide($Dbconn->conn);
$cancleride = $Ride->findCancleRide($Dbconn->conn);
$totalEarning = $Ride->totalEarning($Dbconn->conn);

$tlocation = $Location->findTotalLocation($Dbconn->conn);


?>

<section>
    <div class="wrapper">
        <div class="mainDiv">
            <div class="box1">
                <h4><?php echo $tuser[0]; ?></h4>
                <p>Total User</p>
                <div class="link"><a href="registerUser.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box1">
                <h4><?php echo $approuser[0]; ?></h4>
                <p>Approved User</p>
                <div class="link"><a href="approvedUser.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box1">
                <h4><?php echo $pendinguser[0]; ?></h4>
                <p>Pending User</p>
                <div class="link"><a href="pendingUser.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
        </div>
        <div class="mainDiv">
            <div class="box1">
                <h4><?php echo $tride[0]; ?></h4>
                <p>Total Rides</p>
                <div class="link"><a href="allRide.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box1">
                <h4><?php echo $completed[0]; ?></h4>
                <p>Completed Ride</p>
                <div class="link"><a href="completeRide.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box1">
                <h4><?php echo $pendingride[0]; ?></h4>
                <p>Pending Rides</p>
                <div class="link"><a href="pendingRide.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
        </div>
        <div class="mainDiv">
            <div class="box1">
                <h4><?php echo $tlocation[0]; ?></h4>
                <p>Total Location</p>
                <div class="link"><a href="locationList.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box1">
                <h4><?php echo $cancleride[0]; ?></h4>
                <p>Cancelled Rides</p>
                <div class="link"><a href="cancleRide.php">More info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
            <div class="box1">
                <h4><?php echo "Rs. " . $totalEarning[0] . "/-"; ?></h4>
                <p>Total Earinings</p>
                <div class="link"><a href="">more info
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a></div>
            </div>
        </div>
        <!-- <div class="mainDiv">
            <div class="box1">
                The quick brown jumps over the layz dog.
            </div>
            <div class="box1">
                The quick brown jumps over the layz dog.
            </div>
            <div class="box1">
                The quick brown jumps over the layz dog.
            </div>
        </div> -->
    </div>
</section>



<?php
    require 'footer.php';
?>