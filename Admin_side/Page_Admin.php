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
        <a href="#">Home</a>
        <a href="#">Movies</a>
        <a href="#">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>
        <a href="#">Events Booking</a>
    </nav>
</div>   
<div class="adm-container">
    <div class="adm">
        <h1>Admin Panel</h1>
        <button onclick="document.location='Movie_Sections.html'">Add Movie</button>
        <button onclick="document.location='Edit_movies.php'">Edit Movie</button>
        <button onclick="document.location='Delete_movie.php'">Delete Movie</button>
        <button onclick="document.location='Customer_details.html'">Customer Details</button>
        <button onclick="document.location='Login_admin.php'">Log Out</button>
    </div>
</div>
</body>
</html>

