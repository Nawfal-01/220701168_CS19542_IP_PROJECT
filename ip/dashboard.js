document.addEventListener('DOMContentLoaded', () => {
    const totalIncomeEl = document.getElementById('total-income');
    const totalExpensesEl = document.getElementById('total-expenses');
    const balanceEl = document.getElementById('balance');

    // Fetch summary from PHP
    fetch('get_summary.php')
        .then(response => response.json())
        .then(data => {
            totalIncomeEl.textContent = `RS. ${data.totalIncome}`;
            totalExpensesEl.textContent = `RS. ${data.totalExpenses}`;
            balanceEl.textContent = `RS. ${data.balance}`;
        });
});
