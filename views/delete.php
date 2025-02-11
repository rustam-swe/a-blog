<?php
include  '../models/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $db->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header("Location: http://localhost:8000/index.php");
?>
