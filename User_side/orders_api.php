<?php
header('Content-Type: application/json');
include 'db_connection.php'; 

$conn = connect_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $theater = $_POST['theater'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $seats = $_POST['seats'];
    $price = $_POST['price'];

}

