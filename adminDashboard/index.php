<?php
// Include database connection
include '../config/db.php';

// SQL Queries to get counts
$userCountQuery = "SELECT COUNT(id) AS user_count FROM users";
$purchaseCountQuery = "SELECT COUNT(purchase_id) AS purchase_count FROM purchases";
$workoutPurchaseCountQuery = "SELECT COUNT(id) AS workout_purchase_count FROM workout_purchases";

// SQL Queries to get total income
$totalIncomeQuery = "SELECT SUM(total_price) AS total_income FROM purchases";
$totalWorkoutIncomeQuery = "SELECT SUM(price) AS total_workout_income FROM workout_purchases";

// Execute queries
$userCountResult = $conn->query($userCountQuery);
$purchaseCountResult = $conn->query($purchaseCountQuery);
$workoutPurchaseCountResult = $conn->query($workoutPurchaseCountQuery);
$totalIncomeResult = $conn->query($totalIncomeQuery);
$totalWorkoutIncomeResult = $conn->query($totalWorkoutIncomeQuery);

// Fetch the results
$userCount = $userCountResult->fetch_assoc()['user_count'];
$purchaseCount = $purchaseCountResult->fetch_assoc()['purchase_count'];
$workoutPurchaseCount = $workoutPurchaseCountResult->fetch_assoc()['workout_purchase_count'];
$totalIncome = $totalIncomeResult->fetch_assoc()['total_income'];
$totalWorkoutIncome = $totalWorkoutIncomeResult->fetch_assoc()['total_workout_income'];

// Calculate the total income from both purchases
$totalIncome += $totalWorkoutIncome;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Admin Dashboard</title>
</head>
<body>
  <!-- top navigation bar -->
  <?php include './topbar/topbar.php' ?>

  <!-- offcanvas -->
  <?php include './sidebar/sidebar.php' ?>
  <!-- offcanvas -->
  
  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4>Admin Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <!-- Total Income Card -->
        <div class="col-md-3 mb-3">
          <div class="card bg-info text-white h-100">
            <div class="card-body py-5">
              <h5>Total Income</h5>
              <h3>Rs <?php echo number_format($totalIncome, 2); ?></h3>
            </div>
            
          </div>
        </div>

        <!-- User Count Card -->
        <div class="col-md-3 mb-3">
          <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">
              <h5>Total Users</h5>
              <h3><?php echo $userCount; ?></h3>
            </div>
            
          </div>
        </div>

        <!-- Purchase Count Card -->
        <div class="col-md-3 mb-3">
          <div class="card bg-warning text-dark h-100">
            <div class="card-body py-5">
              <h5>Total Purchases</h5>
              <h3><?php echo $purchaseCount; ?></h3>
            </div>
            
          </div>
        </div>

        <!-- Workout Purchase Count Card -->
        <div class="col-md-3 mb-3">
          <div class="card bg-success text-white h-100">
            <div class="card-body py-5">
              <h5>Total Workout Purchases</h5>
              <h3><?php echo $workoutPurchaseCount; ?></h3>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
</body>
</html>
