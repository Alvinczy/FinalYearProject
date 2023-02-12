<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
//    $select_query="Select * from `user_table` where username='$user_session_name'";
//    $result_query=mysqli_query($con,$select_query);
    $sql = "Select * from `user_table` where username= ?"; // SQL with parameters
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_session_name);
    $stmt->execute();
    $result_query = $stmt->get_result();

    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];

    if (isset($_POST['user_update'])) {
        $update_id = $user_id;
        $username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        //update query
//        $update_data = "update `user_table` set username='$username',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' where user_id='$update_id'";
//        $result_query_update = mysqli_query($con, $update_data);
        $sql = "update `user_table` set username=?,user_email=?,user_image=?,user_address=?,user_mobile=? where user_id=?"; // SQL with parameters
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssi", $username,$user_email,$user_image,$user_address,$user_mobile,$update_id);
        $stmt->execute();
        
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('logout.php','_self'></script>";
       
    }
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
        <title>Edit Account</title>
    </head>
    <body>
        <h3 class=" text-success mb-4">Edit account</h3>
        <form action="" method="post" enctype="multipart/form-data" >
            <div class="form-outline mb-4">
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $username; ?>" name="user_username">
            </div>
            <div class="form-outline mb-4">
                <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email; ?>" name="user_email">
            </div>
            <div class="form-outline mb-4 d-flex  w-50 m-auto">
                <input type="file" class="form-control m-auto" name="user_image">
                <img src="./user_images/<?php echo $user_image ?>" alt="" class="edit_image">
            </div>
            <div class="form-outline mb-4">
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address; ?>" name="user_address">
            </div>
            <div class="form-outline mb-4">
                <input type="text" class="form-control w-50 m-auto"  value="<?php echo $user_mobile; ?>" name="user_mobile">
            </div>

            <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
