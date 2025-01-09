<?php
session_start();

// initializing variables
$adminid = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_admin'])) {
  // receive all input values from the form
  $adminid = mysqli_real_escape_string($db, $_POST['adminid']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($adminid)) { array_push($errors, "Admin ID is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
        array_push($errors, "The passwords do not match!");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admins WHERE adminid='$adminid' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $admin = mysqli_fetch_assoc($result);
  
  if ($admin) { // if admin exists
    if ($admin['adminid'] === $adminid) {
      array_push($errors, "Username already exists");
    }

    if ($admin['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO admins (adminid, email, password) 
                          VALUES('$adminid', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['adminid'] = $adminid;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_admin'])) {
    $adminid = mysqli_real_escape_string($db, $_POST['adminid']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($adminid)) {
          array_push($errors, "Admin ID is required");
    }
    if (empty($password)) {
          array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
          $password = md5($password);
          $query = "SELECT * FROM admins WHERE adminid='$adminid' AND password='$password'";
          $results = mysqli_query($db, $query);
          if (mysqli_num_rows($results) == 1) {
            $_SESSION['adminid'] = $adminid;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
          }else {
                  array_push($errors, "Wrong Admin ID/password combination, please try again");
          }
    }
  }
  
  ?>