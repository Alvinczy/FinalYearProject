<?php
include('../includes/connect.php');
include('../function/common_function.php');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Payment page</title>
         <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 
     <!-- font awesome  link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <style>
      .payment_img{
          width:90%;
          margin: auto;
          display: block;
      }
  </style>
    </head>
    <body> 
        <!-- php code to access user id-->
 <?php
        // put your code here
 $user_ip= getIPAddress();
// $get_user="Select * from `user_table` where user_ip='$user_ip'";
// $result=mysqli_query($con,$get_user);
 $sql = "Select * from `user_table` where user_ip= ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_ip);
$stmt->execute();
$result = $stmt->get_result();

 $run_query=mysqli_fetch_array($result);
 $user_id=$run_query['user_id'];
 
?>
        <div class="container">
            <h2 class="text-center text-info">Payment Options</h2>
            <div class="row d-flex justify-content-center align-items-center mt-5">
                <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="../images/UPI.jpg" alt="" class="payment_img"></a>
                </div>
                <div class="col-md-6">
                    <a href="order.php?user_id=<?php echo $user_id ?>" ><h2 class="text-center">Pay Offline</h2></a>
                </div>
            </div>
        </div>
      
    </body>
</html>
