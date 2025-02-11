<?php
include  '../models/db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Post not found!");

$stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $status = $_POST['status'];

    $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text, status = :status WHERE id = :id");
    $stmt->execute(['title' => $title, 'text' => $text, 'id' => $id,'status'=> $status]);
   
    header("Location: http://localhost:8000/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit post</title>
</head>
<body>
    <h1>Edit post</h1>
    <form method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        <textarea name="text" required><?= htmlspecialchars($post['text']) ?></textarea><br>
        <select name="status">
            <option value="drafted">Drafted</option>
            <option value="published">Published</option>
        </select><br><br>
        <button type="submit">submit</button>
    </form>
</body>
</html>
