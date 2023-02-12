
<?php
include('../includes/connect.php');
include('../function/common_function.php');
@session_start();



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
        <title>Admin Login</title>
               <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- css file -->
<link rel="stylesheet" href="../style.css">
     <!-- font awesome  link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>

body{
    overflow-x: hidden;
}
 

      
  </style>
    </head>
    <body>
        <div class="container-fluid m-3">
            <h2 class="text-center mb-5">Admin Login</h2>
            <div class="d-flex row justify-content-center ">
                <div class="col-lg-6 col-xl-4">
                    <img src="../images/login_image.png" alt="Admin Registration" class="image-fluid">
                </div>
                <div class="col-lg-6 col-xl-4">
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label for="admin_name" class="form-label">Username</label>
                            <input type="text" id="admin_name" name="admin_name" placeholder="Enter your username" required="required" class="form-control">
                        </div>
                        
                        <div class="form-outline mb-4">
                            <label for="admin_password" class="form-label">Password</label>
                            <input type="password" id="password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                        </div>
                        
                        <div>
                            <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have a account ? <a href="admin_registration.php" class="text-danger"> Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        // put your code here

        ?>
    </body>
</html>
<?php
        // put your code here
 if(isset($_POST['admin_login'])){
     $admin_username=$_POST['admin_name'];
     $admin_password=$_POST['admin_password'];
     
     $sql = "Select * from `admin_table` where admin_name= ? "; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$result = $stmt->get_result();
//     $select_query="Select * from `admin_table` where admin_name='$admin_username'";
//     $result= mysqli_query($con, $select_query);
     $row_count= mysqli_num_rows($result);
     $row_data= mysqli_fetch_assoc($result);
    
     
  
     if($row_count>0){
         $_SESSION['admin_name']=$admin_username;
         if(password_verify($admin_password, $row_data['admin_password'])){
             //echo"<script>alert('Login Successfully')</script>";
             if($row_count==1 and $row_count_cart==0 ){
                 $_SESSION['admin_name']=$admin_username;
                 echo"<script>alert('Login Successfully')</script>";
                 echo"<script>window.open('Admin_panel.php','_self')</script>";
                
             }else{
                 $_SESSION['admin_name']=$admin_username;
                 echo"<script>alert('Login Successfully')</script>";
                 echo"<script>window.open('Admin_panel.php','_self')</script>";
             }
             }else{
                 echo"<script>alert('Invalid Credentials')</script>";
                 
                         
              }         
             }else{
                 echo"<script>alert('Invalid Credentials')</script>";//ngam
             }  
 }
        ?>