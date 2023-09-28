// Toggle hamburgerMenu
document
  .getElementById("toggleButtonClose")
  .addEventListener("click", toggleMenu);
document.getElementById("openButton").addEventListener("click", toggleMenu);

// Function to toggle menu visibility
function toggleMenu() {
  document.getElementById("menuItems").classList.toggle("hidden");
}

function changeTab(event, index) {
  var tabButtons = document.getElementById("tab-buttons").children;
  var tabPanels = document.getElementById("tab-panels").children;

  // Remove the active utility classes from all tabs (bg-white, text-blue-600)
  // And hide all tab content (with the "hidden" utility)
  for (var i = 0; i < tabButtons.length; i++) {
    tabButtons[i].classList.remove("text-blue-600");
    tabButtons[i].classList.remove("bg-white");
    tabButtons[i].classList.add("text-white");
    tabPanels[i].classList.add("hidden");
  }

  // Add the active utility classes to the currently active tab (bg-white, text-blue-600)
  // And show the current tab content (remove the "hidden" utility)
  tabButtons[index].classList.remove("text-white");
  tabButtons[index].classList.add("text-blue-600");
  tabButtons[index].classList.add("bg-white");
  tabPanels[index].classList.remove("hidden");
}

// Switch between login and signup
document.addEventListener("DOMContentLoaded", function () {
  addNavigationListener("registerButton", "../php/registerPage.php");
  addNavigationListener("loginButton", "../php/loginPage.php");
});

// Function to add navigation event listener
function addNavigationListener(buttonId, targetPage) {
  const button = document.getElementById(buttonId);
  if (button) {
    button.addEventListener("click", function () {
      window.location.href = targetPage;
    });
  }
}

// Password Toggle
document.addEventListener("DOMContentLoaded", function () {
  togglePasswordVisibility("password", "confirmPassword", "togglePassword");
  togglePasswordVisibility("passwordInput", null, "togglePasswordVisibility");
});

// Function to toggle password visibility
function togglePasswordVisibility(
  passwordId,
  confirmPasswordId,
  toggleButtonId
) {
  const passwordInput = document.getElementById(passwordId);
  const confirmPasswordInput = confirmPasswordId
    ? document.getElementById(confirmPasswordId)
    : null;
  const toggleButton = document.getElementById(toggleButtonId);

  if (toggleButton) {
    toggleButton.addEventListener("click", function () {
      passwordInput.type =
        passwordInput.type === "password" ? "text" : "password";
      if (confirmPasswordInput) {
        confirmPasswordInput.type =
          confirmPasswordInput.type === "password" ? "text" : "password";
      }
    });
  }
}

// Confirm Password
function validateForm() {
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var passwordError = document.getElementById("passwordError");

  if (password !== confirmPassword) {
    passwordError.innerText = "Passwords do not match!";
    return false;
  }

  if (password.length < 8) {
    passwordError.innerText = "Password must be at least 8 characters long!";
    return false;
  }

  var formData = new FormData(document.querySelector("form"));

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Registration was successful, you can optionally redirect the user here
          window.location.href = "homePage.php"; // Redireecting to homePage
          alert("Registraion Successfull");
        } else {
          passwordError.innerText = response.message; // Display registration error
        }
      } else {
        alert("Error: Unable to register. Please try again later."); // Handle server errors
      }
    }
  };

  // Instead of submitting the form directly, send an AJAX request
  xhr.open("POST", "registerProcess.php", true);
  xhr.send(formData);

  // Prevent the form from submitting
  return false;
}

/*document.getElementById("username").addEventListener("input", function () {
  document.getElementById("usernameAvailability").innerText = ""; // Clear username availability message
});

document.getElementById("email").addEventListener("input", function () {
  document.getElementById("emailAvailability").innerText = ""; // Clear email availability message
});*/

//Checking Login info

function validateLoginForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("passwordInput").value;
  var errorContainer = document.getElementById("errorContainer");

  errorContainer.innerText = "";

  // Send an AJAX request to the server
  var xmr = new XMLHttpRequest();
  xmr.onreadystatechange = function () {
    if (xmr.readyState === 4) {
      //console.log(JSON.parse(xhr.responseText));
      if (xmr.status === 200) {
        var response = JSON.parse(xmr.responseText);
        if (response.success) {
          // Redirect or show success message
          //alert("Login Successful");
          window.location.href = "homePage.php";
        } else {
          // Show the error message from the server
          errorContainer.innerText = response.message;
        }
      } else {
        // Handle server error (if any)
        console.error("Error:", xmr.status);
      }
    }
  };

  xmr.open("POST", "loginProcess.php", true);
  xmr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmr.send(
    "username=" +
      encodeURIComponent(username) +
      "&password=" +
      encodeURIComponent(password)
  );

  // Prevent form from submitting
  return false;
}

//One Way Form

function one_way_form() {
  var origin = document.getElementById("origin").value;
  var destination = document.getElementById("destination").value;
  var departDate = document.getElementById("depart_date").value;
  var passengerCount = document.getElementById("passengers").value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./fetchFlights.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var params =
    "origin=" +
    origin +
    "&destination=" +
    destination +
    "&departDate=" +
    departDate +
    "&passengerCount=" +
    passengerCount;

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var flights = JSON.parse(xhr.responseText);
      //console.log(flights);  //For testing the JSON file returned
      displayFlights(flights);
    }
  };

  xhr.send(params);
}

//Display Flights

function displayFlights(flights) {
  if (flights.length > 0) {
    var flight = flights[0];
    document.getElementById("results_content").classList.remove("hidden");

    document.getElementById("flightArrivalTime").textContent = flight.arrival;
    //document.getElementById("flightArrivalDate").textContent =
    //flight.arrival_day;
    document.getElementById("flightDepartTime").textContent = flight.depart;
    // document.getElementById("flightDepartDate").textContent = flight.depart_day;
    document.getElementById("flightDestination").textContent =
      flight.destination;
    // document.getElementById("flightDuration").textContent = flight.duration;
    document.getElementById("flightId").textContent = flight.flight_id;
    //document.getElementById("flightNum").textContent = flight.flight_num; // Change to duration
    document.getElementById("flightOrigin").textContent = flight.origin;
    document.getElementById("flightPrice").textContent = "Rs " + flight.price;
    //document.getElementById("flightSeatsAvailable").textContent =
    //flight.seats_available;
  }
}

function searchFlight() {
  // Flight ID search
  var flightId = document.getElementById("flightId").value;
  if (flightId !== "") {
    document.getElementById("searchByflightId").submit();
  } else {
    alert("Please enter a flight ID.");
    return false;
  }
}

function searchFlightRoute() {
  // Route search
  var boardingFrom = document.getElementById("boardingFrom").value;
  var destination = document.getElementById("destination").value;
  if (boardingFrom !== "" && destination !== "") {
    document.getElementById("searchByRoute").submit();
  } else {
    alert("Please enter both boarding from and destination.");
    return false;
  }
}
