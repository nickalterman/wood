<?php
session_start();
include 'header.php';
include 'db.php';


$sql = "SELECT * FROM `posts` where post_id = " . $_GET['post_id'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

    <nav>
        <a href="index.php">index</a>
        <a href="/all_posts.php">All posts</a>
        <a href="/user_panel.php">User Panel</a>
    </nav>

    <main>
        <section>
            <h2><?php echo $row['title'];?></h2>
            <p><?php echo $row['content'];?></p>
        </section>
    </main>



<footer>
        <p>&copy; 2024 My Website</p>
</footer>
    </body>
</html>