<?php
include '../config/db.php';

// Initialize an array to store error messages
$errors = [];

// Fetch contact submissions
$query = "
    SELECT 
        id, 
        complete_name, 
        email_address, 
        phone_no, 
        message, 
        submitted_at 
    FROM contact_form_submissions
";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error); // Debugging output
}

$contactData = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Contact Submissions</title>
</head>
<body>
    <?php include './topbar/topbar.php' ?>
    <?php include './sidebar/sidebar.php' ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            
            <div class="row mt-5">
                <div class="col-md-12">
                    <h4>Submission Details</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($contactData)): ?>
                                <?php foreach ($contactData as $submission): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($submission['id']) ?></td>
                                        <td><?= htmlspecialchars($submission['complete_name']) ?></td>
                                        <td><?= htmlspecialchars($submission['email_address']) ?></td>
                                        <td><?= htmlspecialchars($submission['phone_no']) ?></td>
                                        <td><?= htmlspecialchars($submission['message']) ?></td>
                                        <td><?= htmlspecialchars($submission['submitted_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No contact submissions found.</td>
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
