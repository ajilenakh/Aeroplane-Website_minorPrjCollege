<?php
session_start();

include("connection.php");
include("functions.php");

//$user_data = check_login($con);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fly - Login</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"><!---Favicon--->
  <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"-->
  <script src="https://cdn.tailwindcss.com"></script>
  <!--script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script-->
</head>

<body>

  <!-----Navbar---->
  <div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
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
        <div class="hidden lg:flex lg:gap-x-12 " id="openMenuItems">
          <a href="../../index.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Home</a>
          <a href="../php/bookingPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Booking</a>
          <a href="../php/statusPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Status</a>
          <a href="../php/contactPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Contact us</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <a href="../php/loginPage.php" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">Log in <span aria-hidden="true">&rarr;</span></a>
        </div>
      </nav>
      <!-- Mobile menu, show/hide based on menu open state. -->
      <div role="dialog" aria-modal="true" id="menuItems" class="hidden">
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
                <a href="../contactPage.php" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Contact us</a>
              </div>
              <div class="py-6">
                <a href="../php/loginPage.php" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:underline">Log in</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!---loginPage--->

    <section class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8 min-h-screen flex items-center justify-center">
      <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-b from-sky-400 to-sky-200 opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <!-- login container -->
      <div class="isolate bg-white flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
          <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-b from-sky-400 to-sky-200 opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <!-- form -->
        <div class="md:w-1/2 px-8 md:px-16">
          <h2 class="font-bold text-2xl text-[#002D74]">Login</h2>
          <p class="text-xs mt-4 text-[#002D74]">If you are already a member, easily log in</p>

          <form action="loginProcess.php" method="POST" class="flex flex-col gap-4" onsubmit="return validateLoginForm()">
            <input class="p-2 mt-8 rounded-xl border" type="text" name="username" id="username" placeholder="Username" required>
            <div class="relative">
              <input class="p-2 rounded-xl border w-full" type="password" name="password" id="passwordInput" placeholder="Password" required>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16" id="togglePasswordVisibility">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
              </svg>
            </div>
            <div id="errorContainer" class="text-red-500"></div>
            <button class="bg-[#4F46E5] rounded-xl text-white py-2 hover:scale-105 duration-300">Login</button>
          </form>

          <div class="mt-5 text-xs border-b border-[#1E739F] py-4 text-[#002D74]">
            <a href="#">Forgot your password?</a>
          </div>

          <div id="registerButton" class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
            <p>Don't have an account?</p>
            <button class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300">Register</button>
          </div>
        </div>

        <!-- image -->
        <div class="md:block hidden w-1/2">
          <img class="rounded-lg" src="../images/natali-quijano-N79MYsd2Ce4-unsplash.jpg">
        </div>
      </div>
    </section>


    <!---Footer----->

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
</body>

</html>