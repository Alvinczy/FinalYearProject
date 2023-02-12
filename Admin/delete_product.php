<?php
    if(isset($_GET['delete_product'])){
        $delete_id=$_GET['delete_product'];
        
        //delete query
//        $delete_product="Delete from `products` where product_id=$delete_id";
//        $result_product= mysqli_query($con, $delete_product);
         $sql = "Delete from `products` where product_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
//        if($result_product){
            echo "<script>alert('Successfully deleted the products ')</script>";
        echo "<script>window.open('./Admin_panel.php','_self'></script>";
//        }
                
    }
        ?>
