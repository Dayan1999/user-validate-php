<?php
// Database configuration
$host = 'your_database_host';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database_name';

// Establish a connection to the database
$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Get the login data from the POST request
$email = $_POST['email'];
$password = $_POST['password'];

// Perform server-side validation
if ($email && $password) {
  // Retrieve the user record from the database
  $selectQuery = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($connection, $selectQuery);
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    // Verify the password
    if (password_verify($password, $row['password'])) {
      echo "Login successful!";
      // Redirect or perform any desired action after successful login
    } else {
      http_response_code(401);
      echo "Invalid email or password.";
    }
  } else {
    http_response_code(401);
    echo "Invalid email or password.";
  }
} else {
  http_response_code(400);
  echo "Please fill in all fields.";
}

// Close the database connection
mysqli_close($connection);
?>
