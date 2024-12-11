<?php
session_start();

include("Build/php/connection.php");
include_once("Build/php/functions.php");

//$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fly - Home</title>
  <link rel="shortcut icon" href="Build/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="Build/css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <!----Navbar---->

  <div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex items-center lg:flex-1">
          <a href="#" class="flex items-center">
            <img href="index.php" class="h-8 w-auto" src="Build/images/navbar-photo.png" alt="company-logo">
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
  <a href="#" class="text-sm font-semibold leading-6 text-white hover:underline">Home</a>
  <a href="Build/php/bookingPage.php" class="text-sm font-semibold leading-6 text-white hover:underline">Booking</a>
  <a href="Build/php/statusPage.php" class="text-sm font-semibold leading-6 text-white hover:underline">Status</a>
  <a href="Build/php/contactPage.php" class="text-sm font-semibold leading-6 text-white hover:underline">Contact us</a>
</div>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<div class="hidden lg:flex lg:flex-1 lg:justify-end">';
          echo '<span class="text-sm font-semibold leading-6 text-white hover:underline mx-5">' . $_SESSION['username'] . '</span>';
          echo '<form action="./Build/php/logout.php" method="post">';
          echo '<input type="submit" value="Logout" class="hover:underline">';
          echo '</form>';
          echo '</div>';
        } else {
          // If the user is not logged in, show the login button
          echo '<div class="hidden lg:flex lg:flex-1 lg:justify-end">';
          echo '<a href="./Build/php/loginPage.php" class="text-sm font-semibold leading-6 text-white hover:underline">Log in<span aria-hidden="true">&rarr;</span></a>';
          echo '</div>';
        }
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
                <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Home</a>
                <a href="Build/php/bookingPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Booking</a>
                <a href="Build/php/statusPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Status</a>
                <a href="Build/php/contactPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Contact us</a>
              </div>
              <?php
              if (isset($_SESSION['username'])) {
                echo '<div class="lg:flex lg:flex-1 lg:justify-end">';
                echo '<span class="text-sm font-semibold leading-6 text-gray-900 hover:underline">' . $_SESSION['username'] . '</span>';
                echo '<form action="./Build/php/logout.php" method="post">';
                echo '<input type="submit" value="Logout" class="hover:underline mt-5">';
                echo '</form>';
                echo '</div>';
              } else {
                // If the user is not logged in, show the login button
                echo '<div class="lg:flex lg:flex-1 lg:justify-end">';
                echo '<a href="./Build/php/loginPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Log in<span aria-hidden="true"></span></a>';
                echo '</div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </header>


    <!-----Hero Section---->
    <div class="w-full min-h-screen flex items-center justify-center relative bg-cover bg-center" style="background-image: url('Build/images/dbmmm.jpg');">
  <div class="absolute inset-0 bg-black bg-opacity-40"></div> <!-- Optional overlay -->
  <div class="text-center relative z-10">
    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Fly high with AIR DBM</h1>
    <p class="mt-6 text-lg leading-8 text-gray-200">Experience hassle-free airplane ticket booking.</p>
    <br><br>
    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
        <a href="Build/php/bookingPage.php" class="inline-flex contact-button justify-center hover:text-gray-900 items-center py-3 px-5 text-base font-medium text-center text-[#FFFFFF] rounded-lg border border-[#FFFFFF] hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
          Book Now
        </a>
    </div>
  </div>
</div>


  <!---About us---->

  <section class="bg-center bg-no-repeat bg-about-us-image  bg-gray-700 bg-blend-multiply " id="about-us-content">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">About us</h1>
      <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">AIR DBM is a leading airplane ticket booking platform based in WestBengal, Chittranjan India. Our mission is to make air travel accessible and affordable for everyone. With a user-friendly interface and a vast selection of airlines and routes, we provide a seamless booking experience for our customers.</p>
      <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
        <a href="Build/php/contactPage.php" class="inline-flex contact-button justify-center hover:text-gray-900 items-center py-3 px-5 text-base font-medium text-center text-[#676E78] rounded-lg border border-[#676E78] hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
          Contact us
        </a>
      </div>
    </div>
  </section>


  <!-----Our Services Section---->

  <section class="bg-gray-100 py-16">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Our Services</h2>

      <div class="flex justify-center items-center space-x-8">
        <!-- Service 1 -->
        <div class="max-w-sm">
          <img src="Build/images/our-services-photo-1.jpg" alt="Service 1" class="w-80 h-80 mx-auto mb-4 rounded-full">
          <h3 class="text-2xl font-bold mb-2 text-center">Flexible Booking Options</h3>
          <p class="text-gray-700 text-center">Choose from a variety of booking options that fit your travel needs.</p>
        </div>

        <!-- Service 2 -->
        <div class="max-w-sm">
          <img src="Build/images/our-services-photo-2.jpg" alt="Service 2" class="w-80 h-80 mx-auto mb-4 rounded-full">
          <h3 class="text-2xl font-bold mb-2 text-center">24/7 Customer Support</h3>
          <p class="text-gray-700 text-center">Our dedicated team of experts are available round-the-clock to assist you.</p>
        </div>

        <!-- Service 3 -->
        <div class="max-w-sm">
          <img src="Build/images/our-services-photo-3.jpg" alt="Service 3" class="w-80 h-80  mx-auto mb-4 rounded-full">
          <h3 class="text-2xl font-bold mb-2 text-center">Easy Cancellation Policy</h3>
          <p class="text-gray-700 text-center">Cancel or modify your booking hassle-free with our easy cancellation policy.</p>
        </div>
      </div>
    </div>
  </section>


  <!-----Quote--->
  <section class="bg-white dark:bg-white-900">
    <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
      <figure class="max-w-screen-md mx-auto">
        <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor" />
        </svg>
        <blockquote>
          <p class="text-2xl font-medium text-gray-900 dark:text-black">"I had a fantastic experience booking my airplane tickets with AIR DBM. Their service was efficient and their staff was friendly and helpful. Thank you for making my travel plans stress-free!"</p>
        </blockquote>
        <figcaption class="flex items-center justify-center mt-6 space-x-3">
          <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
            <div class="pr-3 font-medium text-gray-900 dark:text-black">Zhongli</div>
            <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">CEO of GEO</div>
          </div>
        </figcaption>
      </figure>
    </div>
  </section>

  <!-----Footer-->

  <footer class=" rounded-lg m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
      <div class="sm:flex sm:items-center sm:justify-between">
        <a href="#" class="flex items-center mb-4 sm:mb-0">
          <img src="Build/images/navbar-photo.png" class="h-8 mr-3" alt="company-logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-black">Fly</span>
        </a>
        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-white-400">
          <li>
            <a href="#about-us-content" class="mr-4 hover:underline md:mr-6 ">About</a>
          </li>
          <li>
            <a href="Build/php/contactPage.php" class="hover:underline">Contact</a>
          </li>
        </ul>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <span class="block text-sm text-gray-500 sm:text-center dark:text-white-400">© 2024 <a class="hover:underline">AIR DBM™</a>. All Rights Reserved.</span>
    </div>
  </footer>


  <!------------Javascript---------->
  <script src="Build/JS/script.js"></script>


</body>

</html>