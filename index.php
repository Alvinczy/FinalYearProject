<!--<!DOCTYPE html>

To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

<html>
    <head>
        <meta charset="UTF-8">
        
            <style>
          
     .navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: powderblue;
  display: block;
  opacity: 1;
}

li {
  float: left;
  display: block;
  opacity: 1;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 200%;
  opacity: 1;
}
.search{
    margin-top:50px;
    display: block;
}

.dropdown {
  float: left;
  overflow: hidden;
  
}

.dropdown .dropbtn {
    
  font-size: 32px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
 background-color: powderblue;
  font-family: inherit;
  margin: 0;
  
}
 

  .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  
}

.dropdown-content a:hover {
  background-color: #ddd;
  
}

.dropdown:hover .dropdown-content {
  display: block;
  margin-top: 64px;
}
  
 
        </style>
 
        <title></title>
    </head>
    <body>   
       <table border="0" cellspacing="0" cellpadding="2">
             
           <div class="navbar">
             <ul>
                <li><img src="images/Vc_sport_no_bg.png" alt="logo" width="80" height="80"></li>
             <li><a href="home.php">[&nbsp;&nbsp;Home &nbsp;| </a></li>   
            
             <div class="dropdown">
             <li><button class="dropbtn">&nbsp;Products ▼&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| </a></li> 
             <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="Men.php">Men</a>
      <a href="Women.php">Women</a>
      <a href="SportA.php">Sport Accessories </a>
    </div>
  </div> 
           
             
             <li><a href="AboutUs.php">&nbsp;About Us&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] </a></li>  
             
           
              Admin Login Icon 
                <a style="float:right" href="admin_login.php" >
                <img src="images/admin.png" alt="Admin login" width="50" height="40"/>
                </a>
             
                 Login Icon 
                <a style="float:right" href="LogIn.php" >
                <img src="images/loginIcon.png" alt="login" width="40" height="40"/>
                </a>
                      
                 shopping cart Icon 
                
                <a style="float:right" href="shoppingCart.php" >
                <img src="images/shopIcon.png"  alt="shopping cart" width="40" height="40"/>
                </a>
   
              search function 
             <form action="" method="post">
              <div calss="search">
            <li style="float:right">
            <input type="text" name="search">
            <input type="submit" name="submit" value="Search">
            </form>
             
             </li>
             </div>
             </ul>         
        </nav>
        <div>
         </table>
         
      </body>
</html>
        <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="Password"><br> 

        <button type="submit">Login</button> <text>No account? click</text><a href="signup.php"> register</a>

     </form>
        
         
        

    
        <?php

        ?>
    </body>
</html>-->
