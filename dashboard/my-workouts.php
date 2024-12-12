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
          <div class="col-md-12 mb-3">
            <table id="workoutPlansTable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Workout Plan</th>
                  <th>Purchase Date</th>
                  <th>Duration</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <!-- Sample Row 1 -->
                <tr>
                  <td>1</td>
                  <td>Bodybuilding Plan</td>
                  <td>2024-12-01</td>
                  <td>3 Months</td>
                  <td>$99.99</td>
                  
                </tr>
                <!-- Sample Row 2 -->
                <tr>
                  <td>2</td>
                  <td>Cardio Plan</td>
                  <td>2024-12-05</td>
                  <td>1 Month</td>
                  <td>$49.99</td>
                  
                </tr>
                <!-- Additional rows can go here -->
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
