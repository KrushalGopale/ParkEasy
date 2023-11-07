<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Manrope, sans-serif;
            background-color: #FFF0F5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
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
            max-width: 100%;
            margin: 20px;
            padding: 20px;
            font-family: Manrope, sans-serif;
            font-size: 15px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            background-color: white;
            border-radius: 20px;
            overflow: auto;
        }

        h1 {
            color: #f84646;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            text-align: center;
        }

        form {
            display: inline;
        }

        p {
            margin: 20px auto;
            text-align: center;
        }

        .cancel-button {
            display: block;
            background-color: #f84646;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            max-width: 50%;
            padding: 13px 20px;
            margin: 10px auto;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-button:hover {
            background-color: rgb(124, 124, 124);
        }

        a{
            text-decoration: none;
        }


        /* Responsive Styles */
        @media screen and (max-width: 600px) {
            .container {
                margin: 10px;
                padding: 10px;
            }

            table {
                font-size: 14px;
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
        <h1>Bookings</h1>
        <?php
        session_start();
        require_once 'config/config.php';

        if (!isset($_SESSION['user'])) {
            // If the user is not logged in, redirect them to the login page.
            header("Location: login.php");
            exit();
        }

        // Retrieve the user's email from the session (assuming it's stored as 'email')
        $userEmail = $_SESSION['user']['email'];

        // Check if a cancel request is submitted
        if (isset($_POST['cancel_booking'])) {
            // Get the booking ID from the submitted form
            $bookingId = $_POST['booking_id'];

            // Query to delete the booking
            $deleteBookingSQL = "DELETE FROM bookings WHERE id = ? AND email = ?";
            $stmt = $conn->prepare($deleteBookingSQL);

            if ($stmt) {
                $stmt->bind_param("is", $bookingId, $userEmail);
                if ($stmt->execute()) {
                    // Booking was successfully canceled
                    echo "Booking canceled successfully.";
                } else {
                    echo "Error canceling booking: " . $conn->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }

        // Query the database to retrieve user bookings
        $getBookingsSQL = "SELECT * FROM bookings WHERE email = ?";
        $stmt = $conn->prepare($getBookingsSQL);

        if ($stmt) {
            $stmt->bind_param("s", $userEmail);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Display user bookings in a table
                echo '<table>';
                echo '<tr><th>Location Name</th><th>Date</th><th>Entry Time</th><th>Exit Time</th><th>Vehicle Number</th><th>Vehicle Type</th><th>Payment Method</th><th>Receipt</th><th>Cancel</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['location_name'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['entry_time'] . '</td>';
                    echo '<td>' . $row['exit_time'] . '</td>';
                    echo '<td>' . $row['vehicle_number'] . '</td>';
                    echo '<td>' . $row['vehicle_type'] . '</td>';
                    echo '<td>' . $row['payment_method'] . '</td>';
                    // Add a "View Receipt" button with a link to view_receipt.php
                    echo '<td class="actions">';
                    echo '<a href="receipt.php?booking_id=' . $row['id'] . '&user_email=' . $userEmail . '"><button class="cancel-button">View</button></a>';
                    echo '</td>';
                    // Add a form with a cancel button
                    echo '<td class="actions">';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="booking_id" value="' . $row['id'] . '">';
                    echo '<input type="submit" name="cancel_booking" value="Cancel" class="cancel-button">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No bookings found.</p>';
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
</body>

</html>