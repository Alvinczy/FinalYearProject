<?php

if (isset($_GET['delete_brands'])) {
    $delete_brands = $_GET['delete_brands'];

//    $delete_query="Delete from `brands` where brand_id=$delete_brands";
//    $result= mysqli_query($con,$delete_query);
    $sql = "Delete from `brands` where brand_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $delete_brands);
    $stmt->execute();

//    if($result){
    echo "<script>alert('Brand is been deleted successfully ')</script>";
    echo "<script>window.open('./Admin_panel.php?view_brands','_self')</script>";
//    }
}
?>
