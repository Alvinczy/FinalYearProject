 <?php
include('../includes/connect.php');
include('../function/common_function.php');
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
        <title>User registration</title>
         <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 
     <!-- font awesome  link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body>
        <div class="container my-3">
            <h2 class="text-center">New User Registration</h2>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-6 col-x1-6">
                    <form action="" method="post" enctype="multipart/form-data">
                  <!--user name field-->     
                        <div class="form-outline mb-4">     
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                        </div>
                        
                      <!--email field--> 
                      <div class="form-outline mb-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                        </div>
                        
                        <!--image field--> 
                       <div class="form-outline mb-4">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
                        </div>
                        
                        <!--password field-->  
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter your password" autocomplete="off" required="required" name="user_password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                        </div>
                        
                        <!--confirm password field--> 
                        <div class="form-outline mb-4">
                            <label for="conf_user_password" class="form-label">Confirm Password</label>
                            <input type="password" id="conf_user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" placeholder="Confirm password" autocomplete="off" required="required" name="conf_user_password"/>
                        </div>
                        
                        <!--address field-->
                        <div class="form-outline mb-4">                       
                            <label for="user_address" class="form-label">Address</label>
                            <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                        </div>
                        
                        <!--contact field-->
                        <div class="form-outline mb-4">                       
                            <label for="user_contact" class="form-label">Contact</label>
                            <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact"/>
                        </div>
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="user_login.php" class="text-danger"> Login</a></p>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>
<!--php code-->
<?php
        // put your code here
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password= password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_ip=getIPAddress();
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_tfa = false;
    $pin = '';
    //select query
//    $select_query="Select * from `user_table` where username='$user_username'or user_email=''";
//    $result= mysqli_query($con, $select_query);
$sql = "Select * from `user_table` where username= ? or user_email= ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("ss", $user_username,$user_email);
$stmt->execute();
$result = $stmt->get_result();
    $row_count= mysqli_num_rows($result);
    if($row_count>0){
         echo "<script>alert('Username and email already exist')</script>";
    }else if($user_password!=$conf_user_password){
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        //insert query
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
     $stmt = $con->prepare("insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile,is_tfa_enabled,pin) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("sssssssis", $user_username,$user_email,$hash_password,$user_image,$user_ip,$user_address,$user_contact,$user_tfa,$pin);
        $stmt->execute();
//    $insert_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
//$sql_execute= mysqli_query($con, $insert_query);
    }
    

//selecting cart items
//    $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
//    $result_cart= mysqli_query($con, $select_cart_items);
    $sql = "Select * from `cart_details` where ip_address= ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("s", $user_ip);
$stmt->execute();
$result_cart = $stmt->get_result();
     $row_count= mysqli_num_rows($result_cart);
     if($row_count>0){
         $_SESSION['username']=$user_username;
         echo "<script>alert('You have items in your cart')</script>";
          echo "<script>window.open('checkout.php','_self')</script>";
     }else{
         echo "<script>window.open('../Home.php','_self')</script>";
     }
}
        ?>

<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>