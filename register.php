<?php
include 'header.php';
echo '<h1>registration</h1>';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    try {
        $sql = "INSERT INTO `users` (username, email, password) value ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result === true) {
            header("Location: login.php?msg=YOU have registered successfully, please login");
        }
    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
        
}
?>

<form action="register.php" method="post">

    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="email">email: </label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Register"><br>
    <a href='login.php'>already have an account? click here</a>
</form>

<?php
if(isset($message)){
    echo "<p>$message</p>";
}
include 'footer.php';
?>