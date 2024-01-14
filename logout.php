<?php
session_start();
session_destroy(); // ทำลาย session

// Redirect ไปยังหน้า Login
header('Location: login.php');
exit();
?>