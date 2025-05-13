<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "salcc_shirts";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed."]));
}

$size = $_GET['size'] ?? '';
$color = $_GET['color'] ?? '';

if ($size && $color) {
    $stmt = $conn->prepare("SELECT quantity FROM shirts WHERE size = ? AND color = ?");
    $stmt->bind_param("ss", $size, $color);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode(["quantity" => $data ? $data['quantity'] : 0]);
} else {
    echo json_encode(["error" => "Missing parameters."]);
}
$conn->close();
?>