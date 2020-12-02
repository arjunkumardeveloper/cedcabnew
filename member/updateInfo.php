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
// require 'config.php';
require 'header.php';
require '../User.php';



$msg = '';
$User = new User();
$Dbconn = new DbConnection();
$Dbconn->conn;

?>
<section>
    <div class="wrapper">
        <h3>Update Information</h3>
        <table>
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // $insert = $User->registration
            $data = $User->fetchUserInfo($Dbconn->conn);
            // print_r($data);
            $sr = 1;
            foreach ($data as $row) {
                ?>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo $row['dateofsignup']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td id="name"><?php echo $row['name']; ?></td>
                        <td id="mobile"><?php echo $row['mobile']; ?></td>
                        <td>
                            <button type="button" id="editInfo">Edit</button>
                        </td>
                    </tr>

                <?php
            }
            ?>

            </tbody>
        </table>

        <div class="container form">
            <!-- <form action="addLocation.php" method="post"> -->
                <div class="form-group">
                    <label for="name">Name<span>*</span></label>
                    <input type="text" name="name" id="fetchname" 
                    class="form-control">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile<span>*</span></label>
                    <input type="text" name="mobile" id="fetchmobile" 
                    class="form-control" onkeypress="return checkNum()">
                </div>
                <div class="form-group">
                    <input type="submit" id="updateInfo" value="Update" name="submit">
                </div>
            <!-- </form> -->
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