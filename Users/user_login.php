
<?php
include('../includes/connect.php');
include('../function/common_function.php');
@session_start();

require_once "../vendor/autoload.php";

use Twilio\Rest\Client;

$sid = "AC7b2b842737cd7c9598c96868d5802dc6";
$token = "61a7ddb1bb0d6bc453b905c36a4fd9ab";

if (isset($_SESSION['attempt_again'])) {
    $now = time();
    if ($now >= $_SESSION['attempt_again']) {
        unset($_SESSION['attempt']);
        unset($_SESSION['attempt_again']);
    }
}
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Login</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- font awesome  link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .body{
                overflow: hidden;
            }
        </style>
    </head>
    <body>
        <div class="container my-3">
            <h2 class="text-center"> User Login</h2>
            <div class="row d-flex align-items-center justify-content-center mt-5">
                <div class="col-lg-6 col-x1-6">
                    <form action="" method="post" >
                        <!--user name field-->     
                        <div class="form-outline mb-4">     
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                        </div>

                        <!--password field-->  
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                        </div>

<?php
if (isset($_SESSION['error'])) {
    ?>
                            <div class="alert alert-danger text-center" style="margin-top:20px;">
                            <?php echo $_SESSION['error']; ?>
                            </div>
                                <?php
                                unset($_SESSION['error']);
                            }

                            if (isset($_SESSION['success'])) {
                                ?>
                            <div class="alert alert-success text-center" style="margin-top:20px;">
                            <?php echo $_SESSION['success']; ?>
                            </div>
                                <?php
                                unset($_SESSION['success']);
                            }
                            ?>



                        <div class="mt-4 pt-2">
                            <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ? <a href="user_registration.php" class="text-danger"> Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
<?php
// put your code here

$number = 5;
if (isset($_POST['user_login'])) {
    if (!isset($_SESSION['attempt'])) {
        $_SESSION['attempt'] = 0;
    }
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

//    $select_query = "Select * from `user_table` where username='$user_username'";
//    $result = mysqli_query($con, $select_query);
    $sql = "Select * from `user_table` where username= ? "; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();



    //cart item
//    $select_query_cart = "Select * from `cart_details` where ip_address='$user_ip'";
//    $select_cart = mysqli_query($con, $select_query_cart);
    $sql = "Select * from `cart_details` where ip_address= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_ip);
    $stmt->execute();
    $result_cart = $stmt->get_result();
    $row_count_cart = mysqli_num_rows($result_cart);




    if ($_SESSION['attempt'] == 5) {
        $_SESSION['error'] = 'Attempt limit reach';
    } else {

        if ($row_count > 0) {
            $_SESSION['username'] = $user_username;
            $sql = "SELECT * FROM user_table WHERE username= '$user_username'";
            $result_otp = mysqli_query($con, $sql);
            $row = mysqli_fetch_object($result_otp);

            if (password_verify($user_password, $row_data['user_password'])) {


//                if ($row_count == 1 and $row_count_cart == 0) {
//
//                    echo"<script>alert('Login Successfully')</script>";
//                    echo"<script>window.open('profile.php','_self')</script>";
//                } else {
//                    $_SESSION['username'] = $user_username;
//                    echo"<script>alert('Login Successfully')</script>";
//                    echo"<script>window.open('payment.php','_self')</script>";
//                }
                if ($row->is_tfa_enabled) {
                    $row->is_verified = false;
                    $_SESSION["user"] = $row;

                    $pin = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

                    $sql = "UPDATE user_table SET pin = '$pin'  WHERE user_id = '" . $row->user_id . "'";
                    mysqli_query($con, $sql);

                    $client = new Client($sid, $token);
                    $client->messages->create(
                            $row->user_mobile, array(
                        "from" => "+12183792429",
                        "body" => "Your 2-factor authentication code is: " . $pin
                            )
                    );

                    header("Location: enter_pin.php");
                } else {
                    $row->is_verified = true;
                    $_SESSION["user"] = $row;

                    header("Location: pin_page.php");
                }
            } else {

                echo"<script>alert('Invalid Credentials(Password Incorrect)  ') </script>";



                $_SESSION['error'] = 'Password incorrect  ';
                //this is where we put our 3 attempt limit
                $_SESSION['attempt'] += 1;
                //set the time to allow login if third attempt is reach
                if ($_SESSION['attempt'] == 5) {
                    $_SESSION['attempt_again'] = time() + (1 * 60);
                    //note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
                }
            }
        } else {
            echo"<script>alert('Invalid Credentials')</script>";
        }
    }
}
?>


<?php
if (isset($_SESSION['error'])) {
    ?>
    <div class="alert alert-danger text-center" style="margin-top:20px;">
    <?php echo $_SESSION['error']; ?>
    </div>
    <?php
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    ?>
    <div class="alert alert-success text-center" style="margin-top:20px;">
    <?php echo $_SESSION['success']; ?>
    </div>
    <?php
    unset($_SESSION['success']);
}
?>