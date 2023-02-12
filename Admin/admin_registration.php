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
        <title>Admin Registration</title>
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
            <h2 class="text-center mb-5">Admin Registration</h2>
            <div class="d-flex row justify-content-center ">
                <div class="col-lg-6 col-xl-4">
                    <img src="../images/Register.jpg" alt="Admin Registration" class="image-fluid">
                </div>
                <div class="col-lg-6 col-xl-4">
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label for="admin_name" class="form-label">Username</label>
                            <input type="text" id="admin_name" name="admin_name" placeholder="Enter your username" required="required" class="form-control">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="admin_email" class="form-label">Email</label>
                            <input type="email" id="admin_email" name="admin_email" placeholder="Enter your Email" required="required" class="form-control">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="admin_password" class="form-label">Password</label>
                            <input type="password" id="admin_password" name="admin_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter your password" required="required" class="form-control">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="conf_admin_password" class="form-label">Confirm Password</label>
                            <input type="password" id="conf_admin_password" name="conf_admin_password" placeholder="Confirm password" required="required" class="form-control">
                        </div>
                        <div>
                            <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="admin_login.php" class="text-danger"> Login</a></p>
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

<!--php code-->
<?php
        // put your code here
if(isset($_POST['admin_registration'])){
    $admin_username=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password= password_hash($admin_password, PASSWORD_DEFAULT);
    $conf_admin_password=$_POST['conf_admin_password'];
    $pin = '';
    $tfa = 0;
    //select query
//    $select_query="Select * from `admin_table` where admin_name='$admin_username'or admin_email='$admin_email'";
//    $result= mysqli_query($con, $select_query);
    
    $sql = "Select * from `admin_table` where admin_name= ? or admin_email= ?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param("ss", $admin_username,$admin_email);
$stmt->execute();
$result = $stmt->get_result();
    $row_count= mysqli_num_rows($result);
    if($row_count>0){
         echo "<script>alert('Username and email already exist')</script>";
    }else if($admin_password!=$conf_admin_password){
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        //insert query
    
        $stmt = $con->prepare("insert into `admin_table` (admin_name,admin_email,admin_password,is_tfa_enabled,pin) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $admin_username, $admin_email, $hash_password,$tfa,$pin);
        $stmt->execute();
//    $insert_query="insert into `admin_table` (admin_name,admin_email,admin_password,is_tfa_enabled,pin) values ('$admin_username','$admin_email','$hash_password',0,'')";
//$sql_execute= mysqli_query($con, $insert_query);

echo "<script>alert('Register successfully')</script>";
echo "<script>window.open('./admin_login.php','_self'></script>";
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