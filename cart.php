<?php
include('includes/connect.php');
include('function/common_function.php');
session_start();
?>
<html>
    <title>Cart Details</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- font awesome  link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">

    <style>
        .cart_img{
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
    <body>

        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-warning">
            <div class="container-fluid p-0">
                <img src="images/Logo.png" alt="" class="logo">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo" <li class='nav-item'>
            <a class='nav-link' href='./Users/profile.php'>My Account</a>
        </li>";
                        } else {
                            echo" <li class='nav-item'>
            <a class='nav-link' href='./Users/user_registration.php'>Register</a>
        </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>

                    </ul>

                </div>

            </div>
        </nav>
        <!---calling cart function -->
        <?php
        cart();
        ?>
        <!---child 2 -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class=" navbar-nav me-auto">

                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li> ";
                } else {
                    echo "<li class='nav-item'>
               <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . " </a>
           </li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo"<li class='nav-item'>
               <a class='nav-link' href='./Users/user_login.php'>Login</a>
           </li>";
                } else {
                    echo"<li class='nav-item'>
               <a class='nav-link' href='./Users/logout.php'>Logout</a>
           </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- child 3 -->
        <div class="bg-light">
            <h3 class="text-center"><i class="fa-solid fa-truck"></i>We deliver 7 days a week from 9am-9pm!  </h3>

        </div>
        <!-- child 4-table -->

        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">

                        <!--php code to display dynamic data-->
                        <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $total_price = 0;
//                    $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
//                    $result= mysqli_query($con, $cart_query);
                        $sql = "Select * from `cart_details` where ip_address= ? "; // SQL with parameters
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("s", $get_ip_add);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo"<thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </tr>
                </thead>
                <tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
//                                $select_product = "Select * from `products` where product_id='$product_id'";
//                                $result_products = mysqli_query($con, $select_product);
                                $sql = "Select * from `products` where product_id= ? "; // SQL with parameters
                                $stmt = $con->prepare($sql);
                                $stmt->bind_param("i", $product_id);
                                $stmt->execute();
                                $result_products = $stmt->get_result();
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $product_values = array_sum($product_price);
                                    $total_price += $product_values;
                                    ?>
                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src="./Admin/product_images/<?php echo htmlspecialchars($product_image1) ?>" alt="" class="cart_img"></td>
                                        <td><input type="text" name="qty"  class="form-input w-50"></td>
                                        <?php
                                        $get_ip_add = getIPAddress();
                                        if (isset($_POST['update_cart'])) {
                                            $quantities = $_POST['qty'];
//                                            $update_cart = "update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
//                                            $result_products_quantity = mysqli_query($con, $update_cart);
                                            $sql = "update `cart_details` set quantity= ? where ip_address= ? "; // SQL with parameters
                                            $stmt = $con->prepare($sql);
                                            $stmt->bind_param("is", $quantities, $get_ip_add);
                                            $stmt->execute();
                                            $result_products_quantity = $stmt->get_result();
                                            $total_price = $total_price * $quantities;
                                        }
                                        ?>
                                        <td>RM <?php echo htmlspecialchars($price_table) ?></td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                        <td>
                                            <!--                            <button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                                            <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">

                                            <!--                            <button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>-->
                                            <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        } else {
                            echo"<h2 class='text-center text-danger'>Cart is empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <!--subtotal-->
                    <div class="d-flex mb-3">
                        <?php
                        $get_ip_add = getIPAddress();

//                        $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
//                        $result = mysqli_query($con, $cart_query);
                        $sql = "Select * from `cart_details` where ip_address= ? "; // SQL with parameters
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("s", $get_ip_add);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal:RM<strong class='text-info'>$total_price  </strong></h4>
                <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                <button class='bg-secondary px-3 py-2 border-0 '><a href='./Users/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
                        } else {
                            echo"<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
                        }

                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('Home.php','_self')</script>";
                        }
                        ?>

                    </div>
            </div>
        </div>
    </form>
    <!-- function to remove item-->
    <?php

    function remove_cart_function() {

        global $con;
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
//                $delete_query = "Delete  from `cart_details` where product_id=$remove_id";
//                $run_delete = mysqli_query($con, $delete_query);
                $sql = "Delete  from `cart_details` where product_id= ? "; // SQL with parameters
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $remove_id);
                $stmt->execute();
                if ($stmt) {
                    echo "<script>window.open('cart.php','_self')</script>";
                }
            }
        }
    }

    echo $remove_item = remove_cart_function();
    ?>



    <!-- include footer-->
    <?php
    include("./includes/footer.php")
    ?>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>