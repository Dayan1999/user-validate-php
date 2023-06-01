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

// Get the registration data from the POST request
$employeeID = $_POST['employeeID'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Perform server-side validation
if ($employeeID && $name && $email && $password) {
  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Invalid email format.";
    exit();
  }

  // Check if the email already exists in the database
  $emailExistsQuery = "SELECT * FROM users WHERE email = '$email'";
  $emailExistsResult = mysqli_query($connection, $emailExistsQuery);
  if (mysqli_num_rows($emailExistsResult) > 0) {
    http_response_code(400);
    echo "Email already exists.";
    exit();
  }

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insert the registration data into the database
  $insertQuery = "INSERT INTO users (employeeID, name, email, password) VALUES ('$employeeID', '$name', '$email', '$hashedPassword')";
  if (mysqli_query($connection, $insertQuery)) {
    echo "Registration successful!";
  } else {
    http_response_code(500);
    echo "Error registering user: " . mysqli_error($connection);
  }
} else {
  http_response_code(400);
  echo "Please fill in all fields.";
}

// Close the database connection
mysqli_close($connection);
?>
