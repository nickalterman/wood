<?php
include 'header.php';
echo '<h1>Forgot password</h1>';
include 'db.php';
include 'functions.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "update users set password = '$password' where username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if ($result === true) {

        $sql = "UPDATE users SET `token` = 'null' WHERE username = '$username'";
        $token_null = mysqli_query($conn, $sql);

        header("Location: login.php?msg=the new password has been set succssefully");
    }  
}


if(array_key_exists('token',$_GET)){
    $token = $_GET['token'];

    $sql = "select * from users where token = '$token'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $token_result = true;
    }
}
if(isset($token_result) === true){ ?>


<form action="reset_password.php" method="post">

    <label for="password">new Password: </label>
    <input type="password" id="password" name="password" required><br>
    <input type="hidden" id="username" name="username" value="<?php echo $row['username'];?>">

    <input type="submit" value="reset the password"><br>
</form>


<?php } else{
    echo 'the provided token is not valid or expired, <a href="/login.php"> go back</a>';
}

include 'footer.php';
?>