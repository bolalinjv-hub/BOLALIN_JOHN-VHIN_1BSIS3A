<?php
session_start();

// connection to the database
$host         = "localhost";
$usern        = "root";
$password     = "";
$databaseName = "bolalinbsis3A";

// using mysqli connection
$connection = new mysqli($host, $usern, $password, $databaseName);

// data from input tag
$username = $_POST['username'];
$password = $_POST['password'];

// query coming from database
$query  = "SELECT * FROM member";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {

    // checked the matching credential
    if ($username == $row['username'] && $password == $row['password']) {

        $_SESSION['fname'] = $row['FirstName'];
        $_SESSION['lname'] = $row['LastName'];
        header('location: home.php');
    } else {
        echo "Denied";
    }
