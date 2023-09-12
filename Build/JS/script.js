// Opening button for hamburger menu
document.getElementById('toggleButtonClose').addEventListener('click', function () {
  document.getElementById('menuItems').classList.toggle('hidden');
});

// Closing button for hamburger menu
document.getElementById('openButton').addEventListener('click', function () {
  document.getElementById('menuItems').classList.toggle('hidden');
});

function changeTab(event, index) {
  var tabButtons = document.getElementById('tab-buttons').children;
  var tabPanels = document.getElementById('tab-panels').children;

  // Remove the active utility classes from all tabs (bg-white, text-blue-600)
  // And hide all tab content (with the "hidden" utility)
  for (var i = 0; i < tabButtons.length; i++) {
      tabButtons[i].classList.remove('text-blue-600');
      tabButtons[i].classList.remove('bg-white');
      tabButtons[i].classList.add('text-white');
      tabPanels[i].classList.add('hidden');
  }

  // Add the active utility classes to the currently active tab (bg-white, text-blue-600)
  // And show the current tab content (remove the "hidden" utility)
  tabButtons[index].classList.remove('text-white');
  tabButtons[index].classList.add('text-blue-600');
  tabButtons[index].classList.add('bg-white');
  tabPanels[index].classList.remove('hidden');
}

// Switch between login and signup
document.addEventListener('DOMContentLoaded', function () {
  var registerButton = document.getElementById('registerButton');
  if (registerButton) {
      registerButton.addEventListener('click', function () {
          window.location.href = "../php/registerPage.php";
      });
  }

  var loginButton = document.getElementById('loginButton');
  if (loginButton) {
      loginButton.addEventListener('click', function () {
          window.location.href = "../php/loginPage.php";
      });
  }
});

// Password Toggle
document.addEventListener('DOMContentLoaded', function () {
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirmPassword');
  const togglePassword = document.getElementById('togglePassword');

  if (togglePassword) {
      togglePassword.addEventListener('click', function () {
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              confirmPasswordInput.type = 'text';
          } else {
              passwordInput.type = 'password';
              confirmPasswordInput.type = 'password';
          }
      });
  }
});

// Password Visibility Toggle
document.addEventListener('DOMContentLoaded', function () {
  const passwordInput = document.getElementById('passwordInput');
  const togglePasswordVisibility = document.getElementById('togglePasswordVisibility');

  if (togglePasswordVisibility) {
      togglePasswordVisibility.style.cursor = 'pointer';

      togglePasswordVisibility.addEventListener('click', function () {
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
          } else {
              passwordInput.type = 'password';
          }
      });
  }
});

// Confirm Password
function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var passwordError = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        passwordError.innerText = "Passwords do not match!";
        return false;
    }

    passwordError.innerText = "";
    return true;
}