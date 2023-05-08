// Validation functions

// Function to validate if input is not empty
function validateRequired(input) {
  return input.value.trim() !== "";
}

// Function to validate input length is within specified range
function validateLength(input, minLength, maxLength) {
  return input.value.length >= minLength && input.value.length <= maxLength;
}

// Function to validate if input contains only letters and spaces
function validateText(input) {
  const regex = /^[a-zA-Z\s]+$/;
  return regex.test(input.value);
}

// Function to validate if input is a valid email address
function validateEmail(input) {
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return regex.test(input.value);
}

// Function to validate if input password length is at least 8 characters
function validatePassword(input) {
  return input.value.length >= 8;
}

// Function to validate if password confirmation matches password input
function validatePasswordConfirmation(input, passwordInput) {
  return input.value === passwordInput.value;
}

// Function to validate if input is a number
function validateNumber(input) {
  return !isNaN(input.value);
}

// Function to validate form fields
function validateFields(input, passwordInput) {
  let isValid = false;
  let fieldName = input.name;

  // Validation for First Name input
  if (fieldName === "firstName") {
    isValid =
      validateRequired(input) &&
      validateLength(input, 2, 20) &&
      validateText(input);
  }

  // Validation for Last Name input
  if (fieldName === "lastName") {
    isValid =
      validateRequired(input) &&
      validateLength(input, 2, 20) &&
      validateText(input);
  }

  // Validation for Email input
  if (fieldName === "email") {
    isValid = validateRequired(input) && validateEmail(input);
  }

  // Validation for Password input
  if (fieldName === "password") {
    isValid = validateRequired(input) && validatePassword(input);
  }

  // Validation for Password Confirmation input
  if (fieldName === "passwordConfirmation") {
    isValid =
      validateRequired(input) &&
      validatePasswordConfirmation(input, passwordInput);
  }

  // Validation for Guests input
  if (fieldName === "guests") {
    isValid = validateRequired(input) && validateNumber(input);
  }

  // Validation for Allergies input
  if (fieldName.startsWith("allergies")) {
    isValid = input.value.trim() === "" || validateText(input);
  }

  // Validation for Token input
  if (fieldName === "token") {
    isValid = validateRequired(input);
  }

  // Apply Bootstrap validation styles
  if (isValid) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
  }

  return isValid;
}

// Bootstrap validation
(function () {
  "use strict";

  // Get all forms with class "needs-validation"
  const forms = document.querySelectorAll(".needs-validation");

  // Loop through all forms
  Array.prototype.slice.call(forms).forEach(function (form) {
    // Add event listener for form submission
    form.addEventListener(
      "submit",
      function (event) {
        // Get all input, select, and textarea elements within the form
        let inputs = form.querySelectorAll("input, select, textarea");
        let isFormValid = true;
        const passwordInput = form.querySelector('input[name="password"]');

        // Loop through all form elements to validate them
        inputs.forEach((input) => {
          if (!validateFields(input, passwordInput)) {
            isFormValid = false;
          }
        });

        // If form is invalid, prevent submission
        if (!isFormValid) {
          event.preventDefault();
          event.stopPropagation();
        }
      },
      false
    );
  });
})();
