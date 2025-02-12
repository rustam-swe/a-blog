<?php
require  '../models/db.php';

$fetchPosts = function() use ($db) {
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$post) die("Post not found!");
return $posts;
};

function createPost($title, $text, $user_id, $status) {
    global $db; // PDO obyektini olish

    $stmt = $db->prepare("INSERT INTO posts (title, text, user_id, status) VALUES (:title, :text, :user_id, :status)");
    $stmt->execute([
        'title' => $title,
        'text' => $text,
        'user_id' => $user_id,
        'status' => $status
    ]);

    header("Location: http://localhost:8000/index.php");
    exit;
};
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    // var_dump($_POST);
    delete($_POST['delete_id']);
}

function delete($id){
    global $db;

    // Postni faqat o‘zining egasi o‘chira olishi kerak
    $stmt = $db->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: http://localhost:8000/index.php");

    exit;

}



function edit($title, $text, $id, $status){
    global $db;

    $stmt = $db->prepare("UPDATE posts SET title = :title, text = :text, status = :status WHERE id = :id");
    $stmt->execute(['title' => $title, 'text' => $text, 'id' => $id,'status'=> $status]);
   
    header("Location: http://localhost:8000/index.php");
    exit();
}
