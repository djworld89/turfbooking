<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Turf Booking Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 20px;
        font-family: 'Roboto', sans-serif;
        background: url(turf.main.avif) no-repeat scroll center 0 / cover;
    }

    .dashboard {
        max-width: 1000px;
        margin: auto;
        background: lightyellow;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .dashboard h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .card {
        background: #f7f9fc;
        flex: 1 1 45%;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        margin: 0;
        font-size: 20px;
        color: #555;
    }

    .card p {
        margin-top: 10px;
        font-size: 26px;
        font-weight: bold;
        color: #2c3e50;
    }

    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }

    .filters input[type="date"] {
        padding: 10px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        min-width: 160px;
    }

    .filters button {
        background: #2980b9;
        color: white;
        padding: 10px 20px;
        font-size: 15px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .filters button:hover {
        background: #1f6696;
    }

    @media (max-width: 600px) {
        .card {
            flex: 1 1 100%;
        }
    }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <br>
    <div class="dashboard">
        <h2>📊 Dashboard</h2>

        <div class="filters">
            <input type="date" value="<?= date('Y-m-d') ?>" id="fromDate">
            <input type="date" value="<?= date('Y-m-d') ?>" id="toDate">
            <button onclick="applyFilter()">Apply Filter</button>
        </div>
        <br>

        <div class="cards">
            <div class="card">
                <h3>Total Sports</h3>
                <b>
                    <p id="totalSports">5</p>
                </b>
            </div>
            <div class="card">
                <h3>Total Collection</h3>
                <b>
                    <p id="totalAmount">₹8,750</p>
                </b>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <script>
    function applyFilter() {
        const from = document.getElementById("fromDate").value;
        const to = document.getElementById("toDate").value;

        if (!from || !to) {
            alert("Please select both dates.");
            return;
        }

        if (from > to) {
            alert("❌ 'From Date' cannot be after 'To Date'.");
            return;
        }

        // Mock: Replace with real AJAX call

        fetch(`get_stats.php?from=${from}&to=${to}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById("totalSports").textContent = data.total_sports;
                document.getElementById("totalAmount").textContent = "₹" + data.total_amount;
            });

    }
    applyFilter();
    </script>
</body>

</html>