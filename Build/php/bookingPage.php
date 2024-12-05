<?php
session_start();

include("connection.php");
include_once("functions.php");

//$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fly - Booking</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <!-----Navbar------->
  <div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex items-center lg:flex-1">
          <a href="../../index.php" class="flex items-center">
            <img class="h-8 w-auto" src="../images/navbar-photo.png" alt="company-logo">
            <span class="self-center text-2xl pl-4 font-semibold whitespace-nowrap dark:text-black-400">Fly</span>
          </a>
        </div>
        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" id="openButton">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:flex lg:flex-1 justify-center lg:gap-x-12" id="openMenuItems">
          <a href="../../index.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Home</a>
          <a href="../php/bookingPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Booking</a>
          <a href="../php/statusPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Status</a>
          <a href="../php/contactPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Contact us</a>
        </div>
        <?php
        show_login();
        ?>
      </nav>
      <!-- Mobile menu, show/hide based on menu open state. -->
      <div class="hidden" role="dialog" aria-modal="true" id="menuItems">
        <!---Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-50"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" id="toggleButtonClose">
              <span class="sr-only">Close menu</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="space-y-2 py-6">
                <a href="../../index.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Home</a>
                <a href="../php/bookingPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Booking</a>
                <a href="../php/statusPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Status</a>
                <a href="../php/contactPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Contact us</a>
              </div>
              <?php
              if (isset($_SESSION['username'])) {
                echo '<div class="lg:flex lg:flex-1 lg:justify-end">';
                echo '<span class="text-sm font-semibold leading-6 text-gray-900 hover:underline">' . $_SESSION['username'] . '</span>';
                echo '<form action="../php/logout.php" method="post">';
                echo '<input type="submit" value="Logout" class="hover:underline mt-5">';
                echo '</form>';
                echo '</div>';
              } else {
                // If the user is not logged in, show the login button
                echo '<div class="lg:flex lg:flex-1 lg:justify-end">';
                echo '<a href="../php/loginPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Log in<span aria-hidden="true"></span></a>';
                echo '</div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </header>



    <!-----------------------------Hero Section------------------------------------->
    <div class=" flex relative isolate px-6 pt-14 lg:px-8">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-b from-sky-400 to-sky-200 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
    </div>

    <!-----------Booking Form------------>
    <div class="w-2/3 mx-auto py-32 sm:py-48 lg:py-56" id="booking-form">
      <div class="relative block text-center mb-8">
        <span class="mx-auto text-3xl font-bold">Flight Reservation</span>
      </div>

      <!--------One Way Form--------->
      <div data-tab-content="" class="p-5">
        <div class="block opacity-100" id="app" role="tabpanel">
          <p class="block font-sans text-base font-light leading-relaxed text-inherit text-gray-500 antialiased">
          <form class="m-auto bg-white drop-shadow-lg rounded-lg overflow-hidden  accent-gray-800" id="one_way_form" onsubmit="one_way_form(); return false">
            <div class="p-6">
              <div class="flex-1 max-xs:flex-col gap-4">
                <div class="mt-4 relative ">
                  <div class="absolute top-0 left-0 w-8 h-8 flex justify-center items-center">
                    <i class="fa fa-location-arrow"></i>
                  </div>
                  <input class="w-full bg-gray-100 text-xs font-bold border-none py-2 pl-8 pr-4 rounded placeholder:text-gray-800" placeholder="Boarding from..." type="text" id="origin" required>
                </div>
                <div class="mt-4 relative">
                  <div class="absolute top-0 left-0 w-8 h-8 flex justify-center items-center">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <input class="w-full bg-gray-100 text-xs font-bold border-none py-2 pl-8 pr-4 rounded placeholder:text-gray-800" placeholder="Destination..." type="text" id="destination" required>
                </div>
              </div>
              <div class="flex max-xs:flex-col gap-4 mt-4">
                <div class="flex-1 relative">
                  <div class="absolute top-0 left-0 w-8 h-8 flex justify-center items-center">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="w-full bg-gray-100 text-xs font-bold border-none py-2 pl-8 pr-4 rounded placeholder:text-gray-800" type="text" placeholder="Depart" id="depart_date" onfocus="(this.type='date')" required>
                </div>

              </div>
              <div class="flex max-xs:flex-col gap-4 mt-4">
                <div class="flex-1 relative">
                  <div class="absolute top-0 left-0 w-8 h-8 flex justify-center items-center">
                    <i class="fa fa-user"></i>
                  </div>
                  <select id="passengers" name="passengers" class="w-full bg-gray-100 text-xs font-bold border-none py-2 pl-8 pr-4 rounded placeholder:text-gray-800" required>
                    <option value="1">1 Passenger</option>
                    <option value="2">2 Passengers</option>
                    <option value="3">3 Passengers</option>
                  </select>
                </div>
              </div>
            </div>
            <div>
              <button class="bg-gray-800 uppercase py-4 w-full text-white text-xs tracking-widest">Search Flights</button>
            </div>
          </form>
          </p>

          <!----Flight Card Showing results--->
          <div class="p-10 hidden" id="results_content">
            <div class="max-w-full  bg-white flex flex-col rounded overflow-hidden shadow-lg">
              <div class="mt-2 flex sm:flex-row mx-6 sm:justify-between flex-wrap ">
                <div class="flex flex-row place-items-center p-2">
                  <img alt="#" class="w-10 h-10" src="../images/flightCardLogo.jpg" style="opacity: 1; transform-origin: 0% 50% 0px; transform: none;" />
                  <div class="flex flex-col ml-2">
                    <p class="text-xs text-gray-500 font-bold" id="flightId">
                    </p>
                  </div>
                </div>
                <div class="flex flex-col p-2">
                  <p class="font-bold" id="flightDepartTime"></p>
                  <p class="text-gray-500" id="flightOrigin"></p>
                </div>
                <div class="flex flex-col flex-wrap p-2">
                  <p class="font-bold" id="flightArrivalTime"></p>
                  <p class="text-gray-500" id="flightDestination"></p>
                </div>
              </div>
              <div class="mt-4 bg-gray-100 flex flex-row flex-wrap md:flex-nowrap justify-between items-baseline">
                <div class="flex mx-6 py-4 flex-row flex-wrap">
                  <svg class="w-12 h-10 p-2 mx-2 self-center bg-gray-400 rounded-full fill-current text-white" viewBox="0 0 64 64" pointer-events="all" aria-hidden="true" role="presentation">
                    <path d="M43.389 38.269L29.222 61.34a1.152 1.152 0 01-1.064.615H20.99a1.219 1.219 0 01-1.007-.5 1.324 1.324 0 01-.2-1.149L26.2 38.27H11.7l-3.947 6.919a1.209 1.209 0 01-1.092.644H1.285a1.234 1.234 0 01-.895-.392l-.057-.056a1.427 1.427 0 01-.308-1.036L1.789 32 .025 19.656a1.182 1.182 0 01.281-1.009 1.356 1.356 0 01.951-.448l5.4-.027a1.227 1.227 0 01.9.391.85.85 0 01.2.252L11.7 25.73h14.5L19.792 3.7a1.324 1.324 0 01.2-1.149A1.219 1.219 0 0121 2.045h7.168a1.152 1.152 0 011.064.615l14.162 23.071h8.959a17.287 17.287 0 017.839 1.791Q63.777 29.315 64 32q-.224 2.685-3.807 4.478a17.282 17.282 0 01-7.84 1.793h-9.016z"></path>
                  </svg>
                  <div class="text-sm mx-2 flex flex-col">
                    <p class="">Standard Ticket</p>
                    <p class="font-bold" id="flightPrice"></p>
                    <p class="text-xs text-gray-500">Price per adult</p>
                  </div>
                  <button class="w-32 h-11 rounded flex border-solid border bg-white mx-2 justify-center place-items-center">
                    <div onclick="checkLoginAndBook()">Book</div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-----------------Footer----------------->
  <footer class="bg-white rounded-lg m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
      <div class="sm:flex sm:items-center sm:justify-between">
        <a href="../../index.php" class="flex items-center mb-4 sm:mb-0">
          <img src="../images/navbar-photo.png" class="h-8 mr-3" alt="company-logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-black">Fly</span>
        </a>
        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-white-400">
          <li>
            <a href="../../index.php#about-us-content" class="mr-4 hover:underline md:mr-6 ">About</a>
          </li>
          <li>
            <a href="../php/contactPage.php" class="hover:underline">Contact</a>
          </li>
        </ul>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <span class="block text-sm text-gray-500 sm:text-center dark:text-white-400">© 2023 <a href="../../index.php" class="hover:underline">Fly™</a>. All Rights Reserved.</span>
    </div>
  </footer>


  <script src="../JS/script.js"></script>
  <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script>


</body>

</html>