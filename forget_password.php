<?php
include 'header.php';
echo '<h1>Forgot password</h1>';
include 'db.php';
include 'functions.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $random_string = md5(generateRandomString(10));
        $sql = "update users set `token` = '$random_string' where username = '$username'";
        $update_result = mysqli_query($conn, $sql);

        $message = "the reset link has been sent to your email address: ".$row['email'] . "<br>";
        $message .= "https://" . $_SERVER['SERVER_NAME'] . "/reset_password.php?token=$random_string";
    }        
}
?>

<form action="forget_password.php" method="post">

    <label for="username">username: </label>
    <input type="username" id="username" name="username" value="<?php if(array_key_exists('username',$_GET)) echo $_GET['username'];?>" required>

    <input type="submit" value="Reset"><br>

</form>

<?php
if(isset($message)){
    echo "<p>$message</p>";
}
include 'footer.php';
?>