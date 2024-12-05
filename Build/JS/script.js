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
          window.location.href = "../../index.php"; // Redireecting to homePage
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
      //console.log(JSON.parse(xhr.responseText)); // Add this line
      if (xmr.status === 200) {
        var response = JSON.parse(xmr.responseText);
        if (response.success) {
          window.location.href = "../../index.php";
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
      displayFlights(flights);
    }
  };

  xhr.send(params);
}

//Display One Way Flights

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
    document.getElementById("flightId").textContent = flight.flight_id;
    document.getElementById("flightOrigin").textContent = flight.origin;
    document.getElementById("flightPrice").textContent = "Rs " + flight.price;
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

function flightNumberResults() {
  var flightNum = document.getElementById("flightId").value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./statusFetch.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var params = "flightNum=" + flightNum;

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      //console.log(xhr.responseText);
      var flights = JSON.parse(xhr.responseText);
      displayStatusFlights(flights);
    }
  };

  xhr.send(params);
}

function displayStatusFlights(flights) {
  if (flights.length > 0) {
    var flight = flights[0];
    document.getElementById("result_fetch_content").classList.remove("hidden");

    document.getElementById("flightArrivalTime").textContent = flight.arrival;
    document.getElementById("flightArrivalDate").textContent =
      flight.arrival_day;
    document.getElementById("flightDepartTime").textContent = flight.depart;
    document.getElementById("flightDepartDate").textContent = flight.depart_day;
    document.getElementById("flightDestination").textContent =
      flight.destination;
    document.getElementById("flightId").textContent = flight.flight_id;
    document.getElementById("flightOrigin").textContent = flight.origin;
    //document.getElementById("flightPrice").textContent = "Rs " + flight.price;
  }
}

function flightRouteResults() {
  var routeOrigin = document.getElementById("routeOrigin").value;
  var routeDestination = document.getElementById("routeDestination").value;
  var departDateRoute = document.getElementById("departDateRoute").value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./statusFetch.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  var params =
    "routeOrigin=" +
    routeOrigin +
    "&routeDestination=" +
    routeDestination +
    "&departDateRoute=" +
    departDateRoute;

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var routeFlights = JSON.parse(xhr.responseText);
      displayRouteStatusFlights(routeFlights);
    }
  };

  xhr.send(params);
}

function displayRouteStatusFlights(flights) {
  if (flights.length > 0) {
    var flight = flights[0];
    document
      .getElementById("result_fetch_route_content")
      .classList.remove("hidden");

    document.getElementById("flightRouteArrivalTime").textContent =
      flight.arrival;
    document.getElementById("flightRouteArrivalDate").textContent =
      flight.arrival_day;
    document.getElementById("flightRouteDepartTime").textContent =
      flight.depart;
    document.getElementById("flightRouteDepartDate").textContent =
      flight.depart_day;
    document.getElementById("flightRouteDestination").textContent =
      flight.destination;
    document.getElementById("flightRouteId").textContent = flight.flight_id;

    document.getElementById("flightRouteOrigin").textContent = flight.origin;
  }
}

//Book ticket

function checkLoginAndBook() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "./check_login.php", true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);

      if (response.isLoggedIn) {
        // Now that we have the user_id from the backend, send the ticket booking request
        var flightId = document.getElementById("flightId").innerText;
        var passengerCount = document.getElementById("passengers").value;

        bookTicket(flightId, passengerCount);
      } else {
        alert("You need to log in before booking a ticket.");
        window.location.href = "loginPage.php";  // Redirect to login page if not logged in
      }
    }
  };

  xhr.send();
}

function bookTicket(flight_id, passenger_count) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./bookTicket.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // Sending the flight_id and passenger_count to the backend for booking
  var params = "flight_id=" + encodeURIComponent(flight_id) + "&passenger_count=" + encodeURIComponent(passenger_count);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          alert("Booking successful!");
        } else {
          alert("Booking failed. Please try again.");
        }
      } else {
        alert("Error: " + xhr.status);
      }
    }
  };

  xhr.send(params);
}