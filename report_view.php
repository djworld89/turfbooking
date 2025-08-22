<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Booking Report</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        padding: 20px;
    }

    h2 {
        text-align: center;
    }

    .download-box {
        max-width: 400px;
        margin: 40px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    input,
    .btn {
        padding: 10px;
        margin: 10px 0;
        width: 95%;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn {
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background: #0056b3;
    }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <h2>Booking Report CSV Download</h2>
    <div class="download-box">
        <form method="get" action="download_report.php">
            <label>From Date:</label>
            <input type="date" name="fromDate" required>

            <label>To Date:</label>
            <input type="date" name="toDate" required>

            <button type="submit" class="btn">📥 Download CSV</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>