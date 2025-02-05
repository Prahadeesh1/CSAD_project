<?php
$movies = json_decode(file_get_contents("http://localhost/CSAD_Project//Admin_side/movie_api.php"), true);

if (isset($_GET['id'])) {
    $movieId = $_GET['id'];
    $apiUrl = "http://localhost/CSAD_project/Admin_side/movie_api.php";
    
    // Fetch the movies data from the API
    $moviesData = json_decode(file_get_contents($apiUrl), true);

    if ($moviesData['success']) {
      // Search for the selected movie in the API response
      $selectedMovie = null;
      $selectedMovieDate = [];
      $selectedMovietheater = null;
  
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
              $selectedMovieDate[]= $screening;
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
    <title><?php echo htmlspecialchars($selectedMovie['title']); ?> - Movie Details</title>
    <link rel="stylesheet" href="CSS/moviedetails.css" />
</head>
<body>
    <!-- Header Navigation -->
    <div class="navbar">
        <img src="images/logo.png" alt="Logo" />
        <a href="main_page.php">Home</a>
        <a href="moviesection.php">Movies</a>
        <a href="cinemas.html">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
    </div>

    <!-- Movie Details Section -->
    <main class="movie-details">
        <div class="details-container">
            <div class="poster-container">
                <img src="<?php echo htmlspecialchars($selectedMovie['cover']); ?>" alt="Movie Poster" />
            </div>
            <div class="info-container">
                <h1 class="movie-title"><?php echo htmlspecialchars($selectedMovie['title']); ?></h1>
                <h2>Movie Details</h2>
                <p><strong>Cast: </strong><?php echo htmlspecialchars($selectedMovie['cast']); ?></p>
                <p><strong>Director: </strong><?php echo htmlspecialchars($selectedMovie['director']); ?></p>
                <p><strong>Synopsis: </strong><?php echo htmlspecialchars($selectedMovie['synopsis']); ?></p>
                <div class="extra-details">
                    <div><strong>Genre:</strong> <?php echo htmlspecialchars($selectedMovie['genre']); ?></div>
                    <div><strong>Language:</strong> <?php echo htmlspecialchars($selectedMovie['language']); ?></div>
                    <div><strong>Rating:</strong> <?php echo htmlspecialchars($selectedMovie['rating']); ?></div>
                    <div><strong>Runtime:</strong> <?php echo htmlspecialchars($selectedMovie['runtime']); ?> mins</div>
                    <div><strong>Subtitle:</strong> <?php echo htmlspecialchars($selectedMovie['subtitles']); ?></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Dates Section -->
    <h3 class="date-title">Select Date</h3>
<div class="div-date">
  <?php 
    $uniqueDates = [];
    foreach ($selectedMovieDate as $date) {
        $key = $date['dayofWeek'] . $date['day'] . $date['month']; // Unique key
        if (!isset($uniqueDates[$key])) {
            $uniqueDates[$key] = $date;
        }
    }
  
    foreach ($uniqueDates as $date) : 
  ?>
    <button class="date-button date-option" type="button">
        <p class="date"><?php echo htmlspecialchars($date['dayofWeek']); ?></p>
        <h2><?php echo htmlspecialchars($date['day']); ?></h2>
        <p class="date"><?php echo htmlspecialchars($date['month']); ?></p>
    </button>
  <?php endforeach; ?>
</div>

  
    <!-- Location & Time Section -->
    <div class="section-container">
    <div class="time-header">
        <h3 class="time-title">Select Cinema & Time</h3>
    </div>

    <?php 
    // Step 1: Group screenings by date and theater_name
    $groupedScreenings = [];
    foreach ($selectedMovieDate as $screening) {
        $dateKey = $screening['dayofWeek'] . $screening['day'] . $screening['month']; // Unique date key
        $theater = $screening['theater_name'];
        $time = $screening['time'];

        if (!isset($groupedScreenings[$dateKey])) {
            $groupedScreenings[$dateKey] = [];
        }
        if (!isset($groupedScreenings[$dateKey][$theater])) {
            $groupedScreenings[$dateKey][$theater] = [];
        }
        $groupedScreenings[$dateKey][$theater][] = $time;
    }

    // Step 2: Display theaters & times but keep them hidden initially
    foreach ($groupedScreenings as $dateKey => $theaters) : ?>
        <div class="cinema-container" data-date="<?php echo htmlspecialchars($dateKey); ?>" style="display: none;">
            <?php foreach ($theaters as $theater => $times) : ?>
                <h3 class="location-title"><?php echo htmlspecialchars($theater); ?></h3>
                <div class="div-time">
                    <?php foreach ($times as $time) : ?>
                        <button class="time-button time-option" data-location="<?php echo htmlspecialchars($theater); ?>" type="button">
                            <p><?php echo htmlspecialchars($time); ?></p>
                        </button>
                    <?php endforeach; ?>
                </div>
                <hr class="location-divider" />
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>



  <div id="popup-modal" class="modal">
    <div class="modal-content">
      <img id="modal-poster" src="<?php echo htmlspecialchars($selectedMovie['cover']); ?>">
      <p><b><?php echo htmlspecialchars($selectedMovie['title']); ?></b><br></p>
      <span id="close-modal" class="close">&times;</span>
      <p id="modal-message"></p><br>
      <a href="seat_selection.php?id=<?php echo $movie['id']; ?>">
        <button id="modal-button">Seat Selection</button>
      </a>
    </div>
  </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-links">
            <div class="footer-column">
                <h3>HOME</h3>
                <ul>
                    <li><a href="#">Log In/Register</a></li>
                    <li>
                        <a href="#" onclick="document.location='Admin_side/Login_admin.html'">Admin Page</a>
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
        </div>
        <p>&copy; 2024 PrismVerse Cinematics Pte Ltd. All rights reserved.</p>
    </footer>

    <script>
    function formatDate(date) {
      const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      const monthsOfYear = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      const selectedDate = new Date(date);
      const day = daysOfWeek[selectedDate.getDay()];
      const month = monthsOfYear[selectedDate.getMonth()];
      const dayOfMonth = selectedDate.getDate();

      // Add suffix (st, nd, rd, th) based on the day of the month
      const suffix = dayOfMonth % 10 === 1 && dayOfMonth !== 11 ? "st" :
        dayOfMonth % 10 === 2 && dayOfMonth !== 12 ? "nd" :
        dayOfMonth % 10 === 3 && dayOfMonth !== 13 ? "rd" : "th";

      return `${day}, ${dayOfMonth}${suffix} ${month}`;
    }

    // State variables for selected date, time, and location
    let selectedDate = null;
    let selectedTime = null;
    let selectedLocation = null;

    // Select all relevant buttons and dropdowns
    const dateButtons = document.querySelectorAll(".date-button");
    const timeButtons = document.querySelectorAll(".time-button");
    const regionDropdown = document.getElementById("region-dropdown");
    const modal = document.getElementById("popup-modal");
    const modalMessage = document.getElementById("modal-message");
    const closeModal = document.getElementById("close-modal");
    const locationTitles = document.querySelectorAll("[data-location-id]");

    // Date selection functionality
    dateButtons.forEach((button) => {
      button.addEventListener("click", () => {
        // Get the full date (day, date, month)
        const day = button.querySelector("p.date").innerText; // e.g., "FRI"
        const dayNumber = button.querySelector("h2").innerText; // e.g., "10"
        const month = button.querySelector("p.date:last-of-type").innerText; // e.g., "JAN"

        // Use formatDate function to get the complete date
        selectedDate = formatDate(new Date(`${month} ${dayNumber}, 2025`));

        dateButtons.forEach((btn) => btn.classList.remove("selected"));
        button.classList.add("selected");

        // Log the selected date
        console.log(`Selected Date: ${selectedDate}`);

      });
    });

    // Location selection functionality
    locationTitles.forEach((locationTitle) => {
      locationTitle.addEventListener("click", () => {
        // Get the location name from the clicked title
        selectedLocation = locationTitle.innerText.trim(); // Make sure to trim any whitespace

        // Add selected class to the clicked location and remove from others
        locationTitles.forEach((location) => location.classList.remove("selected"));
        locationTitle.classList.add("selected");


        // Log the selected location
        console.log(`Selected Location: ${selectedLocation}`);
      });
    });

    // Time selection functionality
    timeButtons.forEach((button) => {
      button.addEventListener("click", () => {
        if (!selectedDate) {
          alert("Please select a date first.");
          return;
        }
        // Update the selected time and visually highlight it
        selectedTime = button.querySelector("p").innerText;
        selectedLocation = button.getAttribute("data-location"); // Update selectedLocation
        timeButtons.forEach((btn) => btn.classList.remove("selected"));
        button.classList.add("selected");

        // Show modal when both date and time are selected
        if (selectedDate && selectedTime) {
          modalMessage.innerText = `You have selected:\nLocation: ${selectedLocation}\nTime: ${selectedTime}\nDate: ${selectedDate}`;
          modal.style.display = "block";
        }
        console.log(`Selected Time: ${selectedTime}`);
      });
    });

    // Close the modal when clicking the close button
    closeModal.addEventListener("click", () => {
      modal.style.display = "none";
    });

    // Close the modal if clicked outside the modal content
    window.addEventListener("click", (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const dateButtons = document.querySelectorAll(".date-button");
        const cinemaContainers = document.querySelectorAll(".cinema-container");

        dateButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Get the selected date key
                const selectedDateKey = button.querySelector("p.date").innerText + 
                                        button.querySelector("h2").innerText + 
                                        button.querySelector("p.date:last-of-type").innerText;

                // Hide all cinema containers first
                cinemaContainers.forEach(container => {
                    container.style.display = "none";
                });

                // Show the matched cinema container for the selected date
                const matchingContainer = document.querySelector(`[data-date="${selectedDateKey}"]`);
                if (matchingContainer) {
                    matchingContainer.style.display = "block";
                }
            });
        });
    });

  </script>

</body>
</html>