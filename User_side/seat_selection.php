<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seat Selection | PrismVerse Cinematics</title>
  <link rel="stylesheet" href="../User_side/CSS/seat_selection.css" />
</head>

<body>
  <!-- Header Navigation -->
  <div class="navbar">
    <img src="images/logo.png" alt="Logo" />
    <nav>
      <a href="#">Movies</a>
      <a href="../User_side/cinemas.html">Cinemas</a>
      <a href="#">Experiences</a>
      <a href="#">Shop</a>
      <a href="#">Events Booking</a>
    </nav>
  </div>

  <main class="container-root">
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

      <div class="row">
        <div class="column-names">
          <div class="column-name">1</div>
        </div>
        <div class="seat" id="A1"></div>
        <div class="seat" id="B1"></div>
        <div class="seat" id="C1"></div>
        <div class="seat" id="D1"></div>
        <div class="seat" id="E1"></div>
        <div class="seat" id="F1"></div>
        <div class="seat" id="G1"></div>
        <div class="seat" id="H1"></div>
        <div class="seat" id="I1"></div>
        <div class="seat" id="J1"></div>
        <div class="seat" id="K1"></div>
        <div class="seat" id="L1"></div>
        <div class="seat" id="M1"></div>
        <div class="column-names">
          <div class="column-name">1</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">2</div>
        </div>
        <div class="seat" id="A2"></div>
        <div class="seat" id="B2"></div>
        <div class="seat" id="C2"></div>
        <div class="seat" id="D2"></div>
        <div class="seat" id="E2"></div>
        <div class="seat" id="F2"></div>
        <div class="seat" id="G2"></div>
        <div class="seat" id="H2"></div>
        <div class="seat" id="I2"></div>
        <div class="seat" id="J2"></div>
        <div class="seat" id="K2"></div>
        <div class="seat" id="L2"></div>
        <div class="seat" id="M2"></div>
        <div class="column-names">
          <div class="column-name">2</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">3</div>
        </div>
        <div class="seat" id="A3"></div>
        <div class="seat" id="B3"></div>
        <div class="seat" id="C3"></div>
        <div class="seat" id="D3"></div>
        <div class="seat" id="E3"></div>
        <div class="seat" id="F3"></div>
        <div class="seat" id="G3"></div>
        <div class="seat" id="H3"></div>
        <div class="seat" id="I3"></div>
        <div class="seat" id="J3"></div>
        <div class="seat" id="K3"></div>
        <div class="seat" id="L3"></div>
        <div class="seat" id="M3"></div>
        <div class="column-names">
          <div class="column-name">3</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">4</div>
        </div>
        <div class="seat" id="A4"></div>
        <div class="seat" id="B4"></div>
        <div class="seat" id="C4"></div>
        <div class="seat" id="D4"></div>
        <div class="seat" id="E4"></div>
        <div class="seat" id="F4"></div>
        <div class="seat" id="G4"></div>
        <div class="seat" id="H4"></div>
        <div class="seat" id="I4"></div>
        <div class="seat" id="J4"></div>
        <div class="seat" id="K4"></div>
        <div class="seat" id="L4"></div>
        <div class="seat" id="M4"></div>
        <div class="column-names">
          <div class="column-name">4</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">5</div>
        </div>
        <div class="seat" id="A5"></div>
        <div class="seat" id="B5"></div>
        <div class="seat" id="C5"></div>
        <div class="seat" id="D5"></div>
        <div class="seat" id="E5"></div>
        <div class="seat" id="F5"></div>
        <div class="seat" id="G5"></div>
        <div class="seat" id="H5"></div>
        <div class="seat" id="I5"></div>
        <div class="seat" id="J5"></div>
        <div class="seat" id="K5"></div>
        <div class="seat" id="L5"></div>
        <div class="seat" id="M5"></div>
        <div class="column-names">
          <div class="column-name">5</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">6</div>
        </div>
        <div class="seat" id="A6"></div>
        <div class="seat" id="B6"></div>
        <div class="seat" id="C6"></div>
        <div class="seat" id="D6"></div>
        <div class="seat" id="E6"></div>
        <div class="seat" id="F6"></div>
        <div class="seat" id="G6"></div>
        <div class="seat" id="H6"></div>
        <div class="seat" id="I6"></div>
        <div class="seat" id="J6"></div>
        <div class="seat" id="K6"></div>
        <div class="seat" id="L6"></div>
        <div class="seat" id="M6"></div>
        <div class="column-names">
          <div class="column-name">6</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">7</div>
        </div>
        <div class="seat" id="A7"></div>
        <div class="seat" id="B7"></div>
        <div class="seat" id="C7"></div>
        <div class="seat" id="D7"></div>
        <div class="seat" id="E7"></div>
        <div class="seat" id="F7"></div>
        <div class="seat" id="G7"></div>
        <div class="seat" id="H7"></div>
        <div class="seat" id="I7"></div>
        <div class="seat" id="J7"></div>
        <div class="seat" id="K6"></div>
        <div class="seat" id="L7"></div>
        <div class="seat" id="M7"></div>
        <div class="column-names">
          <div class="column-name">7</div>
        </div>
      </div>

      <div class="row">
        <div class="column-names">
          <div class="column-name">8</div>
        </div>
        <div class="seat" id="A8"></div>
        <div class="seat" id="B8"></div>
        <div class="seat" id="C8"></div>
        <div class="seat" id="D8"></div>
        <div class="seat" id="E8"></div>
        <div class="seat" id="F8"></div>
        <div class="seat" id="G8"></div>
        <div class="seat" id="H8"></div>
        <div class="seat" id="I8"></div>
        <div class="seat" id="J8"></div>
        <div class="seat" id="K8"></div>
        <div class="seat" id="L8"></div>
        <div class="seat" id="M8"></div>
        <div class="column-names">
          <div class="column-name">8</div>
        </div>
      </div>


      <p class="text">
        You have selected <span id="count">0</span> seats for a price of $<span id="total">0</span>
      </p>
      <div style="justify-content: space-between;">
        <a href="../User_side/movie_details.php">
          <button type="button" id="button-previouspage">Back</button>
        </a>
        <a href="../User_side/customer_details.php">
          <button type="button" id="button-next">Next</button>
        </a>
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
          <li><a href="#">FAQs</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>ABOUT</h3>
        <ul>
          <li><a href="#">About PVC</a></li>
          <li><a href="#">Careers</a></li>
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
    document.addEventListener("DOMContentLoaded", function() {
      const seats = document.querySelectorAll('.seat');
      const countElement = document.getElementById('count');
      const totalElement = document.getElementById('total');

      let selectedSeats = [];

      // Price per seat
      const pricePerSeat = 10; // You can adjust this price as needed

      // Function to update the count and total price
      function updatePrice() {
        countElement.textContent = selectedSeats.length;
        totalElement.textContent = selectedSeats.length * pricePerSeat;
      }

      // Function to handle seat selection
      seats.forEach(seat => {
        // Ignore seats within the showcase
        if (!seat.closest('.disabled')) {
          seat.addEventListener('click', function() {
            // If the seat is already selected, unselect it
            if (seat.classList.contains('selected')) {
              seat.classList.remove('selected');
              const index = selectedSeats.indexOf(seat);
              if (index > -1) {
                selectedSeats.splice(index, 1);
              }
            } else {
              // If the seat is available and not occupied, select it
              if (!seat.classList.contains('occupied')) {
                seat.classList.add('selected');
                selectedSeats.push(seat);
              }
            }
            updatePrice();
          });
        }
      });
    });
  </script>

</body>

</html>