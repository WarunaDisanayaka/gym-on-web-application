<?php

include '../../config/db.php'; // Include your db connection script
// Initialize variables and error messages
$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
?>
