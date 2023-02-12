<?php

if (isset($_GET['delete_category'])) {
    $delete_category = $_GET['delete_category'];

//    $delete_query="Delete from `categories` where category_id=$delete_category";
//    $result= mysqli_query($con,$delete_query);
//    if($result){
    $sql = "Delete from `categories` where category_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $delete_category);
    $stmt->execute();
    echo "<script>alert('Category is been deleted successfully ')</script>";
    echo "<script>window.open('./Admin_panel.php?view_categories','_self')</script>";
//    }
}
?>
