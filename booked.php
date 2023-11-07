<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booked</title>
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

        .main-container {
            width: 100%;
            height: 90vh;
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }

        .check-container {
            width: 6.25rem;
            height: 7.5rem;
            display: flex;
            flex-flow: column;
            align-items: center;
            justify-content: space-between;
        }

        .check-container .check-background {
            width: 100%;
            height: calc(100% - 1.25rem);
            background: linear-gradient(to bottom right, #f84649d2, #f8464a);
            box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            transform: scale(0.84);
            border-radius: 50%;
            animation: animateContainer 0.75s ease-out forwards 0.75s;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
        }

        .check-container .check-background svg {
            width: 65%;
            transform: translateY(0.25rem);
            stroke-dasharray: 80;
            stroke-dashoffset: 80;
            animation: animateCheck 0.35s forwards 1.25s ease-out;
        }

        .check-container .check-shadow {
            bottom: calc(-15% - 5px);
            left: 0;
            border-radius: 50%;
            background: radial-gradient(closest-side, #f8464a, transparent);
            animation: animateShadow 0.75s ease-out forwards 0.75s;
        }

        @keyframes animateContainer {
            0% {
                opacity: 0;
                transform: scale(0);
                box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }

            25% {
                opacity: 1;
                transform: scale(0.9);
                box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }

            43.75% {
                transform: scale(1.15);
                box-shadow: 0px 0px 0px 43.334px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }

            62.5% {
                transform: scale(1);
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 21.667px rgba(255, 255, 255, 0.25) inset;
            }

            81.25% {
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
            }

            100% {
                opacity: 1;
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
            }
        }

        @keyframes animateCheck {
            from {
                stroke-dashoffset: 80;
            }

            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes animateShadow {
            0% {
                opacity: 0;
                width: 100%;
                height: 15%;
            }

            25% {
                opacity: 0.25;
            }

            43.75% {
                width: 40%;
                height: 7%;
                opacity: 0.35;
            }

            100% {
                width: 85%;
                height: 15%;
                opacity: 0.25;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
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
    <main class="cd__main">
        <!-- Start DEMO HTML (Use the following code into your project)-->
        <div class="main-container">
            <div class="check-container">
                <div class="check-background">
                    <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="check-shadow"></div>
            </div>
        </div>
    </main>
</body>

</html>