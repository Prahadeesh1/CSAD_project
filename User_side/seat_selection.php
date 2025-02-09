<?php
$movies = json_decode(file_get_contents("http://localhost/CSAD_project/Admin_side/movie_api.php"), true);
include 'db_connection.php';
$conn = connect_db();

if (isset($_GET['id'], $_GET['screening_id'], $_GET['date'], $_GET['time'], $_GET['location'], $_GET['showtime'])) {
    $movieId = $_GET['id'];
    $screening_id = $_GET['screening_id'];
    $date = $_GET['date'];
    $time = $_GET['time'];
    $location = $_GET['location'];
    $showtime = $_GET['showtime'];

    $apiUrl = "http://localhost/CSAD_project/Admin_side/movie_api.php";
    
    // Fetch the movies data from the API
    $moviesData = json_decode(file_get_contents($apiUrl), true);

    if ($moviesData['success']) {
      // Search for the selected movie in the API response
      $selectedMovie = null;
      $selectedTicket = [];
  
      foreach ($moviesData['movies'] as $movie) {
          if ($movie['id'] == $movieId) {
              $selectedMovie = $movie;
              break; // Movie found, exit loop early
          }
      }

      foreach ($moviesData['tickets'] as $ticket) {
        if ($ticket['screening_id'] == $screening_id) {
            $selectedTicket[] = $ticket; 
        }
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
<?php

$occupiedSeats = [];

foreach ($selectedTicket as $seats) {
    $screening_id = $seats['screening_id']; 
    $seatNumbers = explode(',', $seats['seat_number']); // Convert string into an array

    if (!isset($occupiedSeats[$screening_id])) {
        $occupiedSeats[$screening_id] = []; // Initialize array if it doesn't exist
    }

    // Merge seat numbers correctly
    $occupiedSeats[$screening_id] = array_merge($occupiedSeats[$screening_id], $seatNumbers);
  }
?>



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
      <?php foreach ($occupiedSeats as $screening_id => $seats) : ?>
        <input type="hidden" name="occupied_seats[<?php echo $screening_id; ?>]" value="<?php echo implode(',', $seats); ?>">
      <?php endforeach; ?>
        <div>Date: <?php echo $date; ?></div>
        <div>Time: <?php echo $time; ?></div>
        <div>Theater: <?php echo $location; ?></div>
        <div id="selected">Seat Selected: </div>
      </div>
      <h3 id="ticket-price">Total Price: $<span id=total>0</span></h3>
      <div class="customer-form">
        <div class="container-root">
          <div class="centered-content">
            <ul class="showcase">
              <li class="disabled">
                <div class="seat"></div>
                <small>Available</small>
              </li>
              <li class="disabled">
                <div class="seat selected"></div>
                <small>Selected</small>
              </li>
              <li class="disabled">
                <div class="seat occupied"></div>
                <small>Occupied</small>
              </li>
            </ul>

            <div class="screen"></div>

            <!-- Row labels (A, B, C, ...) -->
            <div class="seat-name-row">
              <div class="seat-name">A</div>
              <div class="seat-name">B</div>
              <div class="seat-name">C</div>
              <div class="seat-name">D</div>
              <div class="seat-name">E</div>
              <div class="seat-name">F</div>
              <div class="seat-name">G</div>
              <div class="seat-name">H</div>
              <div class="seat-name">I</div>
              <div class="seat-name">J</div>
              <div class="seat-name">K</div>
              <div class="seat-name">L</div>
              <div class="seat-name">M</div>
            </div>

            <!-- Seat Rows (1-8) -->
            <div class="row">
              <div class="row-number">
                <div class="column-name">1</div>
              </div>
              <div class="seat" value="A1"></div>
              <div class="seat" value="B1"></div>
              <div class="seat" value="C1"></div>
              <div class="seat" value="D1"></div>
              <div class="seat" value="E1"></div>
              <div class="seat" value="F1"></div>
              <div class="seat" value="G1"></div>
              <div class="seat" value="H1"></div>
              <div class="seat" value="I1"></div>
              <div class="seat" value="J1"></div>
              <div class="seat" value="K1"></div>
              <div class="seat" value="L1"></div>
              <div class="seat" value="M1"></div>
              <div class="row-number">
                <div class="column-name">1</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">2</div>
              </div>
              <div class="seat" value="A2"></div>
              <div class="seat" value="B2"></div>
              <div class="seat" value="C2"></div>
              <div class="seat" value="D2"></div>
              <div class="seat" value="E2"></div>
              <div class="seat" value="F2"></div>
              <div class="seat" value="G2"></div>
              <div class="seat" value="H2"></div>
              <div class="seat" value="I2"></div>
              <div class="seat" value="J2"></div>
              <div class="seat" value="K2"></div>
              <div class="seat" value="L2"></div>
              <div class="seat" value="M2"></div>
              <div class="row-number">
                <div class="column-name">2</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">3</div>
              </div>
              <div class="seat" value="A3"></div>
              <div class="seat" value="B3"></div>
              <div class="seat" value="C3"></div>
              <div class="seat" value="D3"></div>
              <div class="seat" value="E3"></div>
              <div class="seat" value="F3"></div>
              <div class="seat" value="G3"></div>
              <div class="seat" value="H3"></div>
              <div class="seat" value="I3"></div>
              <div class="seat" value="J3"></div>
              <div class="seat" value="K3"></div>
              <div class="seat" value="L3"></div>
              <div class="seat" value="M3"></div>
              <div class="row-number">
                <div class="column-name">3</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">4</div>
              </div>
              <div class="seat" value="A4"></div>
              <div class="seat" value="B4"></div>
              <div class="seat" value="C4"></div>
              <div class="seat" value="D4"></div>
              <div class="seat" value="E4"></div>
              <div class="seat" value="F4"></div>
              <div class="seat" value="G4"></div>
              <div class="seat" value="H4"></div>
              <div class="seat" value="I4"></div>
              <div class="seat" value="J4"></div>
              <div class="seat" value="K4"></div>
              <div class="seat" value="L4"></div>
              <div class="seat" value="M4"></div>
              <div class="row-number">
                <div class="column-name">4</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">5</div>
              </div>
              <div class="seat" value="A5"></div>
              <div class="seat" value="B5"></div>
              <div class="seat" value="C5"></div>
              <div class="seat" value="D5"></div>
              <div class="seat" value="E5"></div>
              <div class="seat" value="F5"></div>
              <div class="seat" value="G5"></div>
              <div class="seat" value="H5"></div>
              <div class="seat" value="I5"></div>
              <div class="seat" value="J5"></div>
              <div class="seat" value="K5"></div>
              <div class="seat" value="L5"></div>
              <div class="seat" value="M5"></div>
              <div class="row-number">
                <div class="column-name">5</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">6</div>
              </div>
              <div class="seat" value="A6"></div>
              <div class="seat" value="B6"></div>
              <div class="seat" value="C6"></div>
              <div class="seat" value="D6"></div>
              <div class="seat" value="E6"></div>
              <div class="seat" value="F6"></div>
              <div class="seat" value="G6"></div>
              <div class="seat" value="H6"></div>
              <div class="seat" value="I6"></div>
              <div class="seat" value="J6"></div>
              <div class="seat" value="K6"></div>
              <div class="seat" value="L6"></div>
              <div class="seat" value="M6"></div>
              <div class="row-number">
                <div class="column-name">6</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">7</div>
              </div>
              <div class="seat" value="A7"></div>
              <div class="seat" value="B7"></div>
              <div class="seat" value="C7"></div>
              <div class="seat" value="D7"></div>
              <div class="seat" value="E7"></div>
              <div class="seat" value="F7"></div>
              <div class="seat" value="G7"></div>
              <div class="seat" value="H7"></div>
              <div class="seat" value="I7"></div>
              <div class="seat" value="J7"></div>
              <div class="seat" value="K7"></div>
              <div class="seat" value="L7"></div>
              <div class="seat" value="M7"></div>
              <div class="row-number">
                <div class="column-name">7</div>
              </div>
            </div>

            <div class="row">
              <div class="row-number">
                <div class="column-name">8</div>
              </div>
              <div class="seat" value="A8"></div>
              <div class="seat" value="B8"></div>
              <div class="seat" value="C8"></div>
              <div class="seat" value="D8"></div>
              <div class="seat" value="E8"></div>
              <div class="seat" value="F8"></div>
              <div class="seat" value="G8"></div>
              <div class="seat" value="H8"></div>
              <div class="seat" value="I8"></div>
              <div class="seat" value="J8"></div>
              <div class="seat" value="K8"></div>
              <div class="seat" value="L8"></div>
              <div class="seat" value="M8"></div>
              <div class="row-number">
                <div class="column-name">8</div>
              </div>
            </div>

            <p class="text">
              You have selected <span id="count">0</span> seats
            </p>
            <a id="confirm-booking" href="#">
              <button id="button-confirm">Confirm bookings</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <footer>
    <div class="footer-links">
      <div class="footer-column">
        <h3>HOME</h3>
        <ul>
          <li><a href="#">Log In/Register</a></li>
          <li><a href="../Admin_side/Login_Admin.html">Admin Page</a></li>
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
        <a href="https://www.facebook.com/" class="social-icon facebook" target="_blank">
          <img src="images/facebook.jpg" alt="Facebook" class="social-img" />
        </a>
        <a href="https://x.com/?lang=en" class="social-icon X" target="_blank">
          <img src="images/x.jpg" alt="X" class="social-img" />
        </a>
        <a href="https://www.instagram.com/" class="social-icon instagram" target="_blank">
          <img src="images/instagram.jpg" alt="Instagram" class="social-img" />
        </a>
      </div>
    </div>
    <p>&copy; 2024 PrismVerse Cinematics Pte Ltd. All rights reserved.</p>
  </footer>

  <script>


// Function to mark occupied seats on the seat map
document.addEventListener("DOMContentLoaded", function () {
  const seats = document.querySelectorAll('.seat');
  const countElement = document.getElementById('count');
  const totalElement = document.getElementById('total');
  const confirmButton = document.getElementById('confirm-booking');
  const selectedSeatsDisplay = document.getElementById('selected');
  const pricePerSeat = 10; // Price per seat
  const seatNumber = document.querySelector('input[type="hidden"]').value;
  let selectedSeats = [];



  // Function to update the count and total price
  function updatePrice() {
    countElement.textContent = selectedSeats.length;
    totalElement.textContent = selectedSeats.length * pricePerSeat;
    selectedSeatsDisplay.textContent = "Seat Selected: " + (selectedSeats.length > 0 ? selectedSeats.join(', ') : "None");
  }

  // Function to handle seat selection
  seats.forEach(seat => {
    if (seatNumber.includes(seat.getAttribute('value'))) {
      seat.classList.add('occupied');
    } else if (!seat.classList.contains('occupied')) {
      seat.addEventListener('click', function () {
        const seatValue = seat.getAttribute('value');

        if (seat.classList.contains('selected')) {
          seat.classList.remove('selected');
          const index = selectedSeats.indexOf(seat);
          selectedSeats = selectedSeats.filter(s => s !== seatValue);
        } else {
          seat.classList.add('selected');
          selectedSeats.push(seatValue);
        }
        updatePrice();
      });
    }
  });

  confirmButton.addEventListener('click', function () {
    const movieId = "<?php echo $selectedMovie['id']; ?>"; 
    const seatsString = selectedSeats.join(',');
    const totalPrice = selectedSeats.length * pricePerSeat;
    const selectedDate = "<?php echo $date; ?>";
    const selectedTime = "<?php echo $time; ?>";
    const selectedLocation = "<?php echo $location; ?>";
    const showtime = "<?php echo $showtime; ?>";

    if (selectedSeats.length === 0) {
      alert("Please select at least one seat.");
      return;
    }
    confirmButton.href = `customer.php?id=${movieId}&seats=${encodeURIComponent(seatsString)}&price=${totalPrice}&date=${selectedDate}&time=${selectedTime}&location=${selectedLocation}&showtime=${showtime}`;
  });
});
  </script>
</body>

</html>
