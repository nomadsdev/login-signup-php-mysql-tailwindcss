<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <div>
        <h1 class='text-center text-3xl p-10'>
            Login & <span class='bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-transparent bg-clip-text'>SignUp</span>
        </h1>
    </div>
    
    <div class='flex justify-center'>
        <a href="./login.php" class='bg-rose-400 rounded-xl px-5 py-2 text-white shadow-md mx-2 hover:bg-rose-500 transition'>
            Login
        </a>
        <a href="./signup.php" class='bg-sky-400 rounded-xl px-5 py-2 text-white shadow-md mx-2 hover:bg-sky-500 transition'>
            SignUp
        </a>
    </div>

</body>
</html>