<?php
 
session_start();
$con = mysqli_connect("localhost", "root", "", "finalyearproject");
 
if (isset($_SESSION["user"]) && $_SESSION["user"]->is_verified)
{
 
    $user_id = $_SESSION["user"]->user_id;
 
    if (isset($_POST["toggle_tfa"]))
    {
        $is_tfa_enabled = $_POST["is_tfa_enabled"];
 
        $sql = "UPDATE user_table SET is_tfa_enabled = '$is_tfa_enabled' WHERE user_id = '$user_id'";
        mysqli_query($con, $sql);
 
        echo "<p>Settings changed</p>";
    }
 
    $sql = "SELECT * FROM user_table WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_object($result);
 
    ?>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 
     <!-- font awesome  link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <form method="POST" action="pin_page.php">
        <h1 class="text-center">Enable TFA</h1>
        <div class="text-center mt-4">
        <input type="radio" class="text-center" name="is_tfa_enabled" value="1" <?php echo $row->is_tfa_enabled ? "checked" : ""; ?>> Yes
        <input type="radio" class="text-center" name="is_tfa_enabled" value="0" <?php echo !$row->is_tfa_enabled ? "checked" : ""; ?>> No
        </div>
        <div class="text-center mt-4">
        <input type="submit" class="text-center" name="toggle_tfa">
        </div>
    </form>
  <div class="text-center mt-4">
    <a href="logout.php" >
        Logout
    </a>
 </div>
    <?php
}
else
{
    header("Location: login.php");
}