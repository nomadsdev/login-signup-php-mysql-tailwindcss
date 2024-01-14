<?php
session_start();

// ตรวจสอบว่ามี Session user_id หรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // ถ้าไม่มีให้ redirect ไปยังหน้า Login
    exit();
}

// ดักจับข้อมูลผู้ใช้จากฐานข้อมูล (ในที่นี้สมมติว่ามีฟิลด์ name)
$userId = $_SESSION['user_id'];
$dsn = 'mysql:host=localhost;dbname=login-signup_db';
$usernameDB = 'root';
$passwordDB = '';

try {
    $dbh = new PDO($dsn, $usernameDB, $passwordDB);
} catch (PDOException $e) {
    echo 'เกิดข้อผิดพลาด: ' . $e->getMessage();
}

$stmt = $dbh->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindParam(':id', $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <h1 class='text-3xl text-center p-10'>
        Welcome <span class='bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-transparent bg-clip-text'>Dashboard</span>
    </h1>

    <div class='flex justify-center'>
        <div>
            <h2 class='text-center text-rose-500'>Welcome : <span class='text-zinc-400'><?php echo $user['username']; ?>!</span></h2>
            <p class='text-rose-500 text-center'>ID : <span class='text-zinc-400'><?php echo $user['id']; ?></span></p>
        </div>
    </div>

    <div class='flex justify-center py-5'>
        <a href="logout.php" class='border border-red-500 rounded-xl px-10 py-1 text-red-500 hover:bg-red-500 hover:text-white transition'>Logout</a>
    </div>
</body>
</html>
