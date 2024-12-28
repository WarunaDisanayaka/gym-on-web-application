<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './config/db.php'; // Your database connection
require './vendor/autoload.php';  // Include PHPMailer's Composer autoload file

// Validate input data
if (
    !isset($_POST['email'], $_POST['name'], $_POST['address'], $_POST['payment_method'], $_POST['total_price']) ||
    empty($_POST['email']) || empty($_POST['name']) || empty($_POST['address']) || empty($_POST['payment_method']) || empty($_POST['total_price'])
) {
    die("Error: Missing required fields or invalid data.");
}

// Sanitize input data
$userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$userName = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$shippingAddress = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
$paymentMethod = htmlspecialchars($_POST['payment_method'], ENT_QUOTES, 'UTF-8');
$totalPrice = floatval($_POST['total_price']);
$items = isset($_POST['items']) ? json_decode($_POST['items'], true) : [];

// Validate email format
if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format.");
}

try {
    $conn->begin_transaction();

    // Insert purchase record
    $stmt = $conn->prepare("INSERT INTO purchases (user_email, user_name, total_price, shipping_address, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $userEmail, $userName, $totalPrice, $shippingAddress, $paymentMethod);
    $stmt->execute();
    $purchaseId = $stmt->insert_id;
    $stmt->close();

    // Insert purchase items if any
    if (!empty($items)) {
        $stmt = $conn->prepare("INSERT INTO purchase_items (purchase_id, item_name, item_price) VALUES (?, ?, ?)");
        foreach ($items as $item) {
            $itemName = htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8');
            $itemPrice = floatval($item['price']);
            $stmt->bind_param("isd", $purchaseId, $itemName, $itemPrice);

            if (!$stmt->execute()) {
                throw new Exception("Item insert failed for: $itemName, " . $stmt->error);
            }
        }
        $stmt->close();
    }

    // Commit transaction
    $conn->commit();

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'warunadesigns@gmail.com';  // Your email address
    $mail->Password = 'gxnu znaq luof auom';  // Your app-specific password
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;  // Correct encryption type for port 465
    $mail->Port = 465;  // SSL port for Gmail

    // Enable debugging
    $mail->SMTPDebug = 2;  // Show detailed debug output

    // Sender's email and recipient's email
    $mail->setFrom('no-reply@yourdomain.com', 'BODY ENGINEERING');
    $mail->addAddress($userEmail, $userName);  // Recipient's email

    // Email subject and body content
    $subject = "Your Purchase Confirmation";
    $message = "<h2>Thank you for your purchase, $userName!</h2>";
    $message .= "<p><strong>Shipping Address:</strong> $shippingAddress</p>";
    $message .= "<p><strong>Payment Method:</strong> $paymentMethod</p>";
    $message .= "<h3>Purchased Items:</h3>";
    $message .= "<ul>";
    foreach ($items as $item) {
        $message .= "<li>{$item['title']} - Rs{$item['price']}</li>";
    }
    $message .= "</ul>";
    $message .= "<h3>Total Price: Rs $totalPrice</h3>";

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send email
    if ($mail->send()) {
        // Email sent successfully
        echo "<script>
        alert('Purchased successfully!');
        window.location.href = 'dashboard/'; // Redirect to dashboard
        localStorage.removeItem('cart'); // Remove the cart from localStorage
    </script>";
    } else {
        // Email sending failed
        throw new Exception("Error sending email: " . $mail->ErrorInfo);
    }


} catch (Exception $e) {
    // Rollback in case of an error
    $conn->rollback();
    echo "Failed to save purchase: " . $e->getMessage();
}
?>
