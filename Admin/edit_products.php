<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
//   $get_data="Select * from `products` where product_id=$edit_id";
//   $result= mysqli_query($con, $get_data);
    $sql = "Select * from `products` where product_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];

//fetching category name
//    $select_category = "Select * from `categories` where category_id=$category_id";
//    $result_category = mysqli_query($con, $select_category);
    $sql = "Select * from `categories` where category_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result_category = $stmt->get_result();
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];
    // echo $category_title;
    //fetching brand name
//    $select_brand = "Select * from `brands` where brand_id=$brand_id";
//    $result_brand = mysqli_query($con, $select_brand);
    $sql = "Select * from `brands` where brand_id= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $brand_id);
    $stmt->execute();
    $result_brand = $stmt->get_result();
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand['brand_title'];
    //echo $brand_title;
}
?>


<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" value="<?php echo $product_title; ?> " autocomplete="off" required="required">
        </div>

        <!-- description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Product description</label>
            <input type="text" name="product_description" id="product_description" class="form-control" value="<?php echo $product_description; ?>"  autocomplete="off" required="required">
        </div>

        <!-- keywords -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product keywords to be search</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control" value="<?php echo $product_keywords; ?>" autocomplete="off" required="required">
        </div>

        <!-- categories -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="" class="form-select">
                <option value="<?php echo '$category_title'; ?>"><?php echo $category_title; ?></option>
                <?php
                $select_category_all = "Select * from `categories`";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title = $row_category_all['category_title'];
                    $category_id = $row_category_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>

            </select>
        </div>
        <!-- Brands -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_brands" id="" class="form-select mb-4">
                <option value="<?php echo '$brand_title'; ?>"><?php echo $brand_title; ?></option>
                <?php
                $select_brand_query = "Select * from `brands`";
                $result_brand_query = mysqli_query($con, $select_brand_query);
                while ($row_brand = mysqli_fetch_assoc($result_brand_query)) {
                    $brand_title = $row_brand['brand_title'];
                    $brand_id = $row_brand['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>

            <!-- Image 1 -->
            <div class="form-outline mb-4  m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <div class="d-flex">
                    <input type="file" name="product_image1" id="product_image1" class="form-control w-90 m-auto"  required="required">
                    <img src="./product_images/<?php echo $product_image1 ?>" class="product_img";>
                </div>
            </div>

            <!-- Image 2 -->
            <div class="form-outline mb-4  m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <div class="d-flex">
                    <input type="file" name="product_image2" id="product_image2" class="form-control"  required="required">
                    <img src="./product_images/<?php echo $product_image2 ?>" class="product_img";>
                </div>
            </div>

            <!-- Image 3 -->
            <div class="form-outline mb-4  m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <div class="d-flex">
                    <input type="file" name="product_image3" id="product_image3" class="form-control"  required="required">
                    <img src="./product_images/<?php echo $product_image3 ?>" class="product_img";>
                </div>
            </div>

            <div class="form-outline mb-4  m-auto ">
                <label for="product_price" class="form-label">Product Price(RM)</label>
                <input type="text" name="product_price" id="product_price" class="form-control" value=" <?php echo $product_price; ?>" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <div class="form-outline px-4 mb-3  m-auto">

                <input type="submit" name="edit_product"  class="btn btn-info mb-3 px-3" value="Update Product">
            </div>

    </form>
</div>
<!--editing products-->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    //accessing images

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

//accessing image tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

//checking for empty fields
    if ($product_title == '' or $product_description == '' or $product_keywords == '' or $product_category == '' or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '') {
        echo "<script>alert('Please fill all the available fields')</script>";
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        //update query
//        $update_products = "update  `products` set product_title='$product_title',product_description='$product_description',product_keywords='$product_keywords', category_id='$product_category',brand_id='$product_brands',product_image1='$product_image1',product_image2='$product_image2',product_image3='$product_image3',product_price='$product_price',date=NOW() where product_id=$edit_id ";
//        $result_update = mysqli_query($con, $update_products);
//        if ($result_update) {
        $sql = "update  `products` set product_title= ?,product_description= ?,product_keywords= ?, category_id= ?,brand_id=?,product_image1= ?,product_image2= ?,product_image3= ?,product_price= ?,date=NOW() where product_id= ? "; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("sssiisssii", $product_title,$product_description,$product_keywords,$product_category,$product_brands,$product_image1,$product_image2,$product_image3,$product_price,$edit_id);
$stmt->execute();
$result = $stmt->get_result();

            echo "<script>alert('Successfully updated the products ')</script>";
            echo "<script>window.open('./Admin_panel.php?view_products','_self')</script>";
//        }
    }
}
?>