<?php
session_start();

include  '../models/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $user_id = $_SESSION['user']['id'];
    $status = $_POST['status'];

    // var_dump($status);
    $stmt = $db->prepare("INSERT INTO posts (title, text,user_id,status) VALUES (:title, :text, :user_id, :status)");
    $stmt->execute(['title' => $title, 'text' => $text, 'user_id'=> $user_id,'status'=>$status]);

    header("Location: http://localhost:8000/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new post</title>
</head>
<body>
    <h1>Add new post</h1>
    <form method="post">
        <input type="text" name="title" placeholder="title" required><br>
        <textarea name="text" placeholder="text" required></textarea><br>
        <label for="status">status: </label>
        <select name="status">
            <option value="drafted">Drafted</option>
            <option value="published">Published</option>
        </select><br><br>
        <button type="submit">submit</button>
    </form>
</body>
</html>
