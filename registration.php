<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: service.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #FFF0F5;
      font-family: Manrope, sans-serif;
    }

    .div {
      background-color: #4a4a48;
      border: none;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    /* Style the header */
    .header {
      color: #f8464a;
      /* Text color */
      text-align: center;
      /* Center the text */
      padding: 30px;
      /* Add padding for spacing */
    }

    /* Style the h1 within the header */
    .header h1 {
      font-family: Manrope, sans-serif;
      font-size: 24px;
      /* Font size */
      margin: 0;
      /* Remove default margin */
    }

    .p {
      font-family: Manrope, sans-serif;
      font-size: 15px;
      font-weight: 550;
    }

    .container {
      max-width: 500px;
      margin: 100px auto;
      padding: 50px;
      font-family: Manrope, sans-serif;
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
      background-color: white;
      border-radius: 50px 20px;
    }

    .pop {
      color: red;
      font-size: 12px;
    }

    .alert {
      color: green;
      font-size: 15px;
    }




    .form-group {
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    /* Style the submit button */
    .form-btn {
      text-align: center;
    }

    .btn-primary {
      font-family: Manrope, sans-serif;
      background-color: #f8464a;
      color: #fff;
      padding: 13px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Add hover effect to the submit button */
    .btn-primary:hover {
      background-color: rgb(124, 124, 124);
    }

    /* Adjust styling for small screens (optional) */
    @media (max-width: 768px) {
      .form-control {
        width: 100%;
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
        <a href="login.php" id="div-100">
          <div class="div-11">Login</div>
        </a>
      </div>
    </div>
  </div>
  <div class="container">
    <?php
    if (isset($_POST["submit"])) {
      $fullName = $_POST["fullname"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $passwordRepeat = $_POST["repeat_password"];

      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $errors = array();

      if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "<div class='pop'>*All fields are required</div>");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "<div class='pop'>*Email is not valid</div>");
      }

      if (strlen($password) < 8) {
        array_push($errors, "<div class='pop'>*Password must be at least 8 characters long</div>");
      }

      if ($password !== $passwordRepeat) {
        array_push($errors, "<div class='pop'>*Password does not match</div>");
      }

      require_once "config/config.php";

      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = mysqli_stmt_init($conn);

      if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
          array_push($errors, "<div class='pop'>*Email already exists</div>");
        }

        mysqli_stmt_close($stmt);
      }

      if (count($errors) > 0) {
        foreach ($errors as $error) {
          echo $error;
        }
      } else {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
          mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
          mysqli_stmt_execute($stmt);

          echo "<div class='alert'>You are registered successfully.";
        } else {
          echo "Something went wrong";
        }

        mysqli_stmt_close($stmt);
      }

      mysqli_close($conn);
    }
    ?>
    <div class="header">
      <h1>Registration</h1>
    </div>
    <form action="registration.php" method="post">
      <div class="form-group">
        <p class="p">Name</p>
        <input type="text" class="form-control" name="fullname" placeholder="Enter Your Name">
      </div>
      <div class="form-group">
        <p class="p">Email</p>
        <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
      </div>
      <div class="form-group">
        <p class="p">Password</p>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <p class="p">Confirm Password</p>
        <input type="password" class="form-control" name="repeat_password" placeholder="Confirm Password">
      </div>
      <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Register" name="submit">
      </div>
    </form>
    <div>
    </div>
  </div>
</body>

</html>