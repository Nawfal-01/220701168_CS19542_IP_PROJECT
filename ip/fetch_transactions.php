<?php
$host = 'localhost';
$db = 'finance_manager';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$sql = "SELECT description, amount, type, DATE_FORMAT(created_at, '%Y-%m-%d') AS created_at 
        FROM transactions WHERE DATE_FORMAT(created_at, '%Y-%m') = '$month'";

$result = $conn->query($sql);

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

echo json_encode($transactions);
$conn->close();
?>
