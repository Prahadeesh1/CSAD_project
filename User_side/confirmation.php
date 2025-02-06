<?php
$movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);

if (isset($_GET['id'], $_GET['seats'], $_GET['price'])) {
    $movieId = $_GET['id'];
    $seats = explode(',', $_GET['seats']);
    $totalPrice = $_GET['price'];

    $apiUrl = "http://localhost/CSAD_project/Admin_side/movie_api.php";
    
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
  <style>
        h2, p, h1 {
            color: #FFFFFF;
        }
        .details {
            text-align: left;
            margin: 20px 0;
        }
        .qr-code-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
  <!-- Header Navigation -->
  <div class="navbar">
    <img src="images/logo.png" alt="Logo" />
    <nav>
      <a href="main_page.php">Home</a>
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
            <h1>Movie Booking Confirmation</h1>
            <p>Thank you for booking your movie tickets with us!</p>
        <h2>Movie Booking E-Receipt</h2>
        <div class="details">
            <p><strong>Movie:</strong> <?php echo htmlspecialchars($selectedMovie['title']); ?></p>
            <p><strong>Theater:</strong> <?php echo htmlspecialchars($selectedMovieDate['theater_name']); ?></p>
            <p><strong>Showtime:</strong> 
              <?php echo htmlspecialchars($selectedMovieDate['day']) . " " 
              . htmlspecialchars($selectedMovieDate['month']). " " 
              . htmlspecialchars($selectedMovieDate['dayofWeek']); ?>
            </p>
            <p><strong>Seats:</strong> <?php echo  htmlspecialchars(implode(', ', $seats)); ?></p>
            <p><strong>Price:</strong><?php echo $totalPrice; ?></p>
        </div>
        <div class="col-md-4 poster-container">
            <div class="qr-code">
                <img src="images/websiteQRCode_noFrame.jpg" alt="QR Code" />
                <p>Scan this QR code at the entrance</p>
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
  </body>
</html>
