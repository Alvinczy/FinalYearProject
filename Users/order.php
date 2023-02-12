<?php
include('../includes/connect.php');
include('../function/common_function.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

//getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
//$cart_query_price="Select * from `cart_details` where ip_address='$get_ip_address'";
//$result_cart_price=mysqli_query($con,$cart_query_price);
$sql = "Select * from `cart_details` where ip_address= ?"; // SQL with parameters
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $get_ip_address);
$stmt->execute();
$result_cart_price = $stmt->get_result();
$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);
while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "Select * from `products` where product_id='$product_id'";
    $run_price = mysqli_query($con, $select_product);
    while ($row_product_price = mysqli_fetch_array($run_price)) {

        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}
//getting quantity from cart
$get_cart = "select * from `cart_details`";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;
}

//$insert_orders="insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
//$result_query=mysqli_query($con,$insert_orders);
$sql = "insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values (?,?,?,?,NOW(),?)"; // SQL with parameters
$stmt = $con->prepare($sql);
$stmt->bind_param("iiiis", $user_id, $subtotal, $invoice_number, $count_products, $status);
$stmt->execute();
$result = $stmt->get_result();


echo "<script>alert('Orders are submitted successfully')</script>";
echo "<script>window.open('profile.php','_self')</script>";


//orders pending
//$insert_pending_orders = "insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values ($user_id,$invoice_number,$product_id,$quantity,'$status')";
//$result_pending_orders = mysqli_query($con, $insert_pending_orders);
$sql = "insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values (?,?,?,?,?)"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("iiiis", $user_id,$invoice_number,$product_id,$quantity,$status);
$stmt->execute();




//delete items from cart
//$empty_cart = "Delete from `cart_details` where ip_address='$get_ip_address'";
//$result_delete = mysqli_query($con, $empty_cart);
$sql = "Delete from `cart_details` where ip_address= ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $get_ip_address);
$stmt->execute();
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
        <title>Order Page</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
