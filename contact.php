<?php
require './config/db.php'; // Include your db connection script

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $completeName = mysqli_real_escape_string($conn, $_POST['CompleteName']);
  $emailAddress = mysqli_real_escape_string($conn, $_POST['EmailAddress']);
  $phoneNo = mysqli_real_escape_string($conn, $_POST['PhoneNo']);
  $message = mysqli_real_escape_string($conn, $_POST['Message']);

  // SQL query to insert data into the contact_form table
  $sql = "INSERT INTO contact_form_submissions (complete_name, email_address, phone_no, message)
            VALUES ('$completeName', '$emailAddress', '$phoneNo', '$message')";

  // Execute the query
  if (mysqli_query($conn, $sql)) {
    echo "Your message has been sent successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
} else {
  echo "Invalid request method.";
}
?>


<!DOCTYPE html>

<html lang="en">


<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:47 GMT -->
<head>

  <!-- Meta Options -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Title -->
   <title>contact</title>
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
          <h2>Contact Us</h2>
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
              <p>Contact Us</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Banner Style One End -->

  <!-- Contact Form 2 Start -->
  <section class="gap contact-form-2">
    <div class="heading">
      <figure>
        <img src="assets/images/heading-icon.png" alt="Heading Icon">
      </figure>
      <span>Frequently asked question</span>
      <h2>Hello Guys Have Question? FEEL FREE TO ASK US ANYTHING</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-7" >
          <div class="data">
           <p>Have questions or want to chat? Fill out our contact form, and we’ll put you in touch with the right people.</p>
            <form class="content-form" id="contact-form" method="post" action="contact.php">
               <div class="row g-0">
                <input type="text" name="CompleteName" placeholder="Complete Name" required="">
               </div>
              <div class="row g-0">
                <input type="email" name="EmailAddress" placeholder="Email Address" required="">
              </div>
              <div class="row g-0">
                <input type="number" name="PhoneNo" placeholder="Phone No" required="">
              </div>
              <div class="row g-0">
                <input type="text" name="Message" placeholder="Message" required="" rows="3">
              </div>
              <button type="submit" class="theme-btn">Send Message </button>
            </form>
          </div>
        </div>
        <div class="col-lg-5" >
          <div class="info">
            <ul class="contact">
              <li>
                <i class="flaticon-maps"></i>
                <div>
                  <h3>Address:</h3>
                  <p>123 Galle Road, Colombo 03, Sri Lanka</p>
                </div>
              </li>
              <li>
                <i class="flaticon-iphone"></i>
                <div>
                  <h3>Telephone:</h3>
                  <a href=""> (+94) 77 445 6677</a>
                </div>
              </li>
              <li class="pb-0">
                <i class="flaticon-mail"></i>
                <div>
                  <h3>Email:</h3>
                  <a href="">info@bodyengineering.lk</a>
                </div>
              </li>
            </ul> 
          </div>
        </div>
      </div>
    </div>
  </section>
  
 
  <!-- Contact Faqs End -->

  <!-- Contact Map Start -->
 
  <!-- Contact Map End -->

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
  <script src="assets/js/sweetalert.min.js"></script>
  <script src="assets/js/contact.js"></script>

  <!-- Custom Js -->

  <script src="assets/js/custom.js"></script>
</body>


<!-- Mirrored from winsfolio.net/html/gymon/gym-on-drak/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Nov 2024 11:19:47 GMT -->
</html>
