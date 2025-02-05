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
    <title><?php echo htmlspecialchars($selectedMovie['title']); ?> - Movie Details</title>
    <link rel="stylesheet" href="CSS/moviedetails.css" />
</head>
<body>
    <!-- Header Navigation -->
    <div class="navbar">
        <img src="images/logo.png" alt="Logo" />
        <a href="main_page.php">Home</a>
        <a href="moviesection.php">Movies</a>
        <a href="#">Cinemas</a>
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
        <button class="date-button date-option" type="button">
            <p class="date"><?php echo htmlspecialchars($selectedMovieDate['dayofWeek']); ?></p>
            <h2><?php echo htmlspecialchars($selectedMovieDate['day']); ?></h2>
            <p class="date"><?php echo htmlspecialchars($selectedMovieDate['month']); ?></p>
        </button>
        <button class="date-button date-option" type="button">
            <p class="date">SAT</p>
            <h2>11</h2>
            <p class="date">JAN</p>
        </button>
        <button class="date-button date-option" type="button">
            <p class="date">SUN</p>
            <h2>12</h2>
            <p class="date">JAN</p>
        </button>
        <button class="date-button date-option" type="button">
            <p class="date">MON</p>
            <h2>13</h2>
            <p class="date">JAN</p>
        </button>
    </div>

    <!-- Location & Time Section -->
    <div class="section-container">
    <div class="time-header">
      <h3 class="time-title">Select Cinema & Time</h3>
      <div class="region-select">
        <label for="region-dropdown">Region:</label>
        <select id="region-dropdown">
          <option value="" selected>All</option>
          <option value="1">North</option>
          <option value="2">West</option>
          <option value="3">East</option>
          <option value="4">Central</option>
        </select>
      </div>
    </div>

    <div class="location-north">
      <h3 class="location-title" data-location-id="causeway"><?php echo htmlspecialchars($selectedMovieDate['theater']); ?></h3>
      <div class="div-time">
        <button class="time-button time-option" data-location="Singapore, Causeway Point">
          <p><?php echo htmlspecialchars($selectedMovieDate['time']); ?></p>
        </button>
        <button class="time-button time-option" data-location="Singapore, Causeway Point">
          <p>2:00PM</p>
        </button>
        <button class="time-button time-option" data-location="Singapore, Causeway Point">
          <p>6:30PM</p>
        </button>
      </div>
      <hr class="location-divider" />
    </div>

    <div class="location-west">
      <h3 class="location-title" data-location-id="jem">Singapore, JEM</h3>
      <div class="div-time">
        <button class="time-button" data-location="Singapore, JEM">
          <p>10:30AM</p>
        </button>
        <button class="time-button" data-location="Singapore, JEM">
          <p>3:00PM</p>
        </button>
        <button class="time-button" data-location="Singapore, JEM">
          <p>7:00PM</p>
        </button>
      </div>
      <hr class="location-divider" id="lotte-world-divider" />
    </div>

    <div class="location-east">
      <h3 class="location-title" data-location-id="suntec">Singapore, Tampines 1</h3>
      <div class="div-time">
        <button class="time-button" data-location="Singapore, Tampines 1">
          <p>10:15AM</p>
        </button>
        <button class="time-button" data-location="Singapore, Tampines 1">
          <p>1:30PM</p>
        </button>
        <button class="time-button" data-location="Singapore, Tampines 1">
          <p>5:45PM</p>
        </button>
      </div>
      <hr class="location-divider" />
    </div>

    <div class="location-central">
      <h3 class="location-title" data-location-id="orchard">Singapore, Ion Orchard</h3>
      <div class="div-time">
        <button class="time-button" data-location="Singapore, Ion Orchard">
          <p>11:45AM</p>
        </button>
        <button class="time-button" data-location="Singapore, Ion Orchard">
          <p>4:30PM</p>
        </button>
        <button class="time-button" data-location="Singapore, Ion Orchard">
          <p>6:15PM</p>
        </button>
      </div>
    </div>
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

    regionDropdown.addEventListener("change", () => {
      const selectedRegion = regionDropdown.value;
      const northLocations = document.querySelectorAll(".location-north");
      const westLocations = document.querySelectorAll(".location-west");
      const eastLocations = document.querySelectorAll(".location-east");
      const centralLocations = document.querySelectorAll(".location-central");
      const outletDivider = document.getElementById("outlet-divider");

      sgLocations.forEach((location) => (location.style.display = "none"));
      seoulLocations.forEach((location) => (location.style.display = "none"));

      if (selectedRegion === "1") {
        northLocations.forEach((location) => (location.style.display = "block"));
        outletDivider.style.display = "none";
      } else if (selectedRegion === "2") {
        westLocations.forEach((location) => (location.style.display = "block"));
        outletDivider.style.display = "none";
      } else if (selectedRegion === "3") {
        eastLocations.forEach((location) => (location.style.display = "block"));
        outletDivider.style.display = "none";
      } else if (selectedRegion == "4") {
        centralLocations.forEach((location) => (location.style.display = "block"));
        outletDivider.style.display = "none";
      } else {
        northLocations.forEach((location) => (location.style.display = "block"));
        westLocations.forEach((location) => (location.style.display = "block"));
        eastLocations.forEach((location) => (location.style.display = "block"));
        centralLocations.forEach((location) => (location.style.display = "block"));
        outletDivider.style.display = "block";
      }
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
  </script>

</body>
</html>