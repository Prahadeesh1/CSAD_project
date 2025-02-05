<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
</head>
<body>
<!-- Header Navigation -->
<div class="navbar">
    <img src="static_image/logo.png" alt="Logo">
    <nav>
        <a href="../User_side/main_page.html">Home</a>
        <a href="#">Movies</a>
        <a href="#">Cinemas</a>
        <a href="#">Experiences</a>
        <a href="#">Shop</a>  
        <a href="#">Events Booking</a>
    </nav>
</div>
  <div class="header">
        <h2>Login</h2>
  </div>
         
  <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" >
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
        </div>
        <div class="input-group">
                <button type="submit" class="btn" name="login_user">Login</button>
        </div>
  </form>
</body>
</html>