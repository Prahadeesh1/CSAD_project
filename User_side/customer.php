<?php
$movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);

if (isset($_GET['id'], $_GET['seats'], $_GET['price'], $_GET['date'], $_GET['time'], $_GET['location'], $_GET['showtime'])) {
    $movieId = $_GET['id'];
    $seats = explode(',', $_GET['seats']);
    $totalPrice = $_GET['price'];
    $date = $_GET['date'];
    $time = $_GET['time'];
    $location = $_GET['location'];
    $showtime = $_GET['showtime'];

    $apiUrl = "http://localhost/CSAD_project/Admin_side/movie_api.php";
    
    // Fetch the movies data from the API
    $moviesData = json_decode(file_get_contents($apiUrl), true);

    if ($moviesData['success']) {
        $selectedMovie = null;
        $selectedMovieDate = [];

        foreach ($moviesData['movies'] as $movie) {
            if ($movie['id'] == $movieId) {
                $selectedMovie = $movie;
                break;
            }
        }

        if (!$selectedMovie) {
            echo "<p>Movie not found.</p>";
            exit;
        }

        foreach ($moviesData['screenings'] as $screening) {
            if ($screening['id'] == $movieId) { 
                $selectedMovieDate[] = $screening;
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
  <link rel="stylesheet" href="../User_side/CSS/seat_selection.css"/>
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
          <div>Date: <?php echo $date; ?></div>
          <div>Time: <?php echo $time; ?></div>
          <div>Theater: <?php echo $location; ?></div>
          <div>Seat Selected: <?php echo  htmlspecialchars(implode(', ', $seats)); ?></div>
        </div>
        <h3 id="ticket-price">Total Price: $<?php echo $totalPrice; ?></h3>

        <div class="customer-form">
          <form id="customer-details">
            <input type="hidden" name="movie" value="<?php echo htmlspecialchars($selectedMovie['title']); ?>">
            <input type="hidden" name="theater" value="<?php echo $location; ?>">
            <input type="hidden" name="seats" value="<?php echo htmlspecialchars(implode(',', $seats)); ?>">
            <input type="hidden" name="showtime" value="<?php echo $showtime; ?>">
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
              <a href="seat_selection.php?id= <?php echo $movie['id']; ?>">
                <button type="button" id="button-return" class="btn btn-primary">Return to Seat Selection</button>
              </a>
              <button type="button" id="button-payment" class="btn btn-primary">Payment</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const buttonPayment = document.getElementById("button-payment");

      buttonPayment.addEventListener("click", function () {
        const form = document.getElementById("customer-details");
        const formData = new FormData(form);

        // Send email before redirecting to payment
        fetch("send_booking_email.php", {
          method: "POST",
          body: formData
        })
        .then(emailResponse => emailResponse.json())
        .then(emailData => {
          if (!emailData.success) {
            console.error("Email Error:", emailData.message);
          }

          // Proceed to store booking in database and redirect to payment
          fetch("orders_api.php", {
            method: "POST",
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success && data.payment_url) {
              window.location.href = data.payment_url;
            } else {
              alert("Error: " + (data.message || "Something went wrong."));
            }
          })
          .catch(error => {
            console.error("Error:", error);
            alert("An unexpected error occurred.");
          });
        })
        .catch(error => console.error("Email sending failed:", error));
      });
    });
  </script>
</body>
</html>
