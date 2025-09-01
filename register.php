<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Turf Booking Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: url(turf.main.avif) no-repeat scroll center 0 / cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: lightyellow;
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .show-password {
            margin-top: 8px;
            display: flex;
            align-items: center;
        }

        /* .show-password input {
        margin-right: 6px;
    } */

        .login-btn {
            width: 100%;
            background: #2980b9;
            color: white;
            padding: 12px;
            font-size: 17px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: #1f6696;
        }

        .login-footer {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        @media (max-width: 500px) {
            .login-container {
                margin: 0 15px;
                padding: 20px;
            }

            .login-container h2 {
                font-size: 22px;
            }
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div style="text-align:center;">
            <img src="turf_booking_mng.png" height="100px;">
            <h2>Register</h2>
        </div>
        <form id="loginForm" method="POST">
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
                <div class="show-password">
                    <input type="checkbox" style="width: auto;" onclick="togglePassword()"> Show Password
                </div>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile No</label>
                <input type="tel" id="mobile" name="mobile" required pattern="[0-9]{10}">
            </div>
            <div class="form-group">
                <label for="email">Email ID</label>
                <input type="email" id="email" name="email">
            </div>
            <div id="message" style="color:blue"></div>

            <button type="submit" class="login-btn">Submit</button>
        </form>

        <div class="login-footer">
            Already, have an account? <a href="login.php">Login here</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById("password");
            pwd.type = pwd.type === "password" ? "text" : "password";
        }

        document.getElementById("loginForm").addEventListener("submit", function (e) {
            e.preventDefault();

            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let email = document.getElementById("email").value;
            let mobile = document.getElementById("mobile").value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "check_register.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                let response = JSON.parse(this.responseText);
                let msgDiv = document.getElementById("message");

                if (response.status === "success") {
                    msgDiv.innerHTML = "<p class='success'>" + response.message + "</p>";
                    setTimeout(() => {
                        window.location.href = "login.php?user=" + response.user
                    }, 2000);
                } else {
                    msgDiv.innerHTML = "<p class='error'>" + response.message + "</p>";
                }
            };

            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password) +
                "&email=" + encodeURIComponent(email) + "&mobile=" + encodeURIComponent(mobile));
        });
    </script>
</body>

</html>