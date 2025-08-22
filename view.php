<?php
include('db.php');
if (!isset($_GET['bookid'])) {
    echo "Booking ID missing.";
    exit;
}

$booking_id = $_GET['bookid'];
$sql = "SELECT * FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No booking found.";
    exit;
}
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background: url(turf.main.avif) no-repeat scroll center 0 / cover;
        margin: 0;
        padding: 20px;
        text-align: -webkit-center;
        justify-content: center;
    }

    .booking-card {
        background-color: lightyellow;
        padding: 30px 25px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        max-width: 500px;
        width: 100%;
    }

    .booking-card h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #2c3e50;
    }

    .booking-field {
        margin-bottom: 15px;
    }

    .booking-label {
        font-weight: bold;
        color: #34495e;
        display: block;
        margin-bottom: 5px;
    }

    .booking-value {
        color: #2d3436;
        font-size: 16px;
        background: #ecf0f1;
        padding: 10px 12px;
        border-radius: 8px;
    }

    @media (max-width: 600px) {
        .booking-card {
            padding: 0px;
        }

        h2 {
            background: lightblue;
            padding: inherit;
        }

        .booking-card h2 {
            font-size: 20px;
        }

        .booking-value {
            font-size: 15px;
        }
    }
    </style>
</head>


<body>
    <?php include 'header.php' ?>
    <h2>📄 View Turf Booking</h2>
    <div class="booking-card">


        <div class="booking-field">
            <label class="booking-label">Booking ID</label>
            <div class="booking-value"><?= $row['booking_id'] ?></div>
        </div>
        <div class=" booking-field">
            <label class="booking-label">Name</label>
            <div class="booking-value"><?= $row['name'] ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">Mobile No</label>
            <div class="booking-value"><?= $row['mobile'] ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">Email ID</label>
            <div class="booking-value"><?= $row['email'] ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">Sports Type</label>
            <div class="booking-value"><?= $row['sport'] ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">Amount</label>
            <div class="booking-value">₹<?= $row['amount'] ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">Payment Status</label>
            <div class="booking-value" style="color: green;"><?= $row['paymentStatus'] ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">From Date & Time</label>
            <div class="booking-value"><?= date('Y-m-d\TH:i', strtotime($row['fromDateTime'])) ?></div>
        </div>

        <div class=" booking-field">
            <label class="booking-label">To Date & Time</label>
            <div class="booking-value"><?= date('Y-m-d\TH:i', strtotime($row['toDateTime'])) ?></div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>