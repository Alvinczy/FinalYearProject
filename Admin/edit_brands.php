<?php
if (isset($_GET['edit_brands'])) {
    $edit_brands = $_GET['edit_brands'];
//    $get_brands="Select * from `brands` where brand_id=$edit_brands";
//    $result= mysqli_query($con, $get_brands);
    $sql = "Select * from `brands` where brand_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $edit_brands);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    $brand_title = $row['brand_title'];
}
//echo $category_title;
if (isset($_POST['edit_brand'])) {
    $brand_title = $_POST['brand_title'];
//        $update_query="update `brands` set brand_title='$brand_title' where brand_id=$edit_brands";
//         $result_cat= mysqli_query($con,$update_query);
    $sql = "update `brands` set brand_title= ? where brand_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $brand_title, $edit_brands);
    $stmt->execute();

//         if($result_cat){
    echo "<script>alert('Brand is been updated successfully ')</script>";
    echo "<script>window.open('./Admin_panel.php?view_brands','_self')</script>";

//    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 text-center m-auto" >
            <label for="brand_title" class="form-label text-center">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control text-center" required="required" value="<?php echo $brand_title ?>"> 
        </div>
        <input type="submit"  value="Update Brand" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>