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

 
?>
<section>
    <div class="wrapper">
        <h3>Compelete Rides</h3>
        <label for="">Sort</label>
        <select id="sortDataCompleteRide">
            <option value="">---Select---</option>
            <option value="descride_date">By Ride Date In DESC Order</option>
            <option value="ascride_date">By Ride Date In ASC Order</option>
            <option value="desctotal_fare">By Fare In DESC Order</option>
            <option value="asctotal_fare">By Fare In ASC Order</option>
        </select>
        <label for="">Filter</label>
        <select id="completeRideFilter">
            <option value="">---Select---</option>
            <option value="week">Last Week</option>
            <option value="month">Last Month</option>
            <option value="cedmicro">cedmicro</option>
            <option value="cedmini">cedmini</option>
            <option value="cedroyal">cedroyal</option>
            <option value="cedsuv">cedsuv</option>
        </select>
        <div id="completeRideResult"></div>
    <table id="completeRideTable">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Ride Date</th>
                    <th>PickUp Location</th>
                    <th>Drop Location</th>
                    <th>Total Distance (in km)</th>
                    <th>Luggage Weight (in kg)</th>
                    <th>Total Fare (Rs)</th>
                    <th>Cab Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sr = 1;
            $data = $Ride->fetchCompeleteRideUser($Dbconn->conn);
            foreach ($data as $row) {
                ?>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($row['ride_date'])); ?></td>
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
                            echo "Cancle";
                        }
                        ?>
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