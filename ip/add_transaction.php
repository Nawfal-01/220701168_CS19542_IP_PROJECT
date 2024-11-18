<?php
$host = 'localhost';
$db = 'finance_manager';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("INSERT INTO transactions (description, amount, type, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sds", $description, $amount, $type);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
header('Location: dashboard.html');
?>
