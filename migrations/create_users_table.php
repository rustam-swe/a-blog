<?php

include __DIR__ . '/../db.php';



// Users Table
$query  = "CREATE TABLE users(";
$query .= "id INT AUTO_INCREMENT PRIMARY KEY,";
$query .= "name VARCHAR(64) NOT NULL,";
$query .= "email VARCHAR(128) NOT NULL,";
$query .= "password VARCHAR(255) NOT NULL)";

$stmt = $db->prepare($query);
$stmt->execute();

echo "Users table successfully created\n";
?>
