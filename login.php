<?php

require './config/db.php'; // Include your db connection script
// Initialize variables and error messages
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["register"])) {

  // Collect input data and sanitize
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $role = 'user'; // Default role

  // Validate Name
  if (empty($name)) {
    $nameErr = "Name is required.";
  } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
    $nameErr = "Name can only contain letters and spaces.";
  }

  // Validate Email
  if (empty($email)) {
    $emailErr = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format.";
  } else {
    // Check if email already exists
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $emailCheckQuery);
    if (mysqli_num_rows($result) > 0) {
      $emailErr = "This email is already registered.";
    }
  }

  // Validate Password
  if (empty($password)) {
    $passwordErr = "Password is required.";
  } elseif (strlen($password) < 6) {
    $passwordErr = "Password must be at least 6 characters long.";
  }

  // If there are no errors, proceed with account creation
  if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL to insert data
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashedPassword', '$role')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
      $successMessage = "Account created successfully!";
      // Clear input fields
      $name = $email = $password = "";
    } else {
      $successMessage = "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["login"])) {

  $loginEmailErr = $loginPasswordErr = ""; // Initialize error variables
  $errorMessage = $successMessage = "";   // Other messages

  // Collect and sanitize input data
  $loginEmail = trim($_POST['loginEmail']);
  $loginPassword = trim($_POST['loginPassword']);

  // Validate Email
  if (empty($loginEmail)) {
    $loginEmailErr = "Email is required.";
  } elseif (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
    $loginEmailErr = "Invalid email format.";
  }

  // Validate Password
  if (empty($loginPassword)) {
    $loginPasswordErr = "Password is required.";
  }

  // If there are no errors, proceed with login
  if (empty($loginEmailErr) && empty($loginPasswordErr)) {
    // Prepare SQL to check user existence
    $sql = "SELECT * FROM users WHERE email = '$loginEmail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      // Verify the password
      if (password_verify($loginPassword, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_email'] = $user['email'];


        // Redirect based on role
        if ($user['role'] === 'admin') {
          header("Location: adminDashboard/");
        } elseif ($user['role'] === 'user') {
          header("Location: index.php");
        } else {
          $errorMessage = "Invalid role. Please contact support.";
        }
        exit();
      } else {
        $errorMessage = "Invalid password. Please try again.";
      }
    } else {
      $errorMessage = "No account found with this email.";
    }
  }

  // Close the connection
  mysqli_close($conn);
}


?>

<!DOCTYPE html> 
<html lang="en"> 

<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:41 GMT -->
<head>

  <!-- Meta Options -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Title -->
   <title>Login and Register</title>
  <!-- Bootstrap -->

  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="assets/images/heading-icon.png">
  <link rel="stylesheet" href="assets/font/flaticon_mycollection.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css"> 
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/nice-select.css">
  <!-- Stylesheet -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
  <link rel="stylesheet" type="text/css" href="assets/css/style-dark.css"> 
  <!-- Responsive -->
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 1em; }
    </style>
 
</head>
 
<body class="light-d">
    <!-- Loader Start -->
    <div class="color-group"> 
  <div class="icon-color">
    <i class="fa-solid fa-gear"></i>
  </div>
  <ul class="color-grid">
    <li class="color-option is-selected" data-color="#ea2127"></li>
    <li class="color-option" data-color="#c8a01c"></li>
    <li class="color-option" data-color="#aad804"></li>
    <li class="color-option" data-color="#f16e24"></li>
    <li class="color-option" data-color="#b8653b"></li>
    <li class="color-option" data-color="#1e51b8"></li>
    <li class="color-option" data-color="#d61c50"></li>
    <li class="color-option" data-color="#7ba12b"></li>
  </ul>
</div>
  <div class="preloader">
    <div class="loader-wrap-heading">
      <div class="load-text"> <span>L</span> <span>o</span> <span>a</span> <span>d</span> <span>i</span> <span>n</span> <span>g</span> </div>
    </div>
  </div>
  <!-- Loader End -->

  <!-- Header Style One Start -->
  <?php include './header/header.php' ?>
  <!-- Header Style One End -->

  <!-- Banner Style One Start -->
  <section class="banner-style-one">
    <div class="parallax" style="background-image: url(assets/images/pattren-3.png);"></div>
    <div class="container">
      <div class="row">
        <div class="banner-details">
          <h2>Login and Register</h2>
          <p>our values and vaulted us to the top of our industry.</p>
        </div>
      </div>
    </div>
    <div class="breadcrums">
      <div class="container">
        <div class="row">
          <ul>
            <li>
              <a href="index.html">
                <i class="fa-solid fa-house"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="current">
              <p>Login and Register</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Banner Style One End -->

  <!-- Login Register Start -->
  <section class="gap login-register">
    <div class="container">
      <div class="row">
        <div class="col-lg-6" >
          <div class="box login">
            <h3>LogIn Your Account</h3>
            <form action="login.php" method="POST">
    <input type="email" name="loginEmail" placeholder="Username or email address">
    <span style="color: red;"><?php echo $loginEmailErr; ?></span>
    <input type="password" name="loginPassword" placeholder="Password">
    <span style="color: red;"><?php echo $loginPasswordErr; ?></span>
    <?php if (!empty($errorMessage)) { ?>
                                                                                       <p class="success" style="color:red;"><?php echo $errorMessage; ?></p>
               <?php } ?>
    <div class="remember">
      <div class="first">
        <input type="checkbox" name="checkbox" id="checkbox">
        <label for="checkbox">Remember me</label>
      </div>
      <div class="second">
        <a href="javascript:void(0)">Forget a Password?</a>
      </div>
    </div>
    <button type="submit" name="login" class="theme-btn">Login</button>
  </form>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box register">
             <h3>register your account</h3>
             <form action="login.php" method="POST">
             <input type="text" name="name" placeholder="Complete Name" value="<?php echo htmlspecialchars($name); ?>">
    <span class="error"><?php echo $nameErr; ?></span>
    <br>

    <input type="email" name="email" placeholder="Username or email address" value="<?php echo htmlspecialchars($email); ?>">
    <span class="error"><?php echo $emailErr; ?></span>
    <br>

    <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
    <span class="error"><?php echo $passwordErr; ?></span>

    <?php if (!empty($successMessage)) { ?>
                                                                                       <p class="success" style="color:green;"><?php echo $successMessage; ?></p>
               <?php } ?>
    <br>
              <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
              <button type="submit" name="register" class="theme-btn"> Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Login Register End -->
  <?php include './footer/footer.php' ?>

</body>
<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:41 GMT -->
</html>
