<?php
$movies = json_decode(file_get_contents("http://localhost/CSAD_Project/Praha's%20one/CSAD_project/Admin_side/movie_api.php"), true);

if (isset($_GET['id'], $_GET['seats'], $_GET['price'])) {
    $movieId = $_GET['id'];
    $seats = explode(',', $_GET['seats']);
    $totalPrice = $_GET['price'];

    $apiUrl = "http://localhost/CSAD_Project/Praha's%20one/CSAD_project/Admin_side/movie_api.php";
    
    // Fetch the movies data from the API
    $moviesData = json_decode(file_get_contents($apiUrl), true);

    if ($moviesData['success']) {
      // Search for the selected movie in the API response
      $selectedMovie = null;
      $selectedMovieDate = null;
  
      foreach ($moviesData['movies'] as $movie) {
          if ($movie['id'] == $movieId) {
              $selectedMovie = $movie;
              break; // Movie found, exit loop early
          }
      }
  
      if (!$selectedMovie) {
          echo "<p>Movie not found.</p>";
          exit;
      }
  
      // Search for screenings of the selected movie
      foreach ($moviesData['screenings'] as $screening) {
          if ($screening['id'] == $movieId) { // Ensure screening references the correct movie
              $selectedMovieDate = $screening;
          }
      }
      if (!$selectedMovieDate) {
        echo "<p> No scheduled screenings available.</p>";
        exit;
    }

  } else {
      echo "<p>Failed to fetch movie data.</p>";
      exit;
  }
}
?>


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
      <a href="moviesection.php">Movies</a>
      <a href="cinemas.html">Cinemas</a>
      <a href="#">Experiences</a>
      <a href="#">Shop</a>
      <a href="#">Events Booking</a>
    </nav>
  </div>

  <main class="chosen_moviedetails">
    <div class="row align-item-start">
      <div class="col-md-4 poster-container">
        <img src="<?php echo htmlspecialchars($selectedMovie['cover']); ?>" alt="Poster" />
      </div>

      <div class="col-md-8">
        <div class="selection-header">
          <p>You have selected</p>
          <h3 id="extra-details-h3"><?php echo htmlspecialchars($selectedMovie['title']); ?></h3>
        </div>
        <div class="extra-details">
          <div>Date: <?php echo htmlspecialchars($selectedMovieDate['day']) . " " 
        . htmlspecialchars($selectedMovieDate['month']). " " 
        . htmlspecialchars($selectedMovieDate['dayofWeek']); ?></div>
          <div>Time: <?php echo htmlspecialchars($selectedMovieDate['time']); ?></div>
          <div>Theater: <?php echo htmlspecialchars($selectedMovieDate['theater']); ?></div>
          <div>Seat Selected: <?php echo  htmlspecialchars(implode(', ', $seats)); ?></div>
        </div>
        <h3 id="ticket-price">Total Price: $<?php echo $totalPrice; ?></h3>

        <div class="customer-form">
          <form id="customer-details" action="orders.php" method="post">
            <input type="hidden" name="theater" value="<?php echo htmlspecialchars($selectedMovieDate['theater']); ?>">
            <input type="hidden" name="seats" value="<?php echo htmlspecialchars(implode(',', $seats)); ?>">
            <input type="hidden" name="day" value="<?php echo htmlspecialchars($selectedMovieDate['day']); ?>">
            <input type="hidden" name="month" value="<?php echo htmlspecialchars($selectedMovieDate['month']); ?>">
            <input type="hidden" name="price" value="<?php echo $totalPrice; ?>">

            <div class="mb-3">
              <label for="input-name" class="form-label">First Name *</label>
              <input type="text" class="form-control" required="" placeholder="Enter your name" name="fname">
            </div>

            <div class="mb-3">
              <label for="input-name" class="form-label">Last Name *</label>
              <input type="text" class="form-control" required="" placeholder="Enter your name" name="lname">
            </div>

            <div class="mb-3">
              <label for="input-tel" class="form-label">Contact Number *</label>
              <input type="tel" class="form-control" required="" placeholder="+65 xxxx xxxx" name="number">
            </div>

            <div class="mb-3">
              <label for="input-email" class="form-label">Email Address *</label>
              <input type="email" class="form-control" required="" placeholder="name@example.com" name="email">
            </div>


            <div class="d-flex justify-content-center">
              <a href="seat_selection.php"><button type="button" id="button-return" class="btn btn-primary">Return to Seat Selection</button></a>
              <button type="submit" id="button-payment" class="btn btn-primary">Payment</button>
          </form>
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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const buttonPayment = document.getElementById('button-payment');
      const ticketPrice = document.getElementById('ticket-price');
      const paymentLinks = {
    10: "https://buy.stripe.com/test_6oE7to0em3L3da0144", 
    20: "https://buy.stripe.com/test_3cs294aT0bdv2vm145", 
    30: "https://buy.stripe.com/test_cN2aFAbX481j4DueUW", 
    40: "https://buy.stripe.com/test_28o00W7GO0yRee428b",
    50: "https://buy.stripe.com/test_5kA5lg8KS5Tb9XOfZ2",
    60: "https://buy.stripe.com/test_7sI7togdk2GZ5HyfZ3",
    70: "https://buy.stripe.com/test_6oEfZUf9gepH3zqaEK",
    80: "https://buy.stripe.com/test_9AQ5lgbX4dlD3zq9AH",
    90: "https://buy.stripe.com/test_aEU9Bw4uCchz2vmdQZ",
    100: "https://buy.stripe.com/test_8wM00Wf9gftL8TK28g"
  };

  buttonPayment.addEventListener('click', function () {

    if (ticketPrice === 0) {
      alert("Please select seats before proceeding to payment.");
      return;
    }

    // Get the corresponding payment link
    const paymentLink = paymentLinks[totalPrice];

    if (!paymentLink) {
      alert("Invalid total price. Please try again.");
      return;
    }

    // Redirect to the corresponding Stripe payment page
    window.open(paymentLink, "_blank"); // Opens in a new tab
  });
    });
  </script>

</body>
</html>