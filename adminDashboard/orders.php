<?php
include '../config/db.php';

// Initialize an array to store error messages
$errors = [];

// Fetch purchases along with the user and item details
$query = "
       SELECT p.purchase_id, p.user_email, p.user_name, p.total_price, p.purchase_date, p.shipping_address, p.payment_method, 
              pi.item_id, pi.item_name, pi.item_price
       FROM purchases p
       LEFT JOIN purchase_items pi ON p.purchase_id = pi.purchase_id
   ";
$purchaseData = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Purchase Management</title>
</head>
<body>
    <?php include './topbar/topbar.php' ?>
    <?php include './sidebar/sidebar.php' ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3>Purchase Management</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <h4>Purchase Details</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Purchase ID</th>
                                <th>User Email</th>
                                <th>User Name</th>
                                <th>Total Price</th>
                                <th>Purchase Date</th>
                                <th>Shipping Address</th>
                                <th>Payment Method</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($purchaseData)): ?>
                                    <?php foreach ($purchaseData as $purchase): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($purchase['purchase_id']) ?></td>
                                                <td><?= htmlspecialchars($purchase['user_email']) ?></td>
                                                <td><?= htmlspecialchars($purchase['user_name']) ?></td>
                                                <td><?= htmlspecialchars($purchase['total_price']) ?></td>
                                                <td><?= htmlspecialchars($purchase['purchase_date']) ?></td>
                                                <td><?= htmlspecialchars($purchase['shipping_address']) ?></td>
                                                <td><?= htmlspecialchars($purchase['payment_method']) ?></td>
                                                <td><?= htmlspecialchars($purchase['item_name']) ?></td>
                                                <td><?= htmlspecialchars($purchase['item_price']) ?></td>
                                            </tr>
                                    <?php endforeach; ?>
                            <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No purchases found.</td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
