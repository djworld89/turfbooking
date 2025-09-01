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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $uid = $_SESSION['user_id'];
    $id = $booking_id;
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $sport = $_POST['sport'];
    $amount = $_POST['amount'];
    $status = $_POST['paymentStatus'];
    $from = $_POST['fromDateTime'];
    $to = $_POST['toDateTime'];
    $remark = $_POST['remark'];
    $sql = "SELECT COUNT(*) AS cnt
FROM bookings
WHERE user_id=$uid and id !=$id and ((fromDateTime BETWEEN ? AND ? ) || (toDateTime BETWEEN ? AND ?))";
    $stmt1 = $conn->prepare($sql);
    $stmt1->bind_param("ssss", $from, $to, $from, $to);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $data = $result->fetch_assoc();
    if ($data['cnt'] > 0) {
        header("Location: error.php");
        $stmt1->close();
    } else {
        $sql = "UPDATE bookings SET 
          name = ?, mobile = ?, email = ?, sport = ?, amount = ?, 
          paymentStatus = ?, fromDateTime = ?, toDateTime = ?, remark= ?
          WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssdssssi", $name, $mobile, $email, $sport, $amount, $status, $from, $to, $remark, $id);

        if ($stmt->execute()) {
            echo "✅ Booking updated successfully!<br>";
            header("Location: list.php");
        } else {
            echo "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Booking Turf</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url(turf.main.avif) no-repeat scroll center 0 / cover;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .booking-form {
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            background-color: lightyellow;
            margin: 0 auto;
            width: 65%;
        }

        .booking-form h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2e3c50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            margin-bottom: 5px;
            color: darkblue;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            background: #4a90e2;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #357ab7;
        }

        input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <br>

    <form class="booking-form" id="turfBookingForm" method="POST">

        <h2>Update</h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= $row['name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="mobile">Mobile No</label>
            <input type="tel" id="mobile" name="mobile" value="<?= $row['mobile'] ?>" required pattern="[0-9]{10}">
        </div>

        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="email" id="email" name="email" value="<?= $row['email'] ?>">
        </div>

        <div class="form-group">
            <label for="sport">Sports Type</label>
            <select id="sport" name="sport" required>
                <option value="">Select</option>
                <option value="cricket" <?= ($row['sport'] == "cricket") ? "selected" : "" ?>>Cricket</option>
                <option value="football" <?= ($row['sport'] == "football") ? "selected" : "" ?>>Football</option>
                <option value="badminton" <?= ($row['sport'] == "badminton") ? "selected" : "" ?>>Badminton</option>
                <option value="tennis" <?= ($row['sport'] == "tennis") ? "selected" : "" ?>>Tennis</option>
                <option value="basketball" <?= ($row['sport'] == "basketball") ? "selected" : "" ?>>Basketball</option>
                <option value="hockey" <?= ($row['sport'] == "hockey") ? "selected" : "" ?>>Hockey</option>
                <option value="volleyball" <?= ($row['sport'] == "volleyball") ? "selected" : "" ?>>Volleyball</option>
                <option value="handball" <?= ($row['sport'] == "handball") ? "selected" : "" ?>>Handball</option>
                <option value="kabaddi" <?= ($row['sport'] == "kabaddi") ? "selected" : "" ?>>Kabaddi</option>
                <option value="rugby" <?= ($row['sport'] == "rugby") ? "selected" : "" ?>>Rugby</option>
                <option value="throwball" <?= ($row['sport'] == "throwball") ? "selected" : "" ?>>Throwball</option>
                <option value="frisbee" <?= ($row['sport'] == "frisbee") ? "selected" : "" ?>>Frisbee</option>
                <option value="TT" <?= ($row['sport'] == "TT") ? "selected" : "" ?>>TT</option>
                <option value="Pickle Ball" <?= ($row['sport'] == "Pickle Ball") ? "selected" : "" ?>>Frisbee</option>
                <option value="Others" <?= ($row['sport'] == "Others") ? "selected" : "" ?>>Frisbee</option>

            </select>
        </div>
        <div class="form-group">
            <label for="fromDateTime">From Date & Time</label>
            <input type="datetime-local" id="fromDateTime" name="fromDateTime"
                value="<?= date('Y-m-d\TH:i', strtotime($row['fromDateTime'])) ?>" required>
        </div>

        <div class="form-group">
            <label for="toDateTime">To Date & Time</label>
            <input type="datetime-local" id="toDateTime" name="toDateTime"
                value="<?= date('Y-m-d\TH:i', strtotime($row['toDateTime'])) ?>" required>
            <div class="error" id="dateError"></div>
        </div>

        <div class="form-group">
            <label for="amount">Amount (₹)</label>
            <input type="number" id="amount" name="amount" value="<?= $row['amount'] ?>" required>
        </div>

        <div class="form-group">
            <label for="paymentStatus">Payment Status</label>
            <select id="paymentStatus" name="paymentStatus" required>
                <option value="Pending" <?= $row['paymentStatus'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Paid" <?= $row['paymentStatus'] == 'Paid' ? 'selected' : '' ?>>Paid</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Remark</label>
            <input type="text" id="remark" name="remark" value="<?= $row['remark'] ?>">
        </div>

        <button class="submit-btn" type="submit">Submit Booking</button>
    </form>

    <script>
        const fromInput = document.getElementById("fromDateTime");
        const toInput = document.getElementById("toDateTime");
        const errorDiv = document.getElementById("dateError");

        function validateDateTime() {
            const fromDate = new Date(fromInput.value);
            const toDate = new Date(toInput.value);

            if (toInput.value && fromInput.value && toDate <= fromDate) {
                errorDiv.textContent = "❌ 'To Date & Time' must be later than 'From Date & Time'.";
                submitBtn.disabled = true;
            } else {
                errorDiv.textContent = "";
                submitBtn.disabled = false;
            }
        }

        fromInput.addEventListener("change", validateDateTime);
        toInput.addEventListener("input", validateDateTime);
        // document.getElementById('turfBookingForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert("Booking Submitted!");
        //     this.reset();
        // });
    </script>
    <?php include 'footer.php' ?>
</body>

</html>