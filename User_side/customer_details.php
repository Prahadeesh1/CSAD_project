<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PrismVerse Cinematics - Singapore's Leading Cinema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../User_side/CSS/customer.css" />
</head>

<body>
  <!-- Header Navigation -->
  <div class="navbar">
    <img src="images/logo.png" alt="Logo" />
    <nav>
      <a href="#">Movies</a>
      <a href="cinemas.html">Cinemas</a>
      <a href="#">Experiences</a>
      <a href="#">Shop</a>
      <a href="#">Events Booking</a>
    </nav>
  </div>

  <main class="chosen_moviedetails">
    <div class="row align-item-start">
      <div class="col-md-4 poster-container">
        <img src="images/transformersposter.jpg" alt="Poster" />
      </div>

      <div class="col-md-8">
        <div class="selection-header">
          <p>You have selected</p>
          <h3 id="extra-details-h3">TRANSFORMER: THE LAST KNIGHT</h3>
        </div>
        <div class="extra-details">
          <div>Date: </div>
          <div>Time: </div>
          <div>Cinema </div>
          <div>Seat Selected: </div>
        </div>
        <h3 id="ticket-price">Total Price: $10</h3>

        <div class="customer-form">
          <form id="customer-details">

            <div class="mb-3">
              <label for="input-name" class="form-label">Name *</label>
              <input type="text" class="form-control" required="" placeholder="Enter your name">
            </div>

            <div class="mb-3">
              <label for="input-tel" class="form-label">Contact Number *</label>
              <input type="tel" class="form-control" required="" placeholder="+65 xxxx xxxx">
            </div>

            <div class="mb-3">
              <label for="input-email" class="form-label">Email Address *</label>
              <input type="email" class="form-control" required="" placeholder="name@example.com">
            </div>


            <div class="d-flex justify-content-center">
              <a href="seat_selection.php"><button type="button" id="button-return" class="btn btn-primary">Return to Seat Selection</button></a>
              <a href="payment.php"><button type="submit" id="button-next" class="btn btn-primary">Next</button></a>
          </form>
        </div>
      </div>
    </div>
    </div>
  </main>

  <!-- Footer Section -->
  <footer>
    <div class="footer-links">
      <div class="footer-column">
        <h3>HOME</h3>
        <ul>
          <li><a href="#">Log In/Register</a></li>
          <li>
            <a href="../Admin_side/Login_Admin.html">Admin Page</a>
          </li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>LEGAL</h3>
        <ul>
          <li><a href="termsandconditions.html">Terms & Conditions</a></li>
          <li><a href="privacypolicy.html">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>CUSTOMER SERVICES</h3>
        <ul>
          <li><a href="contactus.html">Contact Us</a></li>
          <li><a href="faqs.html">FAQs</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>ABOUT</h3>
        <ul>
          <li><a href="aboutpvc.html">About PVC</a></li>
          <li><a href="careers.html">Careers</a></li>
        </ul>
      </div>
    </div>
    <!-- Follow Us Section -->
    <div class="footer-social">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a
          href="https://www.facebook.com/"
          class="social-icon facebook"
          target="_blank">
          <img src="images/facebook.jpg" alt="Facebook" class="social-img" />
        </a>
        <a
          href="https://x.com/?lang=en"
          class="social-icon X"
          target="_blank">
          <img src="images/x.jpg" alt="X" class="social-img" />
        </a>
        <a
          href="https://www.instagram.com/"
          class="social-icon instagram"
          target="_blank">
          <img
            src="images/instagram.jpg"
            alt="Instagram"
            class="social-img" />
        </a>
      </div>
    </div>
    <p>&copy; 2024 PrismVerse Cinematics Pte Ltd. All rights reserved.</p>
  </footer>