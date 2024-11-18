<?php
$host = 'localhost';
$db = 'finance_manager';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$sql_income = "SELECT SUM(amount) AS totalIncome FROM transactions WHERE type='income'";
$sql_expenses = "SELECT SUM(amount) AS totalExpenses FROM transactions WHERE type='expense'";

$result_income = $conn->query($sql_income)->fetch_assoc();
$result_expenses = $conn->query($sql_expenses)->fetch_assoc();

$totalIncome = $result_income['totalIncome'] ?? 0;
$totalExpenses = $result_expenses['totalExpenses'] ?? 0;
$balance = $totalIncome - $totalExpenses;

echo json_encode([
    'totalIncome' => number_format($totalIncome, 2),
    'totalExpenses' => number_format($totalExpenses, 2),
    'balance' => number_format($balance, 2)
]);

$conn->close();
?>
