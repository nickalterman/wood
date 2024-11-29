<?php
session_start();
include 'header.php';
include 'db.php';

function auther_id_to_name($conn, $id){
    $result = mysqli_query($conn, "SELECT * FROM `users` where `user_id` = " . $id);
    $author = mysqli_fetch_assoc($result);
    return $author['username'];
}
function category_id_to_name($conn, $id){
    $result = mysqli_query($conn, "SELECT * FROM `categories` where `category_id` = " . $id);
    $author = mysqli_fetch_assoc($result);
    return $author['category_name'];
}


if (array_key_exists('author_id', $_GET)){
    $sql = "SELECT * FROM `posts` where author_id = " . $_GET['author_id'];
} else {
    $sql = "SELECT * FROM `posts`";
}

$result = mysqli_query($conn, $sql);

$row = array();

while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
}
?>

    <nav>
        <a href="index.php">index</a>
        <a href="/all_posts.php">All posts</a>
        <a href="/user_panel.php">User Panel</a>
    </nav>

    <main>
        <section>
            <h2>All posts</h2>
            <?php foreach($rows as $row) { ?>
            <p>- <a href="/show.php?post_id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a>, published in <?php echo $row['publication_date']; ?> in <b> <?php echo category_id_to_name($conn, $row['category_id']) ?> </b> by <a href="all_posts.php?author_id=<?php echo $row['author_id'];?>"> <?php echo auther_id_to_name($conn, $row['author_id']);?></a></p>
            <?php } ?>
        </section>
    </main>



<footer>
        <p>&copy; 2024 My Website</p>
</footer>
    </body>
</html>