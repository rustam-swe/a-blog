<?php 

require '../controllers/post_controller.php';
session_start();

// Agar POST so‘rovi kelgan bo‘lsa, createPost() ni chaqiramiz
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title'], $_POST['text'], $_POST['status']) && isset($_SESSION['user']['id'])) {
        // var_dump($_POST['title']);
        createPost($_POST['title'], $_POST['text'], $_SESSION['user']['id'], $_POST['status']);
    }
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
    <form method="post" action="">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="text" placeholder="Text" required></textarea><br>
        <label for="status">Status: </label>
        <select name="status">
            <option value="drafted">Drafted</option>
            <option value="published">Published</option>
        </select><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
