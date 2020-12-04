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
require 'config.php';
require '../User.php';
require 'header.php';



$msg = '';
$User = new User();
$Dbconn = new DbConnection();
$Dbconn->conn;

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
        $msg = $User->unblockUser($status, $id, $Dbconn->conn);
    }
}


if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    // echo $rideid;
    $msg = $User->deleteUser($userid, $Dbconn->conn);
}

?>
<section>
    <div class="wrapper">
        <h3>Registerd User</h3>
        <p><?php echo $msg; ?></p>
        <table>
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
            $data = $User->fetchUser($Dbconn->conn);
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
                        <?php if ($row['isblock'] == 1) { ?>
                            Approved
                           
                        <?php } else { ?>
                            <a href="registerUser.php?type=status&operation=active&id=<?php echo $row['user_id']; ?>" class="active">
                            Pending..</a>
                            
                        <?php } ?>
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
                        // if ($row['is_admin'] == 1) {
                        //     echo "--";
                        // } else {
                        ?>
                            <form action="registerUser.php" method="post">
                                <input type="hidden" name="userid"
                                value="<?php //echo $row['user_id']; ?>">
                                <input type="submit" value="Delete" onclick="return conmsg()" name="submit">
                            </form>
                        </td> -->
                        <?php //}?>
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