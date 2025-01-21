<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrismVerse Cinematics - Singapore's Leading Cinema</title>
    <link rel="stylesheet" href="CSS/mainpage.css" />
  </head>
  <body>
    <!-- Header Navigation -->
    <div class="navbar">
      <a href="../User_side/main_page.php"><img src="images/logo.png" alt="Logo" /></a>
       
      
      <nav>
        <a href="#">Movies</a>
        <a href="cinemas.html">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
      </nav>
    </div>

    <!-- Poster Banner Slider -->
    <section class="container">
      <div class="slider-wrapper">
        <div class="slider" id="slider">
          <img id="slide-1" src="images/transformers.jpg" alt="Transformers" />
          <img id="slide-2" src="images/fast x.jpg" alt="Fast X" />
          <img id="slide-3" src="images/kraven.jpg" alt="Kraven" />
        </div>
        <div class="slider-nav">
          <a href="#slide-1" data-index="0"></a>
          <a href="#slide-2" data-index="1"></a>
          <a href="#slide-3" data-index="2"></a>
        </div>
      </div>
    </section>
    <!--Scrolling Navigation JS-->
    <script>
      const slider = document.querySelector("#slider");
      const slides = document.querySelectorAll(".slider img");
      const navDots = document.querySelectorAll(".slider-nav a");
      let currentIndex = 0;
      const slideCount = slides.length;
      // Function to update slider position
      function updateSlider() {
        const offset = -currentIndex * 100; // Translate by 100% per slide
        slider.style.transform = `translateX(${offset}%)`;
        // Update active navigation dot
        navDots.forEach((dot, index) => {
          dot.classList.toggle("active", index === currentIndex);
        });
      }
      // Manual Navigation
      navDots.forEach((dot, index) => {
        dot.addEventListener("click", (e) => {
          e.preventDefault(); // Prevent default anchor behavior
          currentIndex = index; // Update current index
          updateSlider(); // Move slider
        });
      });
      // Automatic Scrolling
      setInterval(() => {
        currentIndex = (currentIndex + 1) % slideCount; // Loop back to the first slide
        updateSlider();
      }, 4000); // Adjust the interval as needed
      // Initial Setup
      updateSlider();
    </script>

    <!-- Second Navigation Bar -->
    <div class="sub-nav">
      <a href="#">Now Showing</a>
      <a href="#">Advanced Sales</a>
      <a href="#">Coming Soon</a>
    </div>

    <!-- Main Section -->
    <main>
      <section class="now-showing">
        <h1>Now Showing</h1>
        <div class="movie-grid">
          <!-- Movie Poster 1 -->
          <div class="movie-post">
            <img src="images/kravenposter.jpg" alt="Kraven Poster" />
            <div class="movie-info">
              <h2>Kraven</h2>
              <p>Rating: R</p>
              <p>Runtime: 102 mins</p>
              <p>Genre: Action</p>
              <a href="#" class="button">Book Now</a>
            </div>
          </div>
          <!-- Movie Poster 2 -->
          <div class="movie-post">
            <img src="images/avengersposter.jpg" alt="Avengers Poster" />
            <div class="movie-info">
              <h2>Avengers</h2>
              <p>Rating: PG-13</p>
              <p>Runtime: 181 mins</p>
              <p>Genre: Action, Adventure</p>
              <a href="#" class="button">Book Now</a>
            </div>
          </div>
          <!-- Movie Poster 3 -->
          <div class="movie-post">
            <img src="images/fastxposter.jpg" alt="Fast X Poster" />
            <div class="movie-info">
              <h2>Fast X</h2>
              <p>Rating: PG-13</p>
              <p>Runtime: 141 mins</p>
              <p>Genre: Action, Thriller</p>
              <a href="#" class="button">Book Now</a>
            </div>
          </div>
          <!-- Movie Poster 4 -->
          <div class="movie-post">
            <img src="images/spidermanposter.jpg" alt="Spiderman Poster" />
            <div class="movie-info">
              <h2>Spiderman</h2>
              <p>Rating: PG</p>
              <p>Runtime: 120 mins</p>
              <p>Genre: Action, Sci-Fi</p>
              <a href="#" class="button">Book Now</a>
            </div>
          </div>
          <!-- Movie Poster 5 -->
          <div class="movie-post">
            <img
              src="images/transformersposter.jpg"
              alt="Transformers Poster"
            />
            <div class="movie-info">
              <h2>Transformers</h2>
              <p>Rating: PG</p>
              <p>Runtime: 124 mins</p>
              <p>Genre: Sci-Fi, Adventure</p>
              <a href="movie_details.php" class="button">Book Now</a>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Visual Bar -->
    <div class="visbar">
      <img src="images/IMAX.png" alt="Logo" />
      <img src="images/dolbyatmos.jpg" alt="Logo" />
      <img src="images/4dx.png" alt="Logo" />
      <img src="images/dtsx.jpg" alt="Logo" />
      <img src="images/screen-x.jpg" alt="Logo" />
      <img src="images/d-box.jpg" alt="Logo" />
    </div>

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
            target="_blank"
          >
            <img src="images/facebook.jpg" alt="Facebook" class="social-img" />
          </a>
          <a
            href="https://x.com/?lang=en"
            class="social-icon X"
            target="_blank"
          >
            <img src="images/x.jpg" alt="X" class="social-img" />
          </a>
          <a
            href="https://www.instagram.com/"
            class="social-icon instagram"
            target="_blank"
          >
            <img
              src="images/instagram.jpg"
              alt="Instagram"
              class="social-img"
            />
          </a>
        </div>
      </div>
      <p>&copy; 2024 PrismVerse Cinematics Pte Ltd. All rights reserved.</p>
    </footer>
  </body>
</html>
