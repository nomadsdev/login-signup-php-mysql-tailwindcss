<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); // ถ้ามีให้ redirect ไปยังหน้า Dashboard
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เชื่อมต่อฐานข้อมูล
    $dsn = 'mysql:host=localhost;dbname=login-signup_db';
    $usernameDB = 'root';
    $passwordDB = '';

    try {
        $dbh = new PDO($dsn, $usernameDB, $passwordDB);
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $stmt = $dbh->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // รหัสผ่านถูกต้อง
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php'); // ไปที่หน้า dashboard
    } else {
        // รหัสผ่านไม่ถูกต้อง
        echo 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <h2 class='p-10 text-3xl text-center text-rose-500'>Login</h2>
    <form method="post" action="login.php">
        <div class='flex justify-center'>
            <div>
                <label for="username" class='text-rose-500'>Username :</label>
                <input type="text" id="username" name="username" required class='border border-rose-500 rounded-md'>
                <br>
                <br>
                <label for="password" class='text-rose-500'>Password :</label>
                <input type="password" id="password" name="password" required class='border border-rose-500 rounded-md'>
                <br>
            </div>
        </div>
        <div class='flex justify-center py-5'>
            <button type="submit" class='border border-rose-500 rounded-xl px-10 py-2 text-rose-500 hover:bg-rose-500 hover:text-white transition'>Login</button>
        </div>
    </form>
    <div class='flex justify-center'>
        <p class='text-zinc-400'>Don't have an account yet? <a href="./signup.php" class='text-rose-400'>SignUp</a></p>
    </div>
</body>
</html>
