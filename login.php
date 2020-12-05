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
require 'User.php';
require 'DbConnection.php';
require 'Ride.php';

if (isset($_SESSION['is_admin'])&&$_SESSION['is_admin'] == 1) {
    header('location: admin/index.php');
}
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 0) {
    header('location: member/index.php');
}

// echo time();

$insert = '';
// print_r($_SESSION['ride']);
if (isset($_POST['submit'])) {
    $user_name = trim($_POST['username']);
    $pass = trim($_POST['pass']);

    $User = new User();
    $Ride = new Ride();
    $Dbconn = new DbConnection();
    
    $insert = $User->login($user_name, $pass, $Dbconn->conn);
    
    if ($insert != "Login Faild !") {
        $username = $insert['user_name'];
        setcookie('username', $username, time()+(86400*30), "/");

        if ($insert['is_admin'] == 0) {
            
            if (isset($_SESSION['ride'])) {
                $now = time();
                // echo $now;
                if ($now < $_SESSION['expire']) {

                    $pickup = $_SESSION['ride']['pickup'];
                    $drop = $_SESSION['ride']['drop'];
                    $distance = $_SESSION['ride']['distance'];
                    $lugg = $_SESSION['ride']['lugg'];
                    $fare = $_SESSION['ride']['fare'];
                    $cab = $_SESSION['ride']['cab'];
                    // $uid = $insert['user_id'];
                    // print_r($cab);
                    // exit();
                    

                    $_SESSION['name'] = $insert['name'];
                    $_SESSION['is_admin'] = $insert['is_admin'];
                    $_SESSION['userid'] = $insert['user_id'];
                    // $uid = $_SESSION['userid'];
                    
                    // $tdate = date("Y-m-d");
                    $msg = $Ride->insertRide($pickup, $drop, $distance, $lugg, $fare, $cab, $Dbconn->conn);
                    echo $msg;
                    // exit();
                    
                    // unset($_SESSION['ride']);
                    header('location: member/index.php');
                } else {
                    unset($_SESSION['ride']);
                    header('location: index.php');
                }
            } else {
                $_SESSION['name'] = $insert['name'];
                $_SESSION['is_admin'] = $insert['is_admin'];
                $_SESSION['userid'] = $insert['user_id'];
                header('location: member/index.php');
            }
            
        } else if ($insert['is_admin'] == 1) {
            header('location: admin/index.php');
            $_SESSION['name'] = $insert['name'];
            $_SESSION['is_admin'] = $insert['is_admin'];
            $_SESSION['userid'] = $insert['user_id'];
        }
    } else {
        echo $insert;
    } 

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
        <h3>Login Page</h3>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" 
                id="username" value="<?php
                    if (isset($_COOKIE['username'])) {
                        echo $_COOKIE['username'];
                    }
                    ?>"
                required>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" class="form-control" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="w-50 btn btn-primary" name="submit" 
                id="submit" value="Login">

                <p><a href="register.php">New User ?</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>



<?php
    require 'footer.php';
?>