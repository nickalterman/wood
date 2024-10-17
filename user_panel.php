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
        <a href="#">Panel</a>
        <a href="#">Write</a>
        <a href="#">Posts</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout (<?php echo $_SESSION['username']?>)</a>
    </nav>

    <main>
        <section>
            <h2>Main Section Title</h2>
            <p>This is a section of your website where you can introduce your content. Keep it clean and simple for a better user experience.</p>
        </section>

        <section>
            <h2>Another Section</h2>
            <p>Feel free to customize the layout, colors, and content to fit the purpose of your site. This template is fully responsive and adapts to different screen sizes.</p>
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
