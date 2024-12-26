<?php
// Include the database connection file
include './config/db.php';

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Query to fetch product details based on the ID
  $sql = "SELECT * FROM products WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $product_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Fetch product data
  if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
  } else {
    echo "Product not found!";
    exit;
  }
} else {
  echo "Invalid product ID!";
  exit;
}
?>
<!DOCTYPE html>

<html lang="en">


<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/product-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:28 GMT -->
<head>

  <!-- Meta Options -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Title -->
   <title>Product Detail</title>
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
          <h2>Product Detail</h2>
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
              <p>Product Detail</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Banner Style One End -->

    <!-- Product Detail Start -->
  <section class="gap  product-detail light-bg-color">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="pd-gallery">
            <ul class="pd-imgs">
              <li class="li-pd-imgs">
                <a href="JavaScript:void(0)">
                <img src="./adminDashboard/<?php echo $product['image_path']; ?>" alt="Product Image">
                </a>
              </li>
              
            </ul>
            <div class="pd-main-img">
              <img id="NZoomImg" data-NZoomscale="2" style="width: 100%;height: 100%;" src="./adminDashboard/<?php echo $product['image_path']; ?>" alt="Product Detail Image">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="pd-data">
            <div class="ratings">
              <i class="fa-solid fa-star"></i>
              <span>5.0</span>
            </div>
            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <div class="pd-quality">
              <span>Quantity</span>
              <input type="number" name="number" value="1">
            </div>
            <ul class="pd-price">
              <li class="pd-sale-price"><span>Rs</span><?php echo $product['price']; ?></li>
            </ul>
            <p class="free-ship">Free Shipping On This Item</p>
            <a href="javascript:void(0)" class="theme-btn add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>" 
    data-title="<?php echo htmlspecialchars($product['product_name']); ?>"
    data-price="<?php echo $product['price']; ?>"
    data-image="<?php echo './adminDashboard/' . $product['image_path']; ?>">Add to Cart</a>
            <div class="pd-cat-tags">
              <ul>
                <li>
                  <span class="theme-bg-clr font-bold">Sku:</span>
                  <ul class="pd-sku">
                    <li>2CSTD7</li> 
                  </ul>
                </li>
                <li>
                  <span class="theme-bg-clr font-bold">Category:</span>
                  <ul class="pd-cat">
                    <li><a href="JavaScript:void(0)">Gym</a></li>
                    <li><a href="JavaScript:void(0)">Workout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="gap detail-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="pd-details">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Description</button>
                
              </div>
            <div class="more d-flex align-items-start">
               <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  <div class="des-tab">
                    <h3>About Product</h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <ul class="sm-circle">
                      <li>Experience that drives retention and sales</li>
                      <li>Nurturing and empowering the environment</li>
                      <li>The place you go to unwind, socialize & work out</li>
                    </ul>
                    
                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Product Detail End --> 
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

  <!-- NZoom -->

  <script src="assets/js/Nzoom.min.js"></script>

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
  document.querySelectorAll('.add-to-cart-btn').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();

      // Get product data from the button's data attributes
      const title = btn.getAttribute('data-title');
      const price = btn.getAttribute('data-price');
      const image = btn.getAttribute('data-image');

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

      // Alert the user that the item was added to the cart
      alert(`${title} added to cart!`);
    });
  });
</script>
</body>


<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/product-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:32 GMT -->
</html>
