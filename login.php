<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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


    .div-11 {
      padding-right: 75px;
    }

    .header {
      color: #f8464a;
      text-align: center;
      padding: 10px;
    }

    .header h1 {
      font-size: 24px;
      margin: 0;
    }

    .p {
      font-family: Manrope, sans-serif;
      font-size: 15px;
      font-weight: 550;
    }

    .pop {
      color: red;
      font-size: 12px;
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

    .form-group {
      margin-bottom: 15px;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-btn {
      text-align: center;
    }

    .btn-primary {
      background-color: #f8464a;
      color: #fff;
      padding: 13px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: rgb(124, 124, 124);
    }

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
        <a href="registration.php" id="div-100">
          <div class="div-11">Register</div>
        </a>
      </div>
    </div>
  </div>
  <div class="container">
    
  <?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: service.php");
  exit();
}

require_once "config/config.php";

if (isset($_POST["login"])) {
  $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $user = mysqli_fetch_assoc($result);

    if ($user) {
      if (password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        header("Location: service.php");
        exit();
      } else {
        echo "<div class='pop'>Password does not match</div>";
      }
    } else {
      echo "<div class='pop'>Email does not match</div>";
    }
  } else {
    echo "Query Error: " . mysqli_error($conn);
  }
}
?>



    <div class="header">
      <h1>Login</h1>
    </div>
    <form action="login.php" method="post">
      <div class="form-group">
        <p class="p">Email</p>
        <input type="email" placeholder="Enter Your Email" name="email" class="form-control">
      </div>
      <div class="form-group">
        <p class="p">Password</p>
        <input type="password" placeholder="Enter Your Password" name="password" class="form-control">
      </div>
      <div class="form-btn">
        <input type="submit" value="Login" name="login" class="btn btn-primary">
      </div>
    </form>
  </div>
</body>

</html>
