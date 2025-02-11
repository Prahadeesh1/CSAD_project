<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events Booking | PrismVerse Cinematics</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../User_side/CSS/eventsbooking.css" />
  </head>

  <body>
    <!-- Header Navigation -->
    <div class="navbar">
      <img src="images/logo.png" alt="Logo" />
      <nav>
      <a href="main_page.php">Home</a>
        <a href="moviesection.php">Movies</a>
        <a href="cinemas.html">Cinemas</a>
        <a href="experiences.html">Experiences</a>
        <a href="events_booking.php">Events Booking</a>
      </nav>
      </nav>
    </div>

    <section class="event-section">
      <h1 class="event-booking">Events Booking</h1>
      <p class="event-description">
        Whether you are hosting corporate events, planning a private party or a proposal, our
        friendly team will be there to guide you all the way!
      </p>
      <p class="event-description">Let us make your experience an unforgettable one.</p>
    </section>

    <div class="booking-form container">
      <form id="booking-form">
        <label for="booking-name" class="form-label">Contact Name*</label>
        <input type="text" class="form-control" name="booking-name" required placeholder="Enter your name" />

        <label for="booking-email" class="form-label">Email Address*</label>
        <input type="email" class="form-control" name="booking-email" required placeholder="name@example.com" />

        <label for="booking-phone" class="form-label">Contact Number*</label>
        <input type="number" class="form-control" name="booking-phone" required placeholder="+65 xxxx xxxx" />

        <label for="booking-category" class="form-label">Type of event*</label>
        <select class="form-select" name="booking-category" id="booking-category" required>
          <option value="">Select an option</option>
          <option value="Corporate">Corporate</option>
          <option value="Proposal">Proposal</option>
          <option value="Private Party">Private Party</option>
          <option value="Others">Others</option>
        </select>

        <div id="other-event-container" style="display: none">
          <label for="other-event">Please specify*</label>
          <input type="text" class="form-control" name="other-event" />
        </div>

        <label for="booking-pax" class="form-label">Number of Pax*</label>
        <input type="number" class="form-control" name="booking-pax" required placeholder="No. of Pax" />

        <label for="booking-location" class="form-label">Cinema Location*</label>
        <select class="form-select" name="booking-location" required>
          <option value="" selected>Select the location</option>
          <option value="Causeway Point">Causeway Point</option>
          <option value="Sentosa Cove">Sentosa Cove</option>
          <option value="Tampines 1">AMK Hub</option>
          <option value="ION Orchard">ION Orchard</option>
        </select>

        <label for="booking-date" class="form-label">Date of Event*</label>
        <input type="date" class="form-control" name="booking-date" required />

        <label for="booking-time" class="form-label">Time of Event*</label>
        <input type="time" class="form-control" name="booking-time" required />

        <p>Please note that submission of this enquiry is not a confirmation of your booking.</p>
        <p>Our sales representative will contact you to assist you with your booking.</p>

        <input class="booking-checkbox" type="checkbox" required id="flexCheckDefault" />
        <label class="booking-confirm" for="flexCheckDefault">I agree with the Terms & Conditions</label>

        <div class="submit-container">
          <button type="submit" class="btn-primary">Submit</button>
        </div>
      </form>
    </div>

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
      const typeOfEventSelected = document.getElementById("booking-category");
      const otherEventContainer = document.getElementById("other-event-container");

      typeOfEventSelected.addEventListener("change", () => {
        if (typeOfEventSelected.value === "Others") {
          otherEventContainer.style.display = "block";
        } else {
          otherEventContainer.style.display = "none";
        }
      });

      document.getElementById("booking-form").addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch("send_email.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((data) => {
            alert("Your booking request has been submitted. A confirmation email has been sent.");
            this.reset();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    </script>
  </body>
</html>
