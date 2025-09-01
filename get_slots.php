<?php
// DB connection
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('db.php');
$id = $_SESSION['user_id'];
// Get selected date
$date = isset($_GET["date"]) ? $_GET["date"] . ' 00:00:00' : date("Y-m-d") . ' 00:00:00';
$date1 = isset($_GET["date"]) ? $_GET["date"] . ' 23:59:59' : date("Y-m-d") . ' 23:59:59';

// Fetch booked slots from database
$sql =
    "SELECT fromDateTime,toDateTime FROM bookings WHERE user_id=$id and ((fromDateTime BETWEEN ? AND ? ) || (toDateTime BETWEEN ? AND ?)) and paymentStatus = 'Pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $date, $date1, $date, $date1);
$stmt->execute();
$result = $stmt->get_result();

$bookedSlots = [];
while ($row = $result->fetch_assoc()) {
    $ftime = date("H:i", strtotime($row["fromDateTime"]));
    $ttime = date("H:i", strtotime($row["toDateTime"]));
    // $datetime1 = new DateTime($row["fromDateTime"]);
    // $datetime2 = new DateTime($row["toDateTime"]);

    // if ($datetime1 < $datetime2) {
    //     echo "datetime1 is earlier";
    // } elseif ($datetime1 > $datetime2) {
    //     echo "datetime1 is later";
    // } else {
    //     echo "Both are the same";
    // }
    $bookedSlots[] = $ftime . " To " . $ttime;
}

header("Content-Type: application/json");
echo json_encode($bookedSlots);
?>