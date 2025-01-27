// script.js

function validateForm() {
    // Get form elements
    var name = document.forms["registrationForm"]["name"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var phone = document.forms["registrationForm"]["phone"].value;
    var password = document.forms["registrationForm"]["password"].value;
    var confirmPassword = document.forms["registrationForm"]["confirmPassword"].value;

    // Initialize error message
    var errorMessage = '';

    // Name validation: must be at least 3 characters
    if (name.length < 3) {
        errorMessage += "Name must be at least 3 characters long.\n";
    }

    // Email validation: must contain "@" and "."
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email.match(emailPattern)) {
        errorMessage += "Please enter a valid email address.\n";
    }

    // Phone number validation: must be a 10-digit number
    var phonePattern = /^[0-9]{10}$/;
    if (!phone.match(phonePattern)) {
        errorMessage += "Phone number must be exactly 10 digits.\n";
    }

    // Password validation: must be at least 6 characters
    if (password.length < 6) {
        errorMessage += "Password must be at least 6 characters long.\n";
    }

    // Password match validation
    if (password !== confirmPassword) {
        errorMessage += "Passwords do not match.\n";
    }

    // If there are any errors, display them and prevent form submission
    if (errorMessage !== '') {
        document.getElementById("error-message").innerText = errorMessage;
        return false;  // Prevent form submission
    }

    // If no errors, form is valid
    return true;
}
