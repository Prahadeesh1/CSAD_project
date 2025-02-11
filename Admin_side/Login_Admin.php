<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main Page</title>
    <link rel="stylesheet" href="CSS/Login_admin.css" />
  </head>
  <body>
    <!-- Header Navigation -->
    <div class="navbar">
      <img src="images/logo.png" alt="Logo" />
      <nav>
        <a href="../User_side/main_page.php">Home</a>
        <a href="../User_side/moviesection.php">Movies</a>
        <a href="../User_side/cinemas.html">Cinemas</a>
        <a href="../User_side/experiences.html">Experiences</a>
        <a href="../User_side/events_booking.php">Events Booking</a>
      </nav>
    </div>

    <!-- Login Section -->
    <div class="container-root">
      <div class="centered-content">
        <div class="login-container">
          <div class="login-box">
            <h1>Admin Login</h1>
            <p>Sign in to continue</p>
            <form id="login">
              <label for="admin-id">ADMIN ID</label>
              <input type="text" id="admin-id" placeholder="Enter the Admin ID" required />

              <label for="password">PASSWORD</label>
              <input type="password" id="password" placeholder="Enter the Password" required />

              <button type="submit">Log In</button>
            </form>
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
            <li>
              <a href="../User_side/main_page.php" >User Page</a>
            </li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>LEGAL</h3>
          <ul>
            <li><a href="../User_side/termsandconditions.html">Terms & Conditions</a></li>
            <li><a href="../User_side/privacypolicy.html">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>CUSTOMER SERVICES</h3>
          <ul>
            <li><a href="../User_side/contactus.html">Contact Us</a></li>
            <li><a href="../User_side/faqs.html">FAQs</a></li>
          </ul>
        </div>
      </div>
      <p>&copy; 2024 PrismVerse Cinematics Pte Ltd. All rights reserved.</p>
    </footer>

    <script>
      document.getElementById('login').addEventListener('submit', function (event) {
        event.preventDefault();

        const adminId = document.getElementById('admin-id').value;
        const password = document.getElementById('password').value;

        if (adminId === '123456' && password === 'hidumb') {
          window.location.href = 'Page_Admin.php';
        } else {
          alert('Invalid Admin ID or Password. Please try again.');
        }
      });
    </script>
  </body>
</html>
