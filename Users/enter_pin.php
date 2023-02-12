<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- font awesome  link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<form method="POST" action="enter_pin.php" class="form-label">
    <h1 class="text-center">Enter 6 digit OTP</h1>
    <div class="text-center mt-3">
        <input type="text" name="pin" placeholder="Enter pin code">
    </div>

    <div class="text-center mt-3">
        <input type="submit" name="enter_pin">
    </div>

</form>

<?php
session_start();

if (isset($_POST["enter_pin"])) {
    $pin = $_POST["pin"];
    $user_id = $_SESSION["user"]->user_id;

    $conn = mysqli_connect("localhost", "root", "", "finalyearproject");

    $sql = "SELECT * FROM user_table WHERE user_id = '$user_id' AND pin = '$pin'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE user_table SET pin = '' WHERE user_id = '$user_id'";
        mysqli_query($conn, $sql);

        $_SESSION["user"]->is_verified = true;
        header("Location: profile.php");
    } else {
        echo "<p>Wrong pin</p>";
    }
}
?>