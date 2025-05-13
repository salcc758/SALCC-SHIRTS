<?php
session_start();
if (!isset($_SESSION['admin'])) {
    die("Unauthorized");
}

$id = $_POST['id'] ?? '';
$quantity = $_POST['quantity'] ?? '';

$conn = new mysqli("localhost", "root", "", "salcc_shirts");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE shirts SET quantity = ? WHERE id = ?");
$stmt->bind_param("ii", $quantity, $id);
$stmt->execute();

header("Location: admin-panel.php");
?>