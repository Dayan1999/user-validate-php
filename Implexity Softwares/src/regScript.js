// Function to handle registration form submission
function register(event) {
  event.preventDefault(); // Prevent form submission

  // Get input values
  var employeeID = document.getElementById("registerEmployeeID").value;
  var name = document.getElementById("registerName").value;
  var email = document.getElementById("registerEmail").value;
  var password = document.getElementById("registerPassword").value;
  var confirmPassword = document.getElementById("confirmPassword").value;

  // Perform front-end validation
  if (employeeID && name && email && password && confirmPassword) {
    // Validate email format
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("Invalid email format.");
    } else if (password !== confirmPassword) {
      alert("Passwords do not match.");
    } else {
      // Proceed with registration
      // Send a POST request to the server-side PHP script
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "register.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            alert(xhr.responseText);
            // Redirect or perform any desired action after successful registration
          } else {
            alert("Error registering user. Please try again later.");
          }
        }
      };
      xhr.send(
        "employeeID=" + employeeID +
        "&name=" + name +
        "&email=" + email +
        "&password=" + password
      );
    }
  } else {
    alert("Please fill in all fields.");
  }
}

// Get the register form element
var registerForm = document.getElementById("registerForm");
// Attach the register function to the form's submit event
registerForm.addEventListener("submit", register);
