<?php
  ob_start();
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");

  include_once "admin/libs/Session.php";
  Session::init();
  // Session::checkSessionBorrower();

  if (isset($_SESSION['userlogin'])) {
    header("location: admin/index.php");
  } else {

  }

  include_once "admin/helpers/Format.php";
  spl_autoload_register(function($class){
      include_once "admin/classes/".$class.".php";
  });

  $ml = new ManageLoan();
  $emp = new Employee();
  $bor = new Borrower();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Bootstrap 5 Template">

<link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">

<!-- Libs CSS -->
<link rel="stylesheet" href="assets/libs/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="assets/libs/tiny-slider/dist/tiny-slider.css">
<link rel="stylesheet" href="assets/libs/nouislider/dist/nouislider.min.css">
<link rel="stylesheet" href="assets/fonts/flat-font-icons/css/flaticon.css">
<link rel="stylesheet" href="assets/fonts/fontello-icons/fontello.css">
<link rel="stylesheet" href="assets/libs/magnific-popup/dist/magnific-popup.css">
<link rel="stylesheet" href="assets/libs/jquery-ui/themes/base/all.css">
<link rel="stylesheet" href="assets/libs/jquery-ui/demos/demos.css">
<link rel="stylesheet" href="assets/libs/magnific-popup/dist/magnific-popup.css">

<link rel="stylesheet" href="assets/css/theme.min.css">

  <title>Fast Loan</title>
</head>

<body>
  <div class="bg-primary py-1">
    <!-- top-bar -->
    <div class="container px-md-0">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-4 col-lg-5 col-md-5 col-12 text-md-start">
              <div class="fs-6 text-uppercase text-white fw-semi-bold">
                <span class="ms-2 ms-md-4" style="margin-left: 0.5rem!important;"><a href="admin/signin.php" class="text-white "><i class="fas fa-user"></i> Admin Login</a></span>
              </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 col-12 text-md-end">
              <div class="fs-6 text-uppercase text-white fw-semi-bold">
                <span class="ms-2 ms-md-4 "><a href="tel:+1800-123-4567" class="text-white" >+880 1722 410 301</a></span>
                <span class="ms-2 ms-md-4"><a href="mailto:info@fast-loan.com" class="text-white ">info@fast-loan.com</a></span>
              </div>
            </div>
        </div>
    </div>
</div>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg py-3 navbar-default">
  <div class="container px-0">
    <a class="navbar-brand" href="index.php"><img src="admin/images/fast-loan-logo.png" alt="" width="160" height="auto" /></a>

    <!-- Button -->
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-default"
      aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
      <span class="icon-bar top-bar mt-0"></span>
      <span class="icon-bar middle-bar"></span>
      <span class="icon-bar bottom-bar"></span>
    </button>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbar-default">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="loan-calculator.php">Loan Calculator</a></li>
        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>

        <li class="nav-item dropdown">
          <?php if (Session::get("borrowerlogin") == false): ?>
            <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-user"></i> Login</a></li>
          <?php endif ?>
          
          <?php if (Session::get("borrowerlogin") != false): ?>
          <a class="nav-link" href="profile.php" id="navbarFeatures" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> Profile</a>
          <ul class="dropdown-menu" aria-labelledby="navbarFeatures">
            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
          <?php endif ?>
        </li>
      </ul>
      <div class="ms-lg-3 mt-3 d-grid mt-lg-0">
        <a href="apply_for_loan.php" class="btn btn-primary btn-sm">Apply For Loan</a>
      </div>
    </div>
  </div>
</nav>