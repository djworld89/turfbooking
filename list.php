<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('db.php');
$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Turf Booking List</title>

    <!-- DataTables CSS with Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: url(turf.main.avif) no-repeat scroll center 0 / cover;
        padding: 20px;
        margin: 0;
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .datatable-container {
        background: lightyellow;
        padding: 15px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        overflow-x: auto;
    }

    .action-icons i {
        cursor: pointer;
        padding: 6px;
        border-radius: 50%;
        margin-right: 5px;
        transition: 0.2s;
    }

    .action-icons i:hover {
        background-color: #ecf0f1;
    }

    .material-icons {
        font-size: 20px;
        vertical-align: middle;
    }

    .edit-icon {
        color: #2980b9;
    }

    .view-icon {
        color: #27ae60;
    }

    .delete-icon {
        color: #e74c3c;
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 22px;
            background: lightblue;
        }
    }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <h2>List of Turf Bookings</h2>

    <div class="datatable-container">
        <table id="bookingTable" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Sport</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?= $row['booking_id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['mobile'] ?></td>

                    <td><?= $row['sport'] ?></td>
                    <td>₹<?= $row['amount'] ?></td>
                    <td><?= $row['paymentStatus'] ?></td>
                    <td><?= $row['fromDateTime'] ?></td>
                    <td><?= $row['toDateTime'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td class="action-icons">
                        <a href="view.php?bookid=<?= $row['id'] ?>"><i class="material-icons view-icon"
                                title="View">visibility</i></a>
                        <a href="update.php?bookid=<?= $row['id'] ?>"><i class="material-icons edit-icon"
                                title="Edit">edit</i></a>
                        <i class="material-icons delete-icon" title="Delete">delete</i>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                    <td colspan="10">No bookings found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- JQuery + DataTables JS + Responsive Plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#bookingTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true
        });

        $('.view-icon').click(function() {
            alert("Viewing Booking Details");
        });

        $('.edit-icon').click(function() {
            alert("Editing Booking");
        });

        $('.delete-icon').click(function() {
            if (confirm("Are you sure to delete this booking?")) {
                $(this).closest('tr').remove();
            }
        });
    });
    </script>
    <?php include 'footer.php' ?>
</body>

</html>