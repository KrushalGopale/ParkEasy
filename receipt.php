<?php
session_start();
require_once 'config/config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['booking_id']) && isset($_GET['user_email'])) {
    $bookingId = $_GET['booking_id'];
    $userEmail = $_GET['user_email'];

    $getBookingSQL = "SELECT * FROM bookings WHERE id = ? AND email = ?";
    $stmt = $conn->prepare($getBookingSQL);

    if ($stmt) {
        $stmt->bind_param("is", $bookingId, $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Receipt</title>
                <link rel="stylesheet" href="assets/css/style.css">
                <style>
                    body {
                        font-family: Manrope, sans-serif;
                        background-color: #FFF0F5;
                        margin: 0;
                        padding: 0;
                        min-height: 100vh;
                        text-align: center;
                    }

                    .div {
                        background-color: #4a4a48;
                        border: none;
                        border-bottom-left-radius: 10px;
                        border-bottom-right-radius: 10px;
                    }

                    .div-8 {
                        color: white;
                    }

                    .div-11 {
                        padding-right: 70px;
                    }

                    .container {
                        max-width: 500px;
                        margin: 100px auto;
                        padding: 50px;
                        font-family: Manrope, sans-serif;
                        font-size: 15px;
                        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
                        background-color: white;
                        border-radius: 50px 20px;
                    }

                    p {
                        font-size: 20px;
                        color: #555;
                        margin: 20px 0;
                    }

                    .foot {
                        background-color: #f84646;
                        border: none;
                        border-radius: 10px;
                    }

                    .foot h1 {
                        font-family: Segoe Script, sans-serif;
                        color: white;
                        padding: 10px 0;
                    }

                    @media screen and (max-width: 600px) {
                        .container {
                            width: 100%;
                            padding: 10px;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="div">
                    <div class="div-4">
                        <div class="div-5">
                            <img loading="lazy" srcset="assets/images/logo.jpg" class="img-2" />
                            <div class="div-6">ParkEasy</div>
                        </div>
                        <div class="div-7">
                            <a href="index.php" class="div-8">
                                <div class="div-8">Home</div>
                            </a>
                            <a href="logout.php" id="div-100">
                                <div class="div-11">Logout</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="foot">
                        <h1>ParkEasy</h1>
                    </div>
                    <p><strong>Email:</strong> <?= $userEmail ?></p>
                    <p><strong>Location Name:</strong> <?= $row['location_name'] ?></p>
                    <p><strong>Date:</strong> <?= $row['date'] ?></p>
                    <p><strong>Entry Time:</strong> <?= $row['entry_time'] ?></p>
                    <p><strong>Exit Time:</strong> <?= $row['exit_time'] ?></p>
                    <p><strong>Vehicle Number:</strong> <?= $row['vehicle_number'] ?></p>
                    <p><strong>Vehicle Type:</strong> <?= $row['vehicle_type'] ?></p>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Booking not found.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Booking ID and user email are required.";
}
