


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $username = $_SESSION['username'];
//        $get_user="Select * from `user_table` where username='$username'";
//        $result= mysqli_query($con, $get_user);
        $sql = "Select * from `user_table` where username= ?"; // SQL with parameters
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();

        $row_fetch = mysqli_fetch_assoc($result);
        $user_id = $row_fetch['user_id'];
        ?>
        <h3 class="text-success">All my orders</h3>
        <table class="table table-bordered mt-5 text-center">
            <thead class="bg-info">
                <tr>
                    <th>S1 no</th>
                    <th>Amount Due</th>
                    <th>Total products</th>
                    <th>Invoice number</th>
                    <th>Date</th>
                    <th>Complete/Incomplete</th>
                    <th>Status</th>


                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
<?php
$number = 1;
//$get_order_details = "Select * from `user_orders` where user_id=$user_id";
//
//$result_orders = mysqli_query($con, $get_order_details);
$sql = "Select * from `user_orders` where user_id= ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_orders = $stmt->get_result();

while ($row_orders = mysqli_fetch_assoc($result_orders)) {
    $order_id = $row_orders['order_id'];
    $amount_due = $row_orders['amount_due'];
    $total_products = $row_orders['total_products'];
    $invoice_number = $row_orders['invoice_number'];
    $order_status = $row_orders['order_status'];
    if ($order_status == 'pending') {
        $order_status = 'Incomplete';
    } else {
        $order_status = 'Complete';
    }
    $order_date = $row_orders['order_date'];

    echo"
                        <tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td>$order_status </td>";
    ?>
                    <?php
                    if ($order_status == 'Complete') {
                        echo"    <td>Paid </td>";
                    } else {
                        echo" <td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
                        </tr>";
                    }

                    $number++;
                }
                ?>

            </tbody>
        </table>
<?php
// put your code here
?>
    </body>
</html>
