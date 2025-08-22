<?php
include 'db.php';
if (!$_GET['fromDate'] || !$_GET['toDate']) {
    die(json_encode(["error" => "Date range required."]));
}
// Input dates from a form or AJAX request
$fromDate = $_GET['fromDate'] . ' 00:00:00'; // Format: '2025-08-01'
$toDate = $_GET['toDate'] . ' 23:59:59';   // Format: '2025-08-10'

// Validate dates
if (!$fromDate || !$toDate) {
    die(json_encode(["error" => "Date range required."]));
}

// CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=booking_report_' . $fromDate . '_to_' . $toDate . '.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Column headers
fputcsv($output, ['Booking ID', 'Name', 'Mobile', 'Email', 'Sport', 'Amount', 'Payment Status', 'Booking From DateTime', 'Booking To DateTime']);

// Query bookings
$sql = "SELECT booking_id, name, mobile, email, sport, amount, paymentStatus, fromDateTime, toDateTime
        FROM bookings 
        WHERE DATE(created_at) BETWEEN '$fromDate' AND '$toDate'
        ORDER BY created_at ASC";
$result = $conn->query($sql);

$totalSports = 0;
$totalCollection = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);

        $totalSports++;
        if (strtolower($row['paymentStatus']) === "Paid") {
            $totalCollection += $row['amount'];
        }
    }
} else {
    fputcsv($output, ['No records found']);
}

// Add summary row
fputcsv($output, []); // empty line
fputcsv($output, ['Total Sports Played', $totalSports]);
fputcsv($output, ['Total Collection (Paid)', $totalCollection]);

fclose($output);
$conn->close();
?>