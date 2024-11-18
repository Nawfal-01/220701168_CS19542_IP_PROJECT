document.addEventListener('DOMContentLoaded', () => {
    const monthSelect = document.getElementById('month-select');
    const transactionTableBody = document.querySelector('#transactionTable tbody');

    // Fetch transactions for the current month
    const loadTransactions = (month) => {
        fetch(`fetch_transactions.php?month=${month}`)
            .then(response => response.json())
            .then(transactions => {
                transactionTableBody.innerHTML = '';
                transactions.forEach(transaction => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${transaction.description}</td>
                        <td>RS. ${transaction.amount}</td>
                        <td>${transaction.type}</td>
                        <td>${transaction.created_at}</td>
                    `;
                    transactionTableBody.appendChild(row);
                });
            });
    };

    monthSelect.addEventListener('change', () => {
        const selectedMonth = monthSelect.value;
        loadTransactions(selectedMonth);
    });

    // Load transactions for the current month
    const currentMonth = new Date().toISOString().slice(0, 7); // YYYY-MM format
    monthSelect.value = currentMonth;
    loadTransactions(currentMonth);
});
