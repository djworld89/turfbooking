<?php
// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "turf_booking";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
     die(json_encode(["error" => "Database connection failed"]));
}

// Get selected date
$date = isset($_GET["date"]) ? $_GET["date"] : date("Y-m-d");

// Fetch booked slots from database
$sql =
    "SELECT booking_time FROM bookings WHERE booking_date = ? AND status = 'Booked'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$bookedSlots = [];
while ($row = $result->fetch_assoc()) {
    $bookedSlots[] = $row["booking_time"];
}

header("Content-Type: application/json");
echo json_encode($bookedSlots);
?>
