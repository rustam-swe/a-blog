<?php

include __DIR__ . '/../db.php';

$stmt = $db->prepare('
    ALTER TABLE posts 
    ADD user_id INT NOT NULL, 
    ADD CONSTRAINT fk_posts_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
');
$stmt->execute();

$stmt = $db->prepare("
    ALTER TABLE posts 
    ADD status ENUM('published', 'drafted') NOT NULL DEFAULT 'drafted'
");
$stmt->execute();

echo "user_id va status ustunlari qo'shildi.";
