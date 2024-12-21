<?php
include '../config/db.php';
session_start();
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
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: center; }
        .total { font-weight: bold; color: green; margin-top: 20px; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .btn:hover { background-color: #45a049; }
        .clear-btn { background-color: red; color: white; padding: 10px 20px; border: none; cursor: pointer; margin-top: 10px; }
        .clear-btn:hover { background-color: darkred; }
    </style>
  </head>
  <body>
    <!-- top navigation bar -->
    <?php include './topbar/topbar.php'; ?>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <?php include './sidebar/sidebar.php'; ?>
    <!-- offcanvas -->

    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Calories Calculation</h4>
          </div>
        </div>
        <div class="container">
          <form method="POST" action="">
            <label for="food">Select Food Item:</label>
            <select name="food" id="food">
              <option value="">-- Select --</option>
              <?php
              $result = $conn->query("SELECT fi.id, fi.food_name, fi.calories_per_100g, fc.category_name 
                                      FROM FoodItem fi 
                                      JOIN FoodCategory fc ON fi.category_id = fc.id 
                                      ORDER BY fc.category_name, fi.food_name");
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='{$row['id']}' data-calories='{$row['calories_per_100g']}'>{$row['category_name']} - {$row['food_name']} ({$row['calories_per_100g']} cal)</option>";
              }
              ?>
            </select>
            <label for="quantity">Quantity (in grams):</label>
            <input type="number" name="quantity" id="quantity" min="1" value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : ''; ?>" required>
            <button type="submit" name="add_to_list" class="btn">Add to List</button>
            <button type="submit" name="clear_list" class="clear-btn">Clear List</button>
          </form>

          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              if (isset($_POST['add_to_list'])) {
                  $food_id = $_POST['food'];
                  $quantity = $_POST['quantity'];

                  $food = $conn->query("SELECT * FROM FoodItem WHERE id = $food_id")->fetch_assoc();
                  $calories = ($food['calories_per_100g'] / 100) * $quantity;

                  $_SESSION['cart'][] = [
                      'food_name' => $food['food_name'],
                      'quantity' => $quantity,
                      'calories' => $calories
                  ];
              }

              if (isset($_POST['clear_list'])) {
                  $_SESSION['cart'] = [];
              }
          }

          if (!empty($_SESSION['cart'])) {
              echo "<table>
                      <thead>
                          <tr>
                              <th>Food Item</th>
                              <th>Quantity (g)</th>
                              <th>Calories</th>
                          </tr>
                      </thead>
                      <tbody>";

              $total_calories = 0;
              foreach ($_SESSION['cart'] as $item) {
                  echo "<tr>
                          <td>{$item['food_name']}</td>
                          <td>{$item['quantity']}</td>
                          <td>{$item['calories']} cal</td>
                        </tr>";
                  $total_calories += $item['calories'];
              }

              echo "</tbody></table>";
              echo "<div class='total'>Total Calories: {$total_calories} cal</div>";
          } else {
              echo "<p>No items in the list.</p>";
          }
          ?>
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
  </body>
</html>
