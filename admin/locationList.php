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
$Location = new Location();

$msg = '';
$Dbconn = new DbConnection();


// print_r($data);
// echo $data;

if (isset($_POST['Delete'])) {
    $locid = $_POST['locationid'];

    $msg = $Location->deleteLocation($locid, $Dbconn->conn);
}


if (isset($_GET['type']) && $_GET['type'] != "") {
    $type = $_GET['type'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $id = $_GET['id'];
        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }
        $msg = $Location->stopRide($id, $status, $Dbconn->conn);
    }
}
$data = $Location->fetchLocation($Dbconn->conn);
?>
<section>
    <div class="wrapper">
        <h3>Location List</h3>
        <p><?php echo $msg; ?></p>
        <div class="container form">
            <!-- <form action="addLocation.php" method="post"> -->
                <input type="hidden" id="locid">
                <div class="form-group">
                    <label for="name">Name<span>*</span></label>
                    <input type="text" name="name" id="fetchname" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <label for="mobile">Distance<span>*</span></label>
                    <input type="text" name="dis" id="fetchdis" 
                    class="form-control" onkeypress="return checkNum()">
                </div>
                <div class="form-group">
                    <input type="submit" id="updateInfo" value="Update" name="submit">
                </div>
            <!-- </form> -->
        </div>
        <div class="box1">
            <table>
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>Distance (in km)</th>
                        <th>Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr=1;
                    
                    foreach ($data as $row) {
                        ?>
                            <tr>
                                <td><?php echo $sr++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['distance']; ?></td>
                                <td>
                                    <?php
                                    if ($row['is_available'] == 1) {
                                         echo "Available";
                                    } else {
                                         echo "<span>Not Available</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="active editInfo" data-id="<?php echo $row['id'] ?>" $type="button" id="editInfo">Edit</button>
                                    <form action="locationList.php" method="post" style="display: inline;">
                                        <input type="hidden" id="locationid" name="locationid"
                                        value="<?php echo $row['id'] ?>">
                                        <input type="submit" name="Delete" value="Delete" onclick='return conmsg()'>
                                    </form>
                                    <?php
                                    if ($row['is_available'] == 1) {
                                        ?>
                                        <a href="locationList.php?type=status&operation=deactive&id=<?php echo $row['id']; ?>" class="active">
                                        Not Available</a>

                                        <?php
                                    } else {
                                        ?>
                                        <a href="locationList.php?type=status&operation=active&id=<?php echo $row['id']; ?>" class="active">
                                        Available</a>
                                        <?php
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
</script>

<?php
    require 'footer.php';
?>
