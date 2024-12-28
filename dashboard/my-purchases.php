<?php
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
    <title>Purchased History</title>
  </head>
  <body>
    <!-- Top navigation bar -->
    <?php include './topbar/topbar.php' ?>

    <!-- Offcanvas sidebar -->
    <?php include './sidebar/sidebar.php' ?>
    
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Purchased History</h4>
          </div>
        </div>

        <!-- Table for Purchase History -->
        <div class="row">
          <div class="col-md-12 mb-3 mt-3">
            <table id="purchaseHistoryTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Purchase Date</th>
                  <th>Item Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Assuming user ID is stored in session as 'user_id'
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id']; // Get the logged-in user ID
                } else {
                    // If no user is logged in, redirect to login page
                    header("Location: login.php");
                    exit();
                }

                // SQL query to fetch purchase history for the logged-in user
                $sql = "
                  SELECT p.purchase_id, p.purchase_date, pi.item_name, pi.item_price, p.total_price
                  FROM purchases p
                  JOIN purchase_items pi ON p.purchase_id = pi.purchase_id
                  WHERE p.user_email = ?
                  ORDER BY p.purchase_date DESC";
                $stmt = mysqli_prepare($conn, $sql);

                // Bind the user_email parameter to the query
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['user_email']);

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
                        echo "<td>" . htmlspecialchars($row['purchase_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If no data found for this user
                    echo "<tr><td colspan='5'>No purchase history found.</td></tr>";
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
        $('#purchaseHistoryTable').DataTable();
      });
    </script>
  </body>
</html>
