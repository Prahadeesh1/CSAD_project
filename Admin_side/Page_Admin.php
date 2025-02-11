<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="CSS/Page_admin.css">
</head>
<body>
<!-- Header Navigation -->
<div class="navbar">
    <img src="static_image/logo.png" alt="Logo">
    <nav>
    <a href="../User_side/main_page.php">Home</a>
        <a href="../User_side/moviesection.php">Movies</a>
        <a href="../User_side/cinemas.html">Cinemas</a>
        <a href="../User_side/experiences.html">Experiences</a>
        <a href="../User_side/events_booking.php">Events Booking</a>
    </nav>
</div>   
<div class="adm-container">
    <div class="adm">
        <h1>Admin Panel</h1>
        <button onclick="document.location='Add_movie.php'">Add Movie</button>
        <button onclick="document.location='Edit_movies.php'">Edit Movie</button>
        <button onclick="document.location='Delete_movie.php'">Delete Movie</button>
        <button onclick="document.location='Booking_details.php'">Customer Details</button>
        <button onclick="document.location='Login_admin.php'">Log Out</button>
    </div>
</div>
</body>
</html>

