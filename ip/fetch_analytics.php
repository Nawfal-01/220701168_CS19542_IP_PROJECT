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
$sql_income = "SELECT SUM(amount) AS income FROM transactions WHERE type='income' AND DATE_FORMAT(created_at, '%Y-%m') = '$month'";
$sql_expenses = "SELECT SUM(amount) AS expenses FROM transactions WHERE type='expense' AND DATE_FORMAT(created_at, '%Y-%m') = '$month'";

$result_income = $conn->query($sql_income)->fetch_assoc();
$result_expenses = $conn->query($sql_expenses)->fetch_assoc();

$income = $result_income['income'] ?? 0;
$expenses = $result_expenses['expenses'] ?? 0;

echo json_encode([
    'income' => $income,
    'expenses' => $expenses
]);

$conn->close();
?>
