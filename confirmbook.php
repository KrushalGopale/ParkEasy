<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["location_name"], $_POST["date"], $_POST["entry_time"], $_POST["exit_time"], $_POST["vehicle_number"], $_POST["vehicle_type"], $_POST["payment_method"])) {
    $email = $_SESSION["user"]["email"];
    $location_name = $_POST["location_name"];
    $date = $_POST["date"];
    $entry_time = $_POST["entry_time"];
    $exit_time = $_POST["exit_time"];
    $vehicle_number = $_POST["vehicle_number"];
    $vehicle_type = $_POST["vehicle_type"];
    $payment_method = $_POST["payment_method"];

    // Place your code here to store the booking information in your database
    require_once "config/config.php";

    // Create a SQL query with prepared statements to insert the booking details into your "bookings" table
    $sql = "INSERT INTO bookings (email, location_name, date, entry_time, exit_time, vehicle_number, vehicle_type, payment_method)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssssssss", $email, $location_name, $date, $entry_time, $exit_time, $vehicle_number, $vehicle_type, $payment_method);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Booking was successfully stored in the database
            header("Location: booked.php"); // Redirect to the bookings page or a confirmation page
            exit();
        } else {
            // Handle the case where the booking couldn't be stored
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where not all required form fields are filled
    // Redirect or display an error message as needed
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Manrope, sans-serif;
            background-color: #FFF0F5;
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

        .payment-details {
            display: none;
        }

        .price {
            color: green;
        }


        .booking-form {
            max-width: 500px;
            margin: 100px auto;
            padding: 50px;
            font-family: Manrope, sans-serif;
            font-size: 15px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            background-color: white;
            border-radius: 50px 20px;
        }

        .booking-form label {
            font-weight: bold;
        }

        .booking-form input,
        .booking-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .booking-form .payment-method-navbar {
            display: flex;
            justify-content: space-between;
        }

        .booking-form .payment-details {
            display: none;
        }

        .booking-form select {
            border: 1px solid #ccc;
        }

        .booking-form img {
            max-width: 100%;
            height: auto;
        }

        .booking-form button {
            font-size: 14px;
            font-weight: 700;
            background-color: #f84646;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 45%;
        }

        .butt {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .booking-form button:hover {
            background-color: rgb(124, 124, 124);
        }

        /* Media Query for Responsiveness */
        @media (max-width: 600px) {
            .booking-form {
                max-width: 100%;
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

    <form action="confirmbook.php" method="post" class="booking-form">
        <?php
        if (isset($_GET['name']) && isset($_GET['price'])) {
            $price = $_GET['price'];
        }
        ?>
        <input type="hidden" name="location_name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>">


        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <label for="entry_time">Entry Time:</label>
        <input type="time" name="entry_time" required>

        <label for="exit_time">Exit Time:</label>
        <input type="time" name="exit_time" required>

        <label for="vehicle_number">Vehicle Number:</label>
        <input type="text" name="vehicle_number" required>

        <label for="vehicle_type">Vehicle Type:</label>
        <select name="vehicle_type" required>
            <option value="" disabled selected>Select Vehicle Type</option>
            <option value="two_wheeler">Two-Wheeler</option>
            <option value="four_wheeler">Four-Wheeler</option>
        </select>

        <label for="payment_method">Total Payment: <span class="price">₹<?php echo $price; ?></span></label>
        <div class="payment-method-navbar">
            <select name="payment_method" id="payment-method" required>
                <option value="" disabled selected>Select Payment Method</option>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="upi">UPI</option>
                <option value="qr_code">QR Code</option>
            </select>
        </div>

        <div id="credit-card-details" class="payment-details">
            <label for="credit_card_number">Credit Card Number:</label>
            <input type="number" name="credit_card_number">

            <label for="credit_card_holder_name">Cardholder Name:</label>
            <input type="text" name="credit_card_holder_name">

            <label for="credit_card_expiry_date">Expiry Date:</label>
            <input type="date" name="credit_card_expiry_date">

            <label for="credit_card_cvv">CVV:</label>
            <input type="number" name="credit_card_cvv">
        </div>

        <div id="debit-card-details" class="payment-details">
            <label for="debit_card_number">Debit Card Number:</label>
            <input type="number" name="debit_card_number">

            <label for="debit_card_holder_name">Cardholder Name:</label>
            <input type="text" name="debit_card_holder_name">

            <label for="debit_card_expiry_date">Expiry Date:</label>
            <input type="date" name="debit_card_expiry_date">

            <label for="debit_card_cvv">CVV:</label>
            <input type="number" name="debit_card_cvv">
        </div>

        <div id="upi-details" class="payment-details">
            <label for="upi_number">UPI Number:</label>
            <input type="number" name="upi_number">
        </div>

        <div id="qr-code-details" class="payment-details">
            <!-- Add QR code display here -->
            <img src="assets/images/qr.png" alt="QR Code">
        </div>

        <div class="butt"><button type="submit">Confirm Booking</button></div>

    </form>

    <script>
        document.getElementById("payment-method").addEventListener("change", function() {
            var selectedMethod = this.value;
            var paymentDetails = document.querySelectorAll(".payment-details");

            paymentDetails.forEach(function(element) {
                element.style.display = "none";
            });

            if (selectedMethod === "credit_card") {
                document.getElementById("credit-card-details").style.display = "block";
            } else if (selectedMethod === "debit_card") {
                document.getElementById("debit-card-details").style.display = "block";
            } else if (selectedMethod === "upi") {
                document.getElementById("upi-details").style.display = "block";
            } else if (selectedMethod === "qr_code") {
                document.getElementById("qr-code-details").style.display = "block";
            }
        });
    </script>



</body>

</html>