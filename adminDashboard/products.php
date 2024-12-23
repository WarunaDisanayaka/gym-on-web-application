<?php
   include '../config/db.php';
   
   // Initialize an array to store error messages
   $errors = [];
   
   // Handle form submission for adding/updating products
   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'])) {
       $productName = trim($_POST['product_name'] ?? '');
       $price = trim($_POST['price'] ?? '');
       $category = trim($_POST['category'] ?? '');
       $quantity = trim($_POST['quantity'] ?? '');
       $description = trim($_POST['description'] ?? '');
       $imagePath = null;
   
       // Server-side validation
       if (empty($productName)) {
           $errors['product_name'] = 'Product name is required.';
       }
       if (!is_numeric($price) || $price <= 0) {
           $errors['price'] = 'Price must be a positive number.';
       }
       if (empty($category)) {
           $errors['category'] = 'Category is required.';
       }
       if (!is_numeric($quantity) || $quantity < 0) {
           $errors['quantity'] = 'Quantity must be a non-negative number.';
       }
   
       // Handle file upload
       if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
           $targetDir = "uploads/";
           $targetFile = $targetDir . basename($_FILES['image']['name']);
           $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
   
           // Validate file type
           if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
               $errors['image'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.';
           } elseif (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
               $errors['image'] = 'Error uploading file.';
           } else {
               $imagePath = $targetFile;
           }
       }
   
       // If no errors, proceed to insert or update the product
       if (empty($errors)) {
           if (isset($_POST['product_id'])) {
               // Update product
               $productId = $_POST['product_id'];
               $query = "UPDATE products SET product_name=?, price=?, category=?, quantity=?, description=?, image_path=? WHERE id=?";
               $stmt = $conn->prepare($query);
               $stmt->bind_param('sdsissi', $productName, $price, $category, $quantity, $description, $imagePath, $productId);
           } else {
               // Add product
               $query = "INSERT INTO products (product_name, price, category, quantity, description, image_path) VALUES (?, ?, ?, ?, ?, ?)";
               $stmt = $conn->prepare($query);
               $stmt->bind_param('sdsiss', $productName, $price, $category, $quantity, $description, $imagePath);
           }
   
           if ($stmt->execute()) {
               header("Location: products.php");
               exit;
           } else {
               $errors['database'] = "Database error: " . $stmt->error;
           }
       }
   }
   
   // Handle delete request
   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
       $productId = $_POST['delete_id'];
   
       $query = "DELETE FROM products WHERE id=?";
       $stmt = $conn->prepare($query);
       $stmt->bind_param('i', $productId);
   
       if ($stmt->execute()) {
           echo "Success";
           exit;
       } else {
           echo "Error: " . $stmt->error;
           exit;
       }
   }
   
   // Fetch products to display
   $query = "SELECT * FROM products";
   $productData = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
      <link rel="stylesheet" href="css/style.css" />
      <title>Product Management</title>
   </head>
   <body>
      <?php include './topbar/topbar.php' ?>
      <?php include './sidebar/sidebar.php' ?>
      <main class="mt-5 pt-3">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <h3>Product Management</h3>
               </div>
            </div>
            <form action="products.php" method="post" id="productForm" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <div class="mb-3">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" class="form-control <?= isset($errors['product_name']) ? 'is-invalid' : '' ?>" id="product_name" />
                        <div class="invalid-feedback"><?= $errors['product_name'] ?? '' ?></div>
                     </div>
                     <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="number" step="0.01" name="price" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" id="price" />
                        <div class="invalid-feedback"><?= $errors['price'] ?? '' ?></div>
                     </div>
                     <div class="mb-3">
                        <label for="category">Category:</label>
                        <input type="text" name="category" class="form-control <?= isset($errors['category']) ? 'is-invalid' : '' ?>" id="category" />
                        <div class="invalid-feedback"><?= $errors['category'] ?? '' ?></div>
                     </div>
                     <div class="mb-3">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" id="description" rows="3"></textarea>
                        <div class="invalid-feedback"><?= $errors['description'] ?? '' ?></div>
                     </div>
                  </div>
                  <div class="col-md-6 mb-3">
                     <div class="mb-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" class="form-control <?= isset($errors['quantity']) ? 'is-invalid' : '' ?>" id="quantity" />
                        <div class="invalid-feedback"><?= $errors['quantity'] ?? '' ?></div>
                     </div>
                     <div class="mb-3">
                        <label for="image">Product Image:</label>
                        <input type="file" name="image" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>" id="image" accept="image/*" />
                        <div class="invalid-feedback"><?= $errors['image'] ?? '' ?></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 text-center">
                     <button type="submit" class="btn btn-primary">Add Product</button>
                  </div>
               </div>
            </form>
            <div class="row mt-5">
               <div class="col-md-12">
                  <h4>Your Products</h4>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Product Name</th>
                           <th>Price</th>
                           <th>Category</th>
                           <th>Description</th>
                           <th>Quantity</th>
                           <th>Image</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if (!empty($productData)): ?>
                        <?php foreach ($productData as $index => $product): ?>
                        <tr id="row-<?= $product['id'] ?>">
                           <td><?= $index + 1 ?></td>
                           <td><?= htmlspecialchars($product['product_name']) ?></td>
                           <td><?= htmlspecialchars($product['price']) ?></td>
                           <td><?= htmlspecialchars($product['category']) ?></td>
                           <td><?= htmlspecialchars($product['description']) ?></td>
                           <td><?= htmlspecialchars($product['quantity']) ?></td>
                           <td>
                              <?php if (!empty($product['image_path'])): ?>
                              <img src="<?= htmlspecialchars($product['image_path']) ?>" alt="Product Image" style="width: 50px; height: auto;" />
                              <?php endif; ?>
                           </td>
                           <td>
                              <a href="products.php?edit_id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                              <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $product['id'] ?>">Delete</button>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                           <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                        <?php endif; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </main>
      <script>
         document.querySelectorAll('.delete-btn').forEach(btn => {
             btn.addEventListener('click', () => {
                 if (confirm('Are you sure you want to delete this product?')) {
                     const productId = btn.getAttribute('data-id');
                     fetch('products.php', {
                         method: 'POST',
                         headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                         body: `delete_id=${productId}`
                     })
                     .then(response => response.text())
                     .then(result => {
                         if (result === 'Success') {
                             document.getElementById(`row-${productId}`).remove();
                         } else {
                             alert('Error deleting product: ' + result);
                         }
                     });
                 }
             });
         });
      </script>
   </body>
</html>