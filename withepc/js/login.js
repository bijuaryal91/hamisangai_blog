// Update the error message display in the login.js functionality
document.addEventListener("DOMContentLoaded", function () {
  document.querySelector(".login-btn").addEventListener("click", function (e) {
    e.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const checkbox = document.getElementById("remember");
    const error = document.querySelector(".error-messages");
    const success = document.querySelector(".success-messages");
    const errorText = document.querySelector(".error-text");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/login.php");
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          let data = xhr.response;
          if (data == "success") {
            window.location.href = "./index.php";
          } else {
            success.style.display="none";
            error.style.display = "flex";
            errorText.innerHTML = data;
          }
        }
      }
    };
    let formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);
    formData.append("checkbox", checkbox.checked);
    xhr.send(formData);
  });
});
