<?php
include 'db.php';
session_start();
// Input dates from a form or AJAX request
$from = $_GET['from'] . ' 00:00:00'; // Format: '2025-08-01'
$to = $_GET['to'] . ' 23:59:59';   // Format: '2025-08-10'

// Validate dates
if (!$from || !$to) {
  die(json_encode(["error" => "Date range required."]));
}
$id = $_SESSION['user_id'];
// SQL query to count total bookings and total paid amount
$sql = "SELECT 
          COUNT(*) AS total_sports,
          SUM(amount) AS total_amount 
        FROM bookings 
        WHERE user_id=$id and paymentStatus = 'Paid' 
          AND created_at BETWEEN ? AND ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $from, $to);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Return JSON response
echo json_encode([
  "total_sports" => $data['total_sports'] ?? 0,
  "total_amount" => $data['total_amount'] ?? 0.00
]);

$stmt->close();
$conn->close();
?>