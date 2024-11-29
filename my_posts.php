<?php
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {

    $sql = "SELECT * FROM posts where author_id	= " . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
?>
<body>
    <header>
        <h1>Welcome to My Website</h1>
    </header>

    <nav>
        <a href="index.php">Main</a>
        <a href="user_panel.php">Panel</a>
        <a href="write_post.php">Write</a>
        <a href="my_posts.php">Posts</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout (<?php echo $_SESSION['username']?>)</a>
    </nav>
    <main>
        <section>
            <h2>my blog posts</h2>
        </section>

        <?php
            foreach($rows as $row){
                echo '- ',$row[1],', published in: ', $row[5], ' | <a href="/view_post.php?post_id=' . $row[0] . '"> view</a>',' <a href="/edit_post.php?post_id=' . $row[0] . '"> edit</a> <a href="/delete_post.php?post_id=' . $row[0] . '"> delete</a><br>';
            }

            echo "<br>";

            if(array_key_exists('msg', $_GET)){
                $message = $_GET['msg'];
            }
            if(isset($message)){
                echo "<p>$message</p>";
            }
        ?>
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
