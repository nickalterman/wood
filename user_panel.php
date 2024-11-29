<?php
session_start();
include 'header.php';
if (isset($_SESSION['is_logged']) === true) {
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
            <h2>welcome to panel</h2>
            <p>hello <?php echo $_SESSION['username'] ?></p>
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
