<?php 
  session_start(); 

  if (!isset($_SESSION['adminid'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: Login_Admin.php');
  }
  if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['adminid']);
        header("location: Login_Admin.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="adminstyle.css">
</head>
<body>

<div class="header">
        <h2>Home Page</h2>
</div>
<div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
          ?>
        </h3>
      </div>
        <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['adminid'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['adminid']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
                
</body>
</html>