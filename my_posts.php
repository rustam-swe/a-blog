<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

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
    <style>
        .center{
            text-align:center;
        }
        .container{
            width: 85%;
            margin: auto;
        }
        .blog{
            border: 1px solid blue;
            margin: 20px;
            padding:20px;
        }
        .h3{
            color:green;
            text-decoration: none;
        }
        .add_post{
            text-decoration:none;
            color: white;
            background-color: blue;
            padding: 10px;
            border-radius: 10px;
            font-weight: 900;
        }
        .edit{
            text-decoration:none;
            color:black;
            background-color:yellow;
            padding:5px;
            border-radius:10px;
            font-weight:200;
        }
        .delete{
            text-decoration:none;
            color:black;
            background-color:red;
            padding:5px;
            border-radius:10px;
            font-weight:200;
        }
    </style>
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
