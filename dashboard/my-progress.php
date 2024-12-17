<?php
session_start();
include '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to access this page.");
}

$user_id = $_SESSION['user_id'];
$errors = [];
$successMessage = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $age = isset($_POST['age']) ? (int) trim($_POST['age']) : 0;
    $height = isset($_POST['height']) ? (int) trim($_POST['height']) : 0;
    $weight = isset($_POST['weight']) ? (int) trim($_POST['weight']) : 0;
    $goal = isset($_POST['goal']) ? trim($_POST['goal']) : '';
    $sets = isset($_POST['sets']) ? (int) trim($_POST['sets']) : NULL;
    $reps = isset($_POST['reps']) ? (int) trim($_POST['reps']) : NULL;
    $weight_lifted = isset($_POST['weight_lifted']) ? (int) trim($_POST['weight_lifted']) : NULL;

    // Validate inputs
    if ($age <= 0) {
        $errors['age'] = "Age is required and must be a positive value.";
    }

    if ($height <= 0) {
        $errors['height'] = "Height is required and must be a positive value.";
    }

    if ($weight <= 0) {
        $errors['weight'] = "Weight is required and must be a positive value.";
    }

    if (empty($goal)) {
        $errors['goal'] = "Fitness goal is required.";
    }

    if ($sets !== NULL && $sets <= 0) {
        $errors['sets'] = "Sets must be a positive value.";
    }

    if ($reps !== NULL && $reps <= 0) {
        $errors['reps'] = "Reps must be a positive value.";
    }

    if ($weight_lifted !== NULL && $weight_lifted <= 0) {
        $errors['weight_lifted'] = "Weight lifted must be a positive value.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO user_workout_progress 
            (user_id, age, height, weight, goal, sets, reps, weight_lifted) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiisii", $user_id, $age, $height, $weight, $goal, $sets, $reps, $weight_lifted);

        if ($stmt->execute()) {
            $successMessage = "Workout progress has been recorded successfully!";
        } else {
            $errors['database'] = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
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

    <!-- offcanvas sidebar -->
    <?php include './sidebar/sidebar.php' ?>

    <main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>My Progress Tracking</h3>
            </div>
        </div>

        <!-- Form for tracking gym progress -->
        <form action="my-progress.php" method="post" id="workoutForm">
            <div class="row">
                <!-- Personal Information Column -->
                <div class="col-md-4 mb-3 mt-3">
                    <h4>Personal Information</h4>
                    <div class="mb-3">
                        <label for="age">Age:</label>
                        <input type="number" name="age" class="form-control <?= isset($errors['age']) ? 'is-invalid' : '' ?>" id="age" >
                        <div class="invalid-feedback"><?= $errors['age'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="height">Height (cm):</label>
                        <input type="number" name="height" class="form-control <?= isset($errors['height']) ? 'is-invalid' : '' ?>" id="height" >
                        <div class="invalid-feedback"><?= $errors['height'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="weight">Weight (kg):</label>
                        <input type="number" name="weight" class="form-control <?= isset($errors['weight']) ? 'is-invalid' : '' ?>" id="weight" >
                        <div class="invalid-feedback"><?= $errors['weight'] ?? '' ?></div>
                    </div>
                </div>

                <!-- Fitness Goals Column -->
                <div class="col-md-4 mb-3 mt-3">
                    <h4>Fitness Goals</h4>
                    <div class="mb-3">
                        <label for="goal">Primary Goal:</label>
                        <select name="goal" class="form-control" id="goal">
                            <option value="Weight loss" <?= $goal === 'Weight loss' ? 'selected' : '' ?>>Weight loss</option>
                            <option value="Muscle gain" <?= $goal === 'Muscle gain' ? 'selected' : '' ?>>Muscle gain</option>
                            <option value="General fitness" <?= $goal === 'General fitness' ? 'selected' : '' ?>>General fitness</option>
                        </select>
                    </div>
                </div>

                <!-- Workout Tracking Column -->
                <div class="col-md-4 mb-3 mt-3">
                    <h4>Workout Tracking</h4>
                    <div class="mb-3">
                        <label for="sets">Sets:</label>
                        <input type="number" name="sets" class="form-control <?= isset($errors['sets']) ? 'is-invalid' : '' ?>" id="sets" >
                        <div class="invalid-feedback"><?= $errors['sets'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="reps">Reps:</label>
                        <input type="number" name="reps" class="form-control <?= isset($errors['reps']) ? 'is-invalid' : '' ?>" id="reps" >
                        <div class="invalid-feedback"><?= $errors['reps'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="weight_lifted">Weight Lifted (kg):</label>
                        <input type="number" name="weight_lifted" class="form-control <?= isset($errors['weight_lifted']) ? 'is-invalid' : '' ?>" id="weight_lifted" >
                        <div class="invalid-feedback"><?= $errors['weight_lifted'] ?? '' ?></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
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
