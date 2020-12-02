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
?>
<section>
    <div class="wrapper">
        <h3>Cancelled Rides</h3>
        <p><?php echo $msg; ?></p>
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
                    <th>Customer Id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sr = 1;
            $data = $Ride->fetchCancleRide($Dbconn->conn);
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
                            echo "Pinding";
                        } else if ($row['status'] == 2) {
                            echo "Complete";
                        } else {
                            echo "Cancel";
                        }
                        ?>
                        </td>
                        <td>
                        <?php echo $row['customer_user_id']; ?>
                        </td>
                        <td>
                            <form action="cancleRide.php" method="post">
                                <input type="hidden" name="rideid"
                                value="<?php echo $row['ride_id']; ?>">
                                <input type="submit" value="Delete" name="submit">
                            </form>
                            
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