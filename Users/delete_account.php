<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Account</title>
    </head>
    <body>
        <h3 class="text-center text-danger mb-4">Delete Account</h3>
        <form action="" method="post" class="mt-5">
            <div class="form-outline mb-4">
                <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
            </div>
            <div class="form-outline mb-4">
                <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete Account">
            </div>

        </form>
        <?php
        // put your code here
        $username_session = $_SESSION['username'];
        if (isset($_POST['delete'])) {
//            $delete_query="Delete from `user_table` where username='$username_session'";
//            $result= mysqli_query($con, $delete_query);
            $sql = "Delete from `user_table` where username= ? "; // SQL with parameters
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $username_session);
            $stmt->execute();
            

            
                session_destroy();
                echo"<script>alert('Account Deleted Successfully')</script>";
                echo "<script>window.open('../Home.php','_self')</script>";
            
        }

        if (isset($_POST['dont_delete'])) {

            echo "<script>window.open('profile.php','_self')</script>";
        }
        ?>
    </body>
</html>
