<?php
$package = $_GET['package'] ?? 'Unknown';
$price = $_GET['price'] ?? '0';

// Example usage
// echo "You selected the $package package for $$price.";
?>

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
    <form action="process-payment.php" method="POST" id="payment-form">
      
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-8 col-md-12">
                <div class="billing">
                  <h3>Billing Address</h3>
                    <div class="row">
                      <div class="col-md-12">
                        <input type="text" name="text" placeholder="Complete Name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <input type="email" name="email" placeholder="Email Address">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <input type="text" name="text" placeholder="Company Name">
                      </div>
                    </div>
                    
                    <div class="row dist">
                      <div class="col-md-6">
                        <input type="number" name="number" placeholder="Postal Code">
                      </div>
                      <div class="col-md-6">
                        <input type="number" name="number" placeholder="Phone No">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <input type="text" name="text" placeholder="Address">
                      </div>
                    </div>
                    
                </div>
              </div>
              <div class="col-lg-4 col-md-12">
                <div class="order-note">
                  <h3>Order Note</h3>
                  <textarea placeholder="Order Note"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="cart-t-payment-m">
                <div class="cart-total-box">
                   <div class="final">
                    <h4>Cart Total</h4>
                    <ul>
                    <li>
                <span>Package:</span>
                <span><?php echo htmlspecialchars($package); ?></span>
            </li>
                      <li>
                        <span>Shipping:</span>
                        <span>$0.00</span>
                      </li>
                    </ul>
                  </div>
                  <div class="total">
                    <ul>
                    <li>
                <span>Subtotal:</span>
                <span id="amount">$<?php echo htmlspecialchars($price); ?></span>
                <input type="hidden" name="amount" value="<?php echo htmlspecialchars($price); ?>">
                <input type="hidden" name="package" value="<?php echo htmlspecialchars($package); ?>">

            </li>
                    </ul>
                  </div>
                </div>
                <div class="payment-method">
                  <h3>Payment Method</h3>
                    <!-- <div class="row checkk g-0">
                      <div class="form-group col-md-12">
                        <div class="custom-control custom-radio">
                          <input checked type="checkbox" id="customRadio1" name="customRadio" class="custom-control-input">
                          <label class="custom-control-label" for="customRadio1">Bank Payment</label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="custom-control custom-radio">
                          <input type="checkbox" id="customRadio21" name="customRadio" class="custom-control-input">
                          <label class="custom-control-label" for="customRadio21">Check Payment</label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="custom-control custom-radio">
                          <input type="checkbox" id="customRadio22" name="customRadio" class="custom-control-input">
                          <label class="custom-control-label" for="customRadio22">PayPal
                              <img src="assets/images/cards.png" alt="Bank Cards">
                          </label>
                        </div>
                      </div>
                    </div> -->
                    <div id="card-element">
                          <!-- A Stripe Element will be inserted here. -->
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
<script>
  // Create a Stripe client
var stripe = Stripe('pk_test_63t8nT9v0tVZoAnVDON58Btf'); // Replace with your Publishable Key

// Create an instance of Elements
var elements = stripe.elements();

// Custom styling for the card Element
var style = {
    base: {
        color: 'white', // Set text color to white
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSize: '16px',
        '::placeholder': {
            color: '#b3b3b3', // Placeholder text color
        },
    },
    invalid: {
        color: '#fa755a', // Text color for invalid inputs
        iconColor: '#fa755a', // Icon color for invalid inputs
    },
};

// Create an instance of the card Element with the custom style
var card = elements.create('card', { style: style });

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

// Handle real-time validation errors from the card Element
card.addEventListener('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function (event) {
    event.preventDefault();

    stripe.createToken(card).then(function (result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    });
});

  
</script>

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
