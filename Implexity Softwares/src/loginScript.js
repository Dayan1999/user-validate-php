// Function to handle login form submission
function login(event) {
    event.preventDefault(); // Prevent form submission
  
    // Get input values
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
  
    // Perform front-end validation
    if (email && password) {
      // Send a POST request to the server-side PHP script
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "login.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            alert(xhr.responseText);
            // Redirect or perform any desired action after successful login
          } else {
            alert("Login failed. Please try again.");
          }
        }
      };
      xhr.send("email=" + email + "&password=" + password);
    } else {
      alert("Please fill in all fields.");
    }
  }
  
  // Get the login form element
  var loginForm = document.getElementById("loginForm");
  // Attach the login function to the form's submit event
  loginForm.addEventListener("submit", login);
  