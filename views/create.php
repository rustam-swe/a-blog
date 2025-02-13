<?php 

require '../controllers/post_controller.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title'], $_POST['text'], $_POST['status']) && isset($_SESSION['user']['id'])) {
        createPost($_POST['title'], $_POST['text'], $_SESSION['user']['id'], $_POST['status']);
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new post</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>

    <div class="container">
        <h1>Add new post</h1>
        <form method="post">
            <input type="text" name="title" placeholder="Sarlavha" required>
            <textarea name="text" placeholder="Post matni" required></textarea>
            <label for="status">Status:</label>
            <select name="status">
                <option value="drafted">Drafted</option>
                <option value="published">Published</option>
            </select>
            <button type="submit">Send</button>
        </form>
        <a href="../index.php" class="back-btn">Return to homepage</a>
    </div>

</body>
</html>
