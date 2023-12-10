<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
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

        .container {
            text-align: center;
        }

        .container h1 {
            color: rgb(124, 124, 124);
            padding-top: 50px;
            font-size: 50px;
            font-weight: 700;
            text-align: center;
        }



        #section-3 {
            overflow: hidden;
            padding-top: 5em;
            display: flex;
            justify-content: center;
        }

        #row {
            display: flex;
        }

        #column21,
        #column22 {
            flex: 1;
            max-width: 48%;
            padding: 10px;
            text-align: center;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            background-color: white;
            border-radius: 50px 20px;
            margin: 10px;
        }

        .image {
            max-width: 80%;
            height: auto;
            border-radius: 5px;
        }

        .button {
            display: block;
            background-color: #f84646;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            max-width: 30%;
            padding: 13px 20px;
            margin: 10px auto;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: rgb(124, 124, 124);
        }

        @media (max-width: 768px) {


            .button {
                justify-content: center;
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
        <h1 >Welcome to <span style="font-family: Segoe Script, sans-serif; font-weight: 900; color: #f84646; font-size:60px">ParkEasy</span></h1>
    </div>
    <section class="container" id="section-3">
        <div id="row">
            <div id="column21">
                <img src="assets/images/car-book.png" class="image image-full">

                <a href="map.php" class="button">Book Now</a>
            </div>
            <div id="column22">
                <img src="assets/images/car-search.png" class="image image-full">

                <a href="mybookings.php" class="button">Bookings</a>
            </div>
        </div>
    </section>

</body>

</html>
