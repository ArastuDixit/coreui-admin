<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>CoreUI Free Bootstrap Admin Template</title>
  <link rel="apple-touch-icon" sizes="57x57" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="coreui-bootstrap-admin/dist/assets/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="coreui-bootstrap-admin/dist/assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="coreui-bootstrap-admin/dist/assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="coreui-bootstrap-admin/dist/assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="coreui-bootstrap-admin/dist/assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="coreui-bootstrap-admin/dist/assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="coreui-bootstrap-admin/dist/assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="coreui-bootstrap-admin/dist/vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="coreui-bootstrap-admin/dist/css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="coreui-bootstrap-admin/dist/css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="coreui-bootstrap-admin/dist/css/examples.css" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    // Shared ID
    gtag('config', 'UA-118965717-3');
    // Bootstrap ID
    gtag('config', 'UA-118965717-5');
  </script>
</head>

<?php
include('config.php');

session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform form validation (you can add additional validation if needed)

  // Retrieve user from the database
  $query = "SELECT * FROM coreui WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    // User found, proceed with login
    $_SESSION['loggedin'] = true; // Set the session variable to indicate the user is logged in

    // Redirect to the index page
    header("Location: index.php");
    exit;
    
  } else {
    // User not found or invalid credentials
    echo "Invalid username or password.";
  }
}
?>


<body>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-medium-emphasis">Sign In to your account</p>
                <form method="POST" action="login.php">
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg>
                    </span>
                    <input class="form-control" type="text" placeholder="Username" name="username">
                  </div>
                  <div class="input-group mb-4">
                    <span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg>
                    </span>
                    <input class="form-control" type="password" placeholder="Password" name="password">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                    <div class="col-6 text-end">
                      <button class="btn btn-link px-0" type="button">Forgot password?</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card col-md-5 text-white bg-primary py-5">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <button class="btn btn-lg btn-outline-light mt-3" type="button" onclick="window.location.href='register.php'">Register Now!</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="coreui-bootstrap-admin/dist/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="coreui-bootstrap-admin/dist/vendors/simplebar/js/simplebar.min.js"></script>
  <script>
  </script>

</body>

</html>