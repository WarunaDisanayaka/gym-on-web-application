<?php
// Include the database connection
include './config/db.php';

// Fetch products from the database
$sql = "SELECT * FROM products";  // Adjust the table name as needed
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
  // Fetch all products into an array
  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
} else {
  echo "No products found";
}
?>

<!DOCTYPE html>

<html lang="en">


<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:26 GMT -->
<head>

  <!-- Meta Options -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Title -->
   <title>Product</title>
  <!-- Bootstrap -->

  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="assets/images/heading-icon.png">
  <link rel="stylesheet" href="assets/font/flaticon_mycollection.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css"> 
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/nice-select.css">
  <!-- Stylesheet -->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
  <link rel="stylesheet" type="text/css" href="assets/css/style-dark.css"> 
  <!-- Responsive -->
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
 
</head>
 
<body class="light-d">
    <!-- Loader Start -->
    <div class="color-group"> 
  <div class="icon-color">
    <i class="fa-solid fa-gear"></i>
  </div>
  <ul class="color-grid">
    <li class="color-option is-selected" data-color="#ea2127"></li>
    <li class="color-option" data-color="#c8a01c"></li>
    <li class="color-option" data-color="#aad804"></li>
    <li class="color-option" data-color="#f16e24"></li>
    <li class="color-option" data-color="#b8653b"></li>
    <li class="color-option" data-color="#1e51b8"></li>
    <li class="color-option" data-color="#d61c50"></li>
    <li class="color-option" data-color="#7ba12b"></li>
  </ul>
</div>
  <div class="preloader">
    <div class="loader-wrap-heading">
      <div class="load-text"> <span>L</span> <span>o</span> <span>a</span> <span>d</span> <span>i</span> <span>n</span> <span>g</span> </div>
    </div>
  </div>
  <!-- Loader End -->

  <!-- Header Style One Start -->
  <?php include './header/header.php' ?>

  <!-- Header Style One End -->

  <!-- Banner Style One Start -->
  <section class="banner-style-one">
    <div class="parallax" style="background-image: url(assets/images/pattren-3.png);"></div>
    <div class="container">
      <div class="row">
        <div class="banner-details">
          <h2>Product</h2>
          <p>our values and vaulted us to the top of our industry.</p>
        </div>
      </div>
    </div>
    <div class="breadcrums">
      <div class="container">
        <div class="row">
          <ul>
            <li>
              <a href="index.html">
                <i class="fa-solid fa-house"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="current">
              <p>Product </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Banner Style One End -->

  <!-- Shop Style One Start -->
  <section class="gap shop-style-one addition">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="shop-filter">
            <p>145 Products</p>
            <div class="gird-list d-flex-all">
              <a class="d-flex-all list" href="javascript:void(0)">
                <i class="fa-solid fa-list"></i>
              </a>
              <a class="d-flex-all grid" href="javascript:void(0)">
                <i class="fa-solid fa-table-list"></i> 
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
    <div class="row p-slider align-items-center justify-content-between grid">
        <?php foreach ($products as $product): ?>
              <div class="col-lg-4">
                  <div class="product">
                      <div class="main-data">
                          <div class="btn-hover">
                              <figure>
                                  <img src="./adminDashboard/<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                              </figure>
                              <a href="cart.php" class="theme-btn">Add to Cart <i class="fa-solid fa-bag-shopping"></i></a>
                          </div>
                          <div class="data">
                              <div class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <span>5.0</span> <!-- Replace with actual rating if you have it -->
                              </div>
                              <h3><a href="product-detail.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['product_name']); ?></a></h3>
                              <div class="price-range">
                                  <span>Rs <?php echo number_format($product['price'], 2); ?></span>
                              </div>
                          </div>
                      </div>
                      <a href="cart.php" class="theme-btn">Add to Cart <i class="fa-solid fa-bag-shopping"></i></a>
                  </div>
              </div>
        <?php endforeach; ?>
    </div>
</div>

    <!-- <div class="container" >
      <div class="row">
        <div class="gym-pagination">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="JavaScript:void(0)"><i class='fa-solid fa-arrow-left-long'></i></a></li>
              <li class="page-item"><a class="page-link" href="JavaScript:void(0)">01</a></li>
              <li class="page-item"><a class="page-link" href="JavaScript:void(0)">02</a></li>
              <li class="page-item"><a class="page-link" href="JavaScript:void(0)">03</a></li>
              <li class="page-item space"><a class="page-link" href="JavaScript:void(0)">..........</a></li>
              <li class="page-item"><a class="page-link" href="JavaScript:void(0)">08</a></li>
              <li class="page-item"><a class="page-link" href="JavaScript:void(0)"><i class='fa-solid fa-arrow-right-long'></i> </a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div> -->
  </section>
  <!-- Shop Style One End -->

  <!-- Footer Style One Start -->
  <?php include './footer/footer.php' ?>

  <!-- Footer Style One End -->

    <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>

    <div class="modal fade popups conslt-popup" id="exampleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="assets/images/crain.jpg" alt="img">
            <div class="contact-form-one popup">
              <div class="c-form-2">
                <h3>Start Consulting</h3>
                <div class="parallax" style="background-image: url(assets/images/pattren.html);"></div>
                <form>
                  <div class="row g-0">
                    <input type="text" class="form-control" id="exampleInputText1"  placeholder="Complete Name">
                  </div>
                  <div class="row g-0">
                    <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Email Address">
                  </div>
                  <div class="row g-0">
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone No">
                  </div>
                  <div class="row g-0">
                    <select id="inputState-21" class="form-control">
                      <option selected>Subject</option>
                      <option>Subject 1</option>
                      <option>Subject 2</option>
                      <option>Subject 3</option>
                    </select>
                  </div>
                  <div class="row g-0">
                    <textarea placeholder="Question / Message?"></textarea>
                  </div>
                  <button type="submit" class="theme-btn">Submit Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Jquery -->

  <script src="assets/js/jquery.min.js"></script>

  <!-- Waypoint -->

  <script src="assets/js/jquery.waypoints.min.js"></script>


  <!-- Counter -->

  <script src="assets/js/jquery.counterup.min.js"></script>

  <!-- Bootstrap Js -->

  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Fancybox Js -->

  <script src="assets/js/jquery.fancybox.min.js"></script>

  <!-- Nice Select Js -->

  <script src="assets/js/jquery.nice-select.js"></script> 

  <!-- Owl Carousal Js -->

  <script src="assets/js/owl.carousel.min.js"></script>

  <!-- Custom Js -->

  <script src="assets/js/custom.js"></script>

  <script>
    // JavaScript to handle Add to Cart
document.querySelectorAll('.theme-btn').forEach((btn) => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();

    // Get the product data
    const product = btn.closest('.product');
    const title = product.querySelector('h3 a').innerText;
    const price = product.querySelector('.price-range span').innerText;
    const image = product.querySelector('img').src;

    // Create an object for the product
    const cartItem = {
      title,
      price,
      image,
    };

    // Retrieve cart from localStorage or initialize an empty array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(cartItem); // Add new item to the cart
    localStorage.setItem('cart', JSON.stringify(cart)); // Save cart back to localStorage

    alert(`${title} added to cart!`);
  });
});

  </script>
</body>


<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:28 GMT -->
</html>
