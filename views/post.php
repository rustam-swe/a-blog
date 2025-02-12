<?php
require "../controllers/post_controller.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
<?php
$posts = fetchposts();
foreach($posts as $post){ ?>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($post['text'])) ?></p>
    <div><?=$post['created_at']?></div>
    <a href="index.php">Return to homepage</a>
<?php } ?>
</body>
</html>
