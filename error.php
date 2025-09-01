<?php
// Optional: Pass message dynamically via GET or PHP variable
$message = "Slots Already Booked, Please choose other Slots!!";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        /* Mobile-friendly container */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffe6e6;
            /* light red background */
        }

        .error-container {
            text-align: center;
            padding: 30px 20px;
            max-width: 400px;
            background: #fff;
            border: 2px solid #ff4d4d;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .error-container h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .error-container p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #b30000;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #ff4d4d;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #e60000;
        }

        @media screen and (max-width: 480px) {
            .error-container {
                width: 90%;
                padding: 20px 10px;
            }

            .error-container h1 {
                font-size: 36px;
            }

            .error-container p {
                font-size: 16px;
            }

            .back-btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>❌</h1>
        <p><?php echo $message; ?></p>
        <button class="back-btn" onclick="goBack()">Go Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>