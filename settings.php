<?php
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = $_POST['user_id'];
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        $password_chnged = false;

        if ($password === ""){
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio' where `user_id` = " . intval($user_id);
        }
        else{
            
            $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio` = '$bio',`password` = $password  where `user_id` = " . intval($user_id);
            $password_chnged = true;
        }

        try {
            $result = mysqli_query($conn, $sql);
            if ($result === true) {
                if($password_chnged === true) header("Location: logout.php");
                else header("Location: settings.php");
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
            print($message);
        }
        exit;
    }

    try {
        $sql = "SELECT * FROM `users` WHERE user_id = " . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $user_information = mysqli_fetch_assoc($result);

        //print_r($user_information);

    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
?>
<body>
    <header>
        <h1>Welcome to My Website</h1>
    </header>

    <nav>
        <a href="user_panel.php">Panel</a>
        <a href="#">Write</a>
        <a href="#">Posts</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout (<?php echo $_SESSION['username']?>)</a>
    </nav>

    <main>
        <section>
            <h2>settings</h2>
            <p>This is a section of your website where you can introduce your content. Keep it clean and simple for a better user experience.</p>
        </section>
    </main>

    <main>
    <section>
    <img src="<?='/get_image.php?imgsrc=statics/images/' . md5($_SESSION['user_id']). '.png';?>" onerror="this.src='/ statics/images/user.png'" width="200" height="200"><img><br>
    <br>
    <input type="file" id="imageUpload" accept="image/*">
    <progress id="uploadProgress" max="100" value="0"></progress>
    <div id="message"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/statics/upload.js"></script><br>
    <br>

    <form action="" method="post">
    <input type="hidden" name="user_id" value="<?=$user_information['user_id'];?>"> <!-- Hidden field for user_id -->

    <label for="username">Username: </label>
    <input type="text" id="username" name="username" value="<?=$user_information['username'];?>" disabled><br><br>

    <label for="email">Email: </label>
    <input type="email" id="email" name="email" value="<?=$user_information['email'];?>" disabled><br><br>

    <label for="first_name">First Name: </label>
    <input type="text" id="first_name" name="first_name" value="<?=$user_information['first_name'];?>"><br><br>

    <label for="last_name">Last Name: </label>
    <input type="text" id="last_name" name="last_name" value="<?=$user_information['last_name'];?>"><br><br>

    <label for="bio">Bio: </label>
    <textarea id="bio" name="bio"><?=$user_information['bio'];?></textarea><br><br>

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" value=""><br><br>

    <input type="submit" value="Update Profile">

</form>

    </section>
    </main>

    <?php } else { ?>

        <p>redirecting to login page</P>
        <script>

            setTimeout(function () {
                window.location.href = '/login.php';

                document.body.innerHTML = '<p>redirecting to login page....</p>';
            }, 2000);

        </script>

    <?php } ?>

    <footer>
        <p>&copy; 2024 My Website</p>
    </footer>
</body>
</html>
