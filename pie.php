<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Collection vs Sports Played</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        font-family: "Segoe UI", Arial, sans-serif;
        margin: 0;
        padding: 15px;
        background: #f4f6f8;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .chart-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        padding: 15px;
        max-width: 900px;
        margin: auto;
    }

    .chart-wrapper {
        position: relative;
        width: 100%;
        height: 400px;
    }

    @media (max-width: 600px) {
        .chart-wrapper {
            height: 280px;
        }

        h2 {
            font-size: 1.2rem;
        }
    }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <br>
    <div class="chart-card">
        <div class="chart-wrapper">
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <?php include 'footer.php' ?>

    <script>
    async function loadChartData() {
        const response = await fetch("get_bar.php");
        const data = await response.json();

        const chartData = {
            labels: data.labels,
            datasets: [{
                    label: "Total Sports Played",
                    data: data.sportsPlayed,
                    backgroundColor: "rgba(54, 162, 235, 0.7)",
                    borderRadius: 6,
                    yAxisID: 'y1'
                },
                {
                    label: "Total Collection (₹)",
                    data: data.collections,
                    backgroundColor: "rgba(75, 192, 192, 0.7)",
                    borderRadius: 6,
                    yAxisID: 'y2'
                }
            ]
        };

        const config = {
            type: "bar",
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "top"
                    },
                    title: {
                        display: true,
                        text: "Sports Wise Collection"
                    }
                },
                scales: {
                    y1: {
                        beginAtZero: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: "Sports Played"
                        },
                        ticks: {
                            stepSize: 1, // adjust depending on your data
                            precision: 0 // force whole numbers (no decimals)
                        }
                    },
                    y2: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: "Collection (₹)"
                        },
                        ticks: {
                            stepSize: 500, // adjust depending on your data
                            precision: 0 // force whole numbers (no decimals)
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById("barChart"), config);
    }

    loadChartData();
    </script>

</body>

</html>