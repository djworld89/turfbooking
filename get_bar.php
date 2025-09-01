<?php
include 'db.php';
session_start();
$id = $_SESSION['user_id'];
// Input dates from a form or AJAX request
// $from = $_GET['from'] . ' 00:00:00'; // Format: '2025-08-01'
// $to = $_GET['to'] . ' 23:59:59';   // Format: '2025-08-10'

// // Validate dates
// if (!$from || !$to) {
//     die(json_encode(["error" => "Date range required."]));
// }

// SQL query to count total bookings and total paid amount
$sql = "
    SELECT sport,
           COUNT(*) AS total_sports,
           SUM(amount) AS total_collection
    FROM bookings
    WHERE user_id=$id and paymentStatus = 'Paid'
    GROUP BY sport
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$data = [
    "labels" => [],
    "sportsPlayed" => [],
    "collections" => []
];

while ($row = $result->fetch_assoc()) {
    $data["labels"][] = $row["sport"];
    $data["sportsPlayed"][] = (int) $row["total_sports"];
    $data["collections"][] = (float) $row["total_collection"];
}

header("Content-Type: application/json");
echo json_encode($data);
$conn->close();
exit;

?>