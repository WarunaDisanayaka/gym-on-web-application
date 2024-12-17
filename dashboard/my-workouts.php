<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>GYM ON DARK</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <?php include './topbar/topbar.php' ?>

    <!-- top navigation bar -->
    <!-- offcanvas -->
    <?php include './sidebar/sidebar.php' ?>
    <!-- offcanvas -->

    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>My Workout Plans</h4>
          </div>
        </div>

        <!-- Table for Workout Plans -->
        <div class="row">
          <div class="col-md-12 mb-3 mt-3">
          <table id="workoutPlansTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Package Name</th>
              <th>Purchase Date</th>
              <th>Duration</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
          <?php
          // Assuming user ID is stored in session as 'user_id'
          if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id']; // Get the logged-in user ID
          } else {
            // If no user is logged in, redirect to login page or handle accordingly
            header("Location: login.php");
            exit();
          }

          // SQL query to fetch workout purchases for the logged-in user
          $sql = "SELECT id, package_name, purchase_date, duration, price FROM workout_purchases WHERE user_id = ?";
          $stmt = mysqli_prepare($conn, $sql);

          // Bind the user_id parameter to the query
          mysqli_stmt_bind_param($stmt, "i", $user_id);

          // Execute the query
          mysqli_stmt_execute($stmt);

          // Get the result
          $result = mysqli_stmt_get_result($stmt);

          if (!$result) {
            die("Query failed: " . mysqli_error($conn)); // Debugging line
          }

          if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display it
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['id']) . "</td>";
              echo "<td>" . htmlspecialchars($row['package_name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
              echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
              echo "<td>$" . htmlspecialchars($row['price']) . "</td>";
              echo "</tr>";
            }
          } else {
            // If no data found for this user
            echo "<tr><td colspan='5'>No workout plans purchased yet.</td></tr>";
          }

          // Close the statement and connection
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
          ?>

          </tbody>
        </table>
          </div>
        </div>
      </div>
    </main>

    <!-- Scripts -->
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>

    <script>
      $(document).ready(function () {
        $('#workoutPlansTable').DataTable();
      });
    </script>
  </body>
</html>
