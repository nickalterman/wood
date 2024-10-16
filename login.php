<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My weblog</title>
    <link rel="stylesheet" href="/statics/styles.css">
</head>

<body>
    
<h1>Login</h1>

<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        setcookie("is_logged", "true", time() + (7* 24 * 60 * 60), "/");
        setcookie("username", $row['username'], time() + (7* 24 * 60 * 60), "/");
        setcookie("user_id", $row['user_id'], time() + (7* 24 * 60 * 60), "/");
        header("Location: user_panel.php");
    } else {
    $error_message = "Invalid username or password. Please try again.";
    }
}
?>
<form action="login.php" method="post">
    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>
<?php if(!is_null($error_message)){
    echo "<p>$error_message</p>";
} ?>
</body>
<footer>
    <p>&copy; 2024 My Website</p>
</footer>
</html>