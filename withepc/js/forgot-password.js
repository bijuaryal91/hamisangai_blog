document.addEventListener("DOMContentLoaded", function () {
  const resetBtn = document.querySelector(".reset-btn");
  const errorMessage = document.querySelector(".error-message");
  const successMessage = document.querySelector(".success-message");
  const emailEl = document.getElementById("email");

 

  resetBtn.addEventListener("click", function (e) {
    e.preventDefault(); // Prevent default form submission

    // Get email value and trim whitespace
    const email = emailEl.value.trim();

    // Basic client-side validation
    if (!email) {
      errorMessage.innerHTML =
        '<i class="fas fa-exclamation-circle"></i> Please enter your email address';
      errorMessage.style.display = "flex";
      successMessage.style.display = "none";
      return;
    }

    // Create XMLHttpRequest
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/forgot-password.php", true); // Use the correct PHP file path from your form action

    xhr.onload = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.responseText.trim();
          if (data === "success") {
            // Show success message
            successMessage.innerHTML =
              '<i class="fas fa-check-circle"></i> Password reset link has been sent to your email.';
            successMessage.style.display = "flex";
            errorMessage.style.display = "none";
            emailEl.value = ""; // Clear the input
          } else {
            // Show error message
            errorMessage.innerHTML =
              '<i class="fas fa-exclamation-circle"></i> ' + data;
            errorMessage.style.display = "flex";
            successMessage.style.display = "none";
          }
        } else {
          // Handle non-200 status codes
          errorMessage.innerHTML =
            '<i class="fas fa-exclamation-circle"></i> An error occurred. Please try again later.';
          errorMessage.style.display = "flex";
          successMessage.style.display = "none";
        }
      }
    };

    // Handle network errors
    xhr.onerror = function () {
      errorMessage.innerHTML =
        '<i class="fas fa-exclamation-circle"></i> Network error. Please check your connection and try again.';
      errorMessage.style.display = "flex";
      successMessage.style.display = "none";
    };

    // Prepare and send form data
    let formData = new FormData();
    formData.append("email", email);
    xhr.send(formData);
  });
});
