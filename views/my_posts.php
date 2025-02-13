<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include  '../models/db.php';

$user_id = $_SESSION['user']['id'];

$stmt = $db->query("SELECT * 
        FROM posts 
        WHERE user_id = $user_id
        ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Personal Blog</title>
    <link rel="stylesheet" href="../css/my_posts.css">
</head>
<body>
    <h1 class="center">Personal Blog</h1>
    <div class="container">
        <a class="add_post" href="create.php">Add new post</a>
        
        <?php foreach ($posts as $post): ?>
            <div class="blog">
        <h3>
            <a class="h3" href="post.php?id=<?= $post['id'] ?>">
                <?= htmlspecialchars($post['title']) ?>
            </a>
        </h3>
        <span><?=$post['status']?></span> <br>
        <span><?=$post['created_at']?></span>
        <span><i><?=$post['updated_at']?></i></span>
        <p><?= nl2br(htmlspecialchars(substr($post['text'], 0, 100))) ?>...</p>
        <?php if($_SESSION['user']['id'] == $post['user_id']){ ?>
        <a class="edit" href="edit.php?id=<?= $post['id'] ?>">edit</a>
        <a class="delete" href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Do you want to delete?')">delete</a>
        <?php };?>
        </div>

    <?php endforeach; ?>
        
    </div>
</body>
</html>
