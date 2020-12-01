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

//  session_start();
 require '../DbConnection.php';
 require 'header.php';
 require '../Ride.php';

 $Ride = new Ride();
 $Dbconn = new DbConnection();

 
$msg = '';
if (isset($_POST['submit'])) {
    $rideid = $_POST['rideid'];
    // echo $rideid;
    $msg = $Ride->deleteRide($rideid, $Dbconn->conn);
}

if (isset($_POST['pending'])) {
    $rideid = $_POST['rideid'];
    // echo $rideid;
    $msg = $Ride->approvedRide($rideid, $Dbconn->conn);
}

if (isset($_POST['cancle'])) {
    $rideid = $_POST['rideid'];

    $msg = $Ride->cancleRide($rideid, $Dbconn->conn);
}
?>
<section>
    <div class="wrapper">
        <h3>All Rides</h3>
        <label for="">Sort</label>
        <select id="allRideSort">
            <option value="">---Select---</option>
            <option value="ride_date">By Ride Date</option>
            <option value="total_fare">By Fare</option>
        </select>
        <label for="">Filter</label>
        <select id="allRideFilter">
            <option value="">---Select---</option>
            <option value="week">Last Week</option>
            <option value="month">Last Month</option>
            <option value="cedmicro">cedmicro</option>
            <option value="cedmini">cedmini</option>
            <option value="cedroyal">cedroyal</option>
            <option value="cedsuv">cedsuv</option>   
        </select>
        <div id="allRideResult"></div>
        <p><?php echo $msg; ?></p>
    <table id="addRideTable">
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
                    <th>Customer Id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sr = 1;
            $data = $Ride->fetchRide($Dbconn->conn);
            foreach ($data as $row) {
                ?>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo $row['ride_date']; ?></td>
                        <td><?php echo $row['pickup']; ?></td>
                        <td><?php echo $row['droplocation']; ?></td>
                        <td><?php echo $row['total_distance']; ?></td>
                        <td>
                            <?php 
                            if ($row['luggage']) {
                                echo $row['luggage'];
                            } else {
                                echo "--";
                            }
                            ?>
                            </td>
                        <td><?php echo $row['total_fare']; ?></td>
                        <td><?php echo $row['cab']; ?></td>
                        <td>
                        <?php
                        if ($row['status'] == 1) {
                            ?>
                            <form action="allRide.php" method="post" class="cancleRide">
                                <input type="hidden" name="rideid" 
                                value="<?php echo $row['ride_id']; ?>">
                                <input type="submit" value="Pending" name="pending">
                            </form>
                            <form action="allRide.php" method="post" class="cancleRide">
                                <input type="hidden" name="rideid" 
                                value="<?php echo $row['ride_id']; ?>">
                                <input type="submit" value="Cancle" name="cancle">
                            </form>
                            <?php
                        } else if ($row['status'] == 2) {
                            echo "Approved";
                        } else {
                            echo "Cancle";
                        }
                        ?>
                        </td>
                        <td>
                        <?php echo $row['customer_user_id']; ?>
                        </td>
                        <td>
                            <form action="allRide.php" method="post"  style="display: inline;">
                                <input type="hidden" name="rideid"
                                value="<?php echo $row['ride_id']; ?>">
                                <input type="submit" value="Delete" name="submit">
                            </form>    
                            <a href="invoice.php?id=<?php echo $row['ride_id'] ?>">Invoice</a>
                        </td>
                    </tr>

                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</section>



<?php
    require 'footer.php';
?>