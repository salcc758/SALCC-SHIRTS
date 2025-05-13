<?php
session_start();
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === 'admin' && $password === 'password123') {
    $_SESSION['admin'] = true;
    header('Location: admin-panel.php');
} else {
    echo 'Invalid credentials. <a href="admin.html">Try again</a>.';
}
?>