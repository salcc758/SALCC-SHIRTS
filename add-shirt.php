<?php
session_start();
if (!isset($_SESSION['admin'])) {
    die("Unauthorized");
}

$size     = $_POST['size']     ?? '';
$color    = $_POST['color']    ?? '';
$quantity = $_POST['quantity'] ?? '';

if ($size && $color && is_numeric($quantity)) {
    $conn = new mysqli("localhost", "root", "", "salcc_shirts");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO shirts (size, color, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $size, $color, $quantity);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header("Location: admin-panel.php");
?>