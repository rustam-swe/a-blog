<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=personal_blog", "root", "root1223");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Xatolik: " . $e->getMessage());
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Bu email allaqachon ro‘yxatdan o‘tgan!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);

        $_SESSION['success'] = "Ro‘yxatdan muvaffaqiyatli o‘tdingiz!";
        header("Location: login.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="name" placeholder="Name:" required> <br>
        <input type="email" name="email" placeholder="Email: " required> <br>
        <input type="password" name="password" placeholder="Password: " required> <br>
        <button type="submit">Submit</button>
    </form>
    <a href="login.php">Kirish</a>
</body>
</html>
