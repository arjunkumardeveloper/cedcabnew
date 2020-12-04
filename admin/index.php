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

if (isset($_POST['pending'])) {
    $rideid = $_POST['rideid'];
    // echo $rideid;
    $msg = $Ride->approvedRide($rideid, $Dbconn->conn);
    // header('location:index.php');
}

if (isset($_POST['cancle'])) {
    $rideid = $_POST['rideid'];

    $msg = $Ride->cancleRide($rideid, $Dbconn->conn);
    // header('location:index.php');
}

$sr = 1;
$data = $Ride->fetchLastPendingRide($Dbconn->conn);
?>

<section>
    <div class="wrapper">
        <?php
        if ($data != 0) {
        
        ?>
        <table>
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Ride Date</th>
                <th>PickUp Location</th>
                <th>Drop Location</th>
                <th>Total Distance(in km)</th>
                <th>Luggage Weight(in kg)</th>
                <th>Total Fare(Rs.)</th>
                <th>Cab Type</th>
                <th>Status</th>
                <th>Action</th>
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
                        <td id="animate">
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
                        <td>
                        <?php
                        if ($data['status'] == 1) {
                            ?>
                            <form action="index.php" method="post">
                                <input type="hidden" name="rideid" 
                                value="<?php echo $data['ride_id']; ?>">
                                <input type="submit" value="Approve" name="pending" onclick="return conapprove()">
                            </form>
                            <form action="index.php" method="post" class="cancleRide">
                                <input type="hidden" name="rideid" 
                                value="<?php echo $data['ride_id']; ?>">
                                <input type="submit" value="Cancel" name="cancle" onclick="return concancle()">
                            </form>
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
        <?php   }   ?>
        <div class="mainDiv">
            <div class="box1">
                <h4><?php echo $pendingride[0]; ?></h4>
                <p>Pending Rides</p>
                <div class="link"><a href="pendingRide.php">More info
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
                <h4><?php echo $tuser[0]; ?></h4>
                <p>Total User</p>
                <div class="link"><a href="registerUser.php">More info
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
                <p>Total Earning</p>
                <div class="link"><a href="">Lorem ipsum dolor sit amet.
                <!-- <i class="fa fa-angle-double-right" aria-hidden="true"></i> -->
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