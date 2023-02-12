<?php 
include('includes/connect.php');
include('function/common_function.php');
session_start();
?>
<html>
    <title>Home Page</title>
   <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 
     <!-- font awesome  link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css file -->
<link rel="stylesheet" href="style.css">
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
       if(isset($_SESSION['username'])){
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
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:RM <?php total_cart_price(); ?></a>
        </li>
      </ul>
        <form class="d-flex" role="search" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">

<input type="submit" value="Search" class="btn btn-outline-dark" name="search_data_product" ></form>
      </form>
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
          if(!isset($_SESSION['username'])){
              echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li> ";
          }else{
              echo "<li class='nav-item'>
               <a class='nav-link' href='#'>Welcome ".$_SESSION['username']." </a>
           </li>";
          }
          
          if(!isset($_SESSION['username'])){
              echo"<li class='nav-item'>
               <a class='nav-link' href='./Users/user_login.php'>Login</a>
           </li>";
          }else{
              echo"<li class='nav-item'>
               <a class='nav-link' href='./Users/logout.php'>Logout</a>
           </li>";
          }
          
          ?>
<!--           <li class="nav-item">
               <a class="nav-link" href="./Users/user_login.php">Login</a>
           </li>-->
    </ul>
    </nav>
    <!-- child 3 -->
    <div class="bg-light">
        <h3 class="text-center"><i class="fa-solid fa-truck"></i>We deliver 7 days a week from 9am-9pm!  </h3>
        
    </div>
    
    <!-- child 4 -->
    <div class="row px-1 bg-light">
        <div class="col-md-10">
            <!-- display product-->
            <div class="row">
                <!--fetching product-->
                <?php
                //calling function
getproducts();
get_unique_categories();
get_unique_brands();
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip; 
                ?>
                
            <!-- row end-->      
            </div>    
            <!-- col end--> 
  
        </div>
        
        
        <div class="col-md-2 bg-secondary p-0">
            <!--sidenav for brand-->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-warning ">
                    <a href="# "class="nav-link text-light"><h4>Hot Brand</h4></a>
                 </li>
                 <?php
                 
                                 getbrands();   
                 ?>
                
            </ul>
            <!--sidenav for category-->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-warning ">
                    <a href="# "class="nav-link text-light"><h4>Category</h4></a>
                 </li>
                <?php
                 
                                 getcategories();
                 ?>
            </ul>
        </div>
        
    </div>
    
    
<!-- include footer-->
  <?php
  include("./includes/footer.php")
  ?>
   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>