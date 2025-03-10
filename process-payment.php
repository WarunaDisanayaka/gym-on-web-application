<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php'; // Include Stripe PHP library

\Stripe\Stripe::setApiKey('sk_test_bhSgB9pO0jya9Lj8Xbs7t8Dv'); // Replace with your Stripe Secret Key

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get payment details from the form
    $token = $_POST['stripeToken']; // Generated by Stripe.js
    $email = $_POST['email']; // Customer email
    $amount = $_POST['amount']; // Payment amount in dollars (e.g., $10.00)
    // Convert the amount to cents
    $amountInCents = $amount * 100;

    try {
        // Create a customer
        $customer = \Stripe\Customer::create([
            'email' => $email,
            'source' => $token,
        ]);

        // Charge the customer
        $charge = \Stripe\Charge::create([
            'customer' => $customer->id,
            'amount' => $amountInCents, // Pass the amount in cents
            'currency' => 'usd',
            'description' => 'Workout Purchase',
        ]);

        // Save transaction details in the database after successful payment
        if ($charge->status === 'succeeded') {
            savePurchaseToDatabase($email, $amountInCents, $charge->id);

            echo "Payment successful! Transaction ID: " . $charge->id;
        }
        $transactionId = $charge->id;

    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle payment failure
        echo 'Error: ' . $e->getMessage();
    }
}
function savePurchaseToDatabase($email, $amountInCents, $transactionId)
{
    require './config/db.php'; // Include your database connection script

    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start session only if not already started
    }

    // Validate session variables
    if (!isset($_SESSION['user_id'])) {
        die("Error: Missing user_id");
    }

    $userId = $_SESSION['user_id'];
    $duration = '3 Months'; // Example duration, replace if dynamic
    $package_name = $_POST['package'];


    // Convert amount to dollars
    $amountInDollars = $amountInCents / 100;

    // Prepare SQL query
    $query = "INSERT INTO workout_purchases (user_id, email, package_name, price, transaction_id, purchase_date, duration)
              VALUES (?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($query);

    // If prepare fails, print the error
    if (!$stmt) {
        die("Error in SQL prepare statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("issdss", $userId, $email, $package_name, $amountInDollars, $transactionId, $duration);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: index.php");
        echo "Purchase saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close resources
    $stmt->close();
    $conn->close();
}




?>
