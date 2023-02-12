<?php 
include('../includes/connect.php');
include('../function/common_function.php');
session_start();
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
        <title>Admin Dashboard</title>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- css file -->
<link rel="stylesheet" href="../style.css">
     <!-- font awesome  link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
      .admin_image{
    width: 100px;
    object-fit:contain;
}  

.footer{
    position:absolute;
    bottom:0;
}
body{
    overflow-x: hidden;
}
.product_img{
    width: 100px;
    object-fit: contain;
     
}
      
  </style>
    
    </head>
    
    <body>
        <!--navbar-->
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
                <div class="container-fluid">
                    <img src="../images/admin.png" alt="" class="logo">
                    
                    <nav class="navbar navbar-expand-lg p-1 ">
                        <ul class="navbar-nav ">
                            <?php
          if(!isset($_SESSION['admin_name'])){
              echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li> ";
          }else{
              echo "<li class='nav-item'>
               <a class='nav-link' href='#'>Welcome ".$_SESSION['admin_name']." </a>
           </li>";
          }
          
          if(!isset($_SESSION['admin_name'])){
              echo"<li class='nav-item'>
               <a class='nav-link' href='./admin_login.php'>Login</a>
           </li>";
          }else{
              echo"<li class='nav-item'>
               <a class='nav-link' href='./Users/logout.php'>Logout</a>
           </li>";
          }
          
          ?>
                        </ul>
                        
                    </nav>
                </div>  
            </nav>
            
            
            <!--second child-->
            <div classs="bg-light">
                <h3 class="text-center p-2">Admin Manage</h3>
            </div>
        </div>
        
          <!--third child-->
          <div class="row">
              <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                  <div class=" p-3">
                      <a href="#"><img src="../images/AdminAvatar.jpg" alt="" class="admin_image"></a>
                          <p class="text-light text-center">Admin Name</p>  
                  </div>
                  
                  
                  
                  <div class="button text-center m-auto ">
                      <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Product</a></button>
                      
                      <button><a href="Admin_panel.php?view_products" class="nav-link text-light bg-info my-1">View Product</a></button>
                      <button><a href="Admin_panel.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                         <button><a href="Admin_panel.php?view_categories" class="nav-link text-light bg-info my-1">View Categories</a></button>
                          <button><a href="Admin_panel.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                           <button><a href="Admin_panel.php?view_brands" class="nav-link text-light bg-info my-1">View Brands</a></button>
                            <button><a href="Admin_panel.php?list_orders" class="nav-link text-light bg-info my-1">All Orders</a></button>
                             <button><a href="Admin_panel.php?list_payments" class="nav-link text-light bg-info my-1">All payment</a></button>
                              <button><a href="Admin_panel.php?list_users" class="nav-link text-light bg-info my-1">List Users</a></button>
                               <button><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
                  </div>
              </div>
          </div>
          
         <!-- fourth child-->
         <div class="container my-5">            
        <?php
       if(isset($_GET['insert_category'])){
           include('insert_categories.php');
       }
        if(isset($_GET['insert_brand'])){
           include('insert_brands.php');
       }
       if(isset($_GET['view_products'])){
           include('view_products.php');
       }
       if(isset($_GET['edit_products'])){
           include('edit_products.php');
       }
       if(isset($_GET['delete_product'])){
           include('delete_product.php');
       }
        if(isset($_GET['view_categories'])){
           include('view_categories.php');
       }
       if(isset($_GET['view_brands'])){
           include('view_brands.php');
       }
        if(isset($_GET['edit_category'])){
           include('edit_category.php');
       }
       if(isset($_GET['edit_brands'])){
           include('edit_brands.php');
       }
        if(isset($_GET['delete_category'])){
           include('delete_category.php');
       }
       if(isset($_GET['delete_brands'])){
           include('delete_brands.php');
       }
       if(isset($_GET['list_orders'])){
           include('list_orders.php');
       }
       if(isset($_GET['list_payments'])){
           include('list_payments.php');
       }
       if(isset($_GET['list_users'])){
           include('list_users.php');
       }
       
        ?>  
         </div>
         
        <?php
  include("../includes/footer.php")
  ?>
    </div>
          <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
