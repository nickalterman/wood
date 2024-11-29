<?php
session_start();
include 'header.php';
include 'db.php';
if (isset($_SESSION['is_logged']) === true) {


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_id = $_SESSION['user_id'];
        $category_id = $_POST['category'];

        try {
            $sql = "INSERT INTO `posts` (title  , content, author_id, category_id) value ('$title', '$content', '$author_id', '$category_id')";
            $result = mysqli_query($conn, $sql);

            if ($result === true) {
                header("Location: my_posts.php?msg=YOUr post published succssefuly");
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            $message = $e->getMessage();
        }
    }


    $sql = "SELECT * FROM categories";
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
            <h2>write a blog post</h2>
        </section>

        <form action="" method="post">
            <label for="title">title:</label>
            <input type="text" id="title" name="title" value="" placeholder="title"><br><br>

            <label for="content">content: </label>
            <textarea id="content" name="content" placeholder="hi, ..."></textarea><br><br>

            <select name="category" id="category">
                <?php
                foreach($rows as $row){
                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                }
                ?>
            </select>

            <input type="submit" value="post">
        </form>

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
