document.addEventListener('DOMContentLoaded', () => {
    const monthSelect = document.getElementById('month-select');
    const ctx = document.getElementById('transactionChart').getContext('2d');
    let chart;

    const loadAnalytics = (month) => {
        fetch(`fetch_analytics.php?month=${month}`)
            .then(response => response.json())
            .then(data => {
                const income = data.income || 0;
                const expenses = data.expenses || 0;

                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Income', 'Expenses'],
                        datasets: [{
                            data: [income, expenses],
                            backgroundColor: ['#28a745', '#dc3545']
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false // Prevents maintaining aspect ratio
                    }
                });
            });
    };

    monthSelect.addEventListener('change', () => {
        const selectedMonth = monthSelect.value;
        loadAnalytics(selectedMonth);
    });

    const currentMonth = new Date().toISOString().slice(0, 7); // YYYY-MM format
    monthSelect.value = currentMonth;
    loadAnalytics(currentMonth);
});
