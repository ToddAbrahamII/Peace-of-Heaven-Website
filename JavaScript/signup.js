document.addEventListener("DOMContentLoaded", function () {
    // Get the form and input elements by their IDs
    var loginForm = document.querySelector(".signup-container");
    var usernameInput = document.getElementById("User_Name");
    var passwordInput = document.getElementById("Password");
  
    // Add a submit event listener to the form
    loginForm.addEventListener("submit", function (event) {
      var usernameValue = usernameInput.value;
      var passwordValue = passwordInput.value;
  
      // Define regular expressions for validation
      var usernamePattern = /^[A-Z].{4,}$/; //At least 5 charactes in length and one uppercase
      var passwordPattern = /^(?=.*[A-Z])(?=.*\d).{6,}$/; //At least 6 characters, one uppercase and one number
  
      // Check if the username and password match the patterns
      if (!usernamePattern.test(usernameValue) || !passwordPattern.test(passwordValue)) {
        // Display a pop-up error message
        alert("Wrong Input.");
        event.preventDefault(); // Prevent form submission
      }
    });
  });
  