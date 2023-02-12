<?php
include('../includes/connect.php');

session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
//    echo $order_id;
//    $select_data="Select * from `user_orders` where order_id=$order_id";
//    $result= mysqli_query($con, $select_data);
    $sql = "Select * from `user_orders` where order_id= ? "; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
//    $insert_query="insert into `user_payments` (order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
//    $result= mysqli_query($con, $insert_query);
    $sql = "insert into `user_payments` (order_id,invoice_number,amount,payment_mode) values (?,?,?,?)"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiis", $order_id, $invoice_number, $amount, $payment_mode);
    $stmt->execute();
//    $result = $stmt->get_result();
//    if ($result) {
//        echo "<h3 class='text-center text-light'>Successfully completed the payments</h3>";
        echo"<script>alert('Successfully completed the payments')</script>";
        echo "<script>window.open('profile.php?user_orders','_self')</script>";
        
//    }
//    $update_orders = "update `user_orders` set order_status='Complete' where order_id=$order_id";
//    $result_orders = mysqli_query($con, $update_orders);
     $sql = "update `user_orders` set order_status='Complete' where order_id=?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
}
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

    </head>
    <body class="bg-secondary">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <div class="container my-5">
            <form action="" method="post">
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">

                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <label for="" class="text-light">Amount</label>
                    <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">

                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <select name="payment_mode" class="form-select w-50 m-auto">
                        <option>Select Payment Mode</option>
                        <option>QR pay</option>
                        <option>online banking</option>
                        <option>Paypal</option>
                        <option>Cash On delivery</option>
                        <option>pay offline</option>
                    </select>

                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">

                    <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">

                </div>

        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
