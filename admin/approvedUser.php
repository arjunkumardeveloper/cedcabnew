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
require '../User.php';
require 'header.php';


$User = new User();
$Dbconn = new DbConnection();
$Dbconn->conn;

$msg = '';
if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    // echo $rideid;
    $msg = $User->deleteUser($userid, $Dbconn->conn);
}

?>
<section>
    <div class="wrapper">
    <p><?php echo $msg; ?></p>
        <h3>Approved User</h3>
        <label>Sort</label>
        <select id="userSort">
            <option value="">--Select--</option>
            <option value="descuname">Sort By Username In DESC Order</option>
            <option value="ascuname">Sort By Username In ASC Order</option>
            <option value="descdate">Sort By Date In DESC Order</option>
            <option value="ascdate">Sort By Date In ASC Order</option>
        </select>
        <div id="userSortResult"></div>
        <table id="userTable">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>status</th>
                    <th>Admin/User</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
            <?php
            // $insert = $User->registration
            $data = $User->approvedUser($Dbconn->conn);
            // print_r($data);
            $sr = 1;
            foreach ($data as $row) {
                ?>
                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo $row['dateofsignup']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <?php 
                            if ($row['isblock'] == 1) {
                                echo "Approved..";
                            } 
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row['is_admin'] == 1) {
                                echo "Admin";
                            } else {
                                echo "User";
                            }
                            ?>
                        </td>
                        <!-- <td>
                        <?php
                        //if ($row['is_admin'] == 1) {
                         //   echo "--";
                       // } else {
                            ?>
                            <form action="approvedUser.php" method="post">
                                <input type="hidden" name="userid"
                                value="<?php// echo $row['user_id']; ?>">
                                <input type="submit" value="Delete" onclick="return conmsg()" name="submit">
                            </form>
                        <?php// } ?>
                        </td> -->
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