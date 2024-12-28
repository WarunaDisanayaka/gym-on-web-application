<?php
session_start();

// Get the current page
$current_page = basename($_SERVER['PHP_SELF']);

// Check if the current page is checkout.php
if ($current_page === 'product-checkout.php') {
   // Verify if the user is logged in
   if (!isset($_SESSION['user_id'])) {
      // If not logged in, redirect to the login page
      header("Location: login.php");
      exit();
   }
}

?>
<script>
   document.addEventListener("DOMContentLoaded", () => {
    // Retrieving cart items from local storage
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

    // Selecting the Cart Items container and subtotal elements
    const cartItemsContainer = document.querySelector(".cart-total-box .final ul");
    const subtotalElement = document.querySelector("#amount"); // Subtotal display element
    const hiddenTotalPriceInput = document.querySelector('input[name="total_price"]'); // Hidden input for total price

    let subtotal = 0; // Initialize subtotal

    // Check if the container exists
    if (cartItemsContainer) {
        if (cartItems.length > 0) {
            // Dynamically add cart items to the container
            cartItems.forEach(item => {
                const listItem = document.createElement("li");
                listItem.innerHTML = `
                    <span>${item.title}:</span> 
                    <span>${item.price}</span>`;
                cartItemsContainer.appendChild(listItem);

                // Parse and add item price to subtotal (removing non-numeric characters)
                subtotal += parseFloat(item.price.replace(/[^0-9.-]+/g, ""));
            });

            // Update the subtotal element with the calculated total
            subtotalElement.textContent = `RS ${subtotal.toFixed(2)}`;
        } else {
            // Show "No items in the cart" message if the cart is empty
            cartItemsContainer.innerHTML = "<li><span>No items in the cart.</span></li>";
        }
    } else {
        console.error("Cart Items container not found.");
    }

    // Update the hidden input with the subtotal value
    if (hiddenTotalPriceInput) {
        hiddenTotalPriceInput.value = subtotal.toFixed(2);
    }
});

   document.addEventListener("DOMContentLoaded", () => {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const hiddenItemsInput = document.getElementById("cart-items-json");

    if (hiddenItemsInput) {
        hiddenItemsInput.value = JSON.stringify(cartItems);
    }
});

</script>
<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:32 GMT -->
   <head>
      <!-- Meta Options -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Title -->
      <title>Checkout</title>
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
                  <h2>Checkout</h2>
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
                        <p>Checkout</p>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <!-- Banner Style One End -->
      <!-- Cart Start -->
      <section class="gap checkout detail-page">
      <form action="checkout-process.php" method="POST" id="payment-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="billing">
                            <h3>Billing Address</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="name" placeholder="Complete Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="email" name="email" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="company" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="row dist">
                                <div class="col-md-6">
                                    <input type="number" name="postal_code" placeholder="Postal Code" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="phone" placeholder="Phone No" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="address" placeholder="Address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="order-note">
                            <h3>Order Note</h3>
                            <textarea name="order_note" placeholder="Order Note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="cart-t-payment-m">
                        <div class="cart-total-box">
                            <div class="final">
                                <h4>Cart Items</h4>
                                <ul id="cart-items-list"></ul>
                                <input type="hidden" name="items" id="cart-items-json">

                            </div>
                            <div class="total">
                                <ul>
                                    <li>
                                        <span>Subtotal:</span>
                                        <span id="amount">Rs</span>
                                        <input type="hidden" name="total_price"> 
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-method">
                            <h3>Payment Method</h3>
                            <div class="row checkk g-0">
                                <div class="form-group col-md-12">
                                    <div class="custom-control custom-radio">
                                        <input checked type="checkbox" id="customRadio1" name="payment_method" value="Cash On Delivery" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="theme-btn">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

      </section>
      <!-- Cart End -->
      <!-- Footer Style One Start -->
      <?php include './footer/footer.php' ?>
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
      <!-- Footer Style One End -->
      <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>
      <script src="https://js.stripe.com/v3/"></script>
      
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
   </body>
   <!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:33 GMT -->
</html>