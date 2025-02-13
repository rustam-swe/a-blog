<?php
include './models/db.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: views/login.php");
    exit;
}

$stmt = $db->query("SELECT * FROM posts WHERE status = 'published' ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1 class="center">Personal Blog</h1>
    <div class="container">
        <div class="links">
            <a class="add_post" href="views/create.php">Add new post</a>
            <a class="add_post" href="views/my_posts.php">My posts</a>
            <a class="add_post" href="views/logout.php">Exit</a>
        </div>

        <?php foreach ($posts as $post): ?>
            <div class="blog">
                <h3>
                    <a class="h3" href="views/post.php?id=<?= $post['id'] ?>">
                        <?= htmlspecialchars($post['title']) ?>
                    </a>
                </h3>
                <span><?= $post['created_at'] ?></span>
                <span><i><?= $post['updated_at'] ?></i></span>
                <p><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
                
                <?php if ($_SESSION['user']['id'] == $post['user_id']): ?>
                    <a class="edit" href="views/edit.php?id=<?= $post['id'] ?>">edit</a>
                    <form method="post" action="controllers/post_controller.php" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= $post['id'] ?>">
                        <button class="delete" type="submit" onclick="return confirm('Do you want to delete?')">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
