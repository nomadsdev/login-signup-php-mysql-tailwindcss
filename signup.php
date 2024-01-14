<?php

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); // ถ้ามีให้ redirect ไปยังหน้า Dashboard
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    // เชื่อมต่อฐานข้อมูล
    $dsn = 'mysql:host=localhost;dbname=login-signup_db';
    $usernameDB = 'root';
    $passwordDB = '';

    try {
        $dbh = new PDO($dsn, $usernameDB, $passwordDB);
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }

    // เพิ่มผู้ใช้ใหม่ในฐานข้อมูล
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $dbh->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    $stmt->bindParam(':username', $newUsername);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo 'ลงทะเบียนสำเร็จ';
    } else {
        echo 'มีข้อผิดพลาดในการลงทะเบียน';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
    <h2 class='p-10 text-3xl text-center text-sky-500'>Signup</h2>
    <form method="post" action="signup.php">
        <div class='flex justify-center'>
            <div>
                <label for="newUsername" class='text-sky-500'>Username :</label>
                <input type="text" id="newUsername" name="newUsername" required class='border border-sky-500 rounded-md'>
                <br>
                <br>
                <label for="newPassword" class='text-sky-500'>Password :</label>
                <input type="password" id="newPassword" name="newPassword" required class='border border-sky-500 rounded-md'>
                <br>
            </div>
        </div>
        <div class='flex justify-center py-5'>
            <button type="submit" class='border border-sky-500 rounded-xl px-10 py-2 text-sky-500 hover:bg-sky-500 hover:text-white transition'>Signup</button>
        </div>
    </form>
    <div class='flex justify-center'>
        <p class='text-zinc-400'>Don't have an account yet? <a href="./login.php" class='text-sky-400'>SignUp</a></p>
    </div>
</body>
</html>