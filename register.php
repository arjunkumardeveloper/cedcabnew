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

require 'DbConnection.php';
require 'header.php';
require 'User.php';

if (isset($_SESSION['is_admin'])&&$_SESSION['is_admin'] == 1) {
    header('location: admin/index.php');
}
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0) {
    header('location: member/index.php');
}


$insert = '';

if (isset($_POST['submit'])) {
    $user_name = $_POST['username'];
    $name = $_POST['name'];
    $tdate = date('Y-m-d');
    $mobile = $_POST['mobile'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    $User = new User();
    $Dbconn = new DbConnection();
    if ($pass == $repass) {   
        $insert = $User->registration($user_name, $name, $tdate, $mobile, $pass, $Dbconn->conn);
    } else {
        $insert = "<p class='text-danger'>Password should be same!</p>";
    }
    // echo $insert;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cedCab</title>
</head>
<body>
<div class="wrapper-full">
    <div class="wrapper">
        <p><?php echo $insert; ?></p>
        <h3>Registration Page</h3>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" 
                id="username" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" 
                class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" id="mobile" 
                class="form-control" onkeypress="return checkNum()" required>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" 
                class="form-control" required>
            </div>
            <div class="form-group">
                <label for="repass">Re-password</label>
                <input type="password" name="repass" id="repass" 
                class="form-control" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="w-50 btn btn-primary" name="submit" 
                id="submit" value="Register">
            </div>
        </form>
    </div>
</div>

<script>
    
</script>
</body>
</html>



<?php
    require 'footer.php';
?>