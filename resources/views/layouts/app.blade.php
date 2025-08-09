<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>El Moumen Academy</title>

    @vite('resources/css/app.css')
    <!-- Google Fonts: Montserrat -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet">

    @yield('styles')

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class=" bg-gray-900 text-gray-800">

    <!-- Navbar -->
   

<nav id="navbar" class="  bg-gray-900 transition-all duration-300">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ url('/') }}" class="flex pr-24 items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('images/logocam.png') }}" class="h-8" alt="Elmoumen Academye Logo" />
      
    </a>
    
    <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
      <!-- Language Selector -->
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" type="button" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900  text-white rounded-lg cursor-pointer hover:bg-gray-100  hover:bg-gray-700  hover:text-white">
        <svg class="w-5 h-5 rounded-full me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-fr" viewBox="0 0 512 512">
                    <path fill="#fff" d="M0 0h512v512H0z"/>
                    <path fill="#002654" d="M0 0h170.7v512H0z"/>
                    <path fill="#ce1126" d="M341.3 0H512v512H341.3z"/>
                  </svg>
          Français
        </button>
        <!-- Language Dropdown - shows on click -->
        <div x-show="open" @click.away="open = false" class="absolute z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm  bg-gray-700  divide-gray-600">
          <ul class="py-2 font-medium" role="none">
            <li>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  text-gray-400  hover:bg-gray-600  hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                  <svg class="w-5 h-5 rounded-full me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-fr" viewBox="0 0 512 512">
                    <path fill="#fff" d="M0 0h512v512H0z"/>
                    <path fill="#002654" d="M0 0h170.7v512H0z"/>
                    <path fill="#ce1126" d="M341.3 0H512v512H341.3z"/>
                  </svg>
                  Français
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  text-gray-400  hover:bg-gray-600  hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                  <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-us" viewBox="0 0 512 512">
                    <g fill-rule="evenodd"><g stroke-width="1pt"><path fill="#bd3d44" d="M0 0h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/><path fill="#fff" d="M0 10h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/></g><path fill="#192f5d" d="M0 0h98.8v70H0z" transform="scale(3.9385)"/><path fill="#fff" d="M8.2 3l1 2.8H12L9.7 7.5l.9 2.7-2.4-1.7L6 10.2l.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7L74 8.5l-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 7.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 24.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 21.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 38.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 35.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 52.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 49.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 66.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 63.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9z" transform="scale(3.9385)"/></g></svg>              
                  English (US)
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Mobile menu button -->
      <button data-collapse-toggle="navbar-language" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200  text-gray-400  hover:bg-gray-700  focus:ring-gray-600" aria-controls="navbar-language" aria-expanded="false">        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>
    
    <!-- Main Navigation -->
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
      <ul class="flex flex-col font-semibold p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0    bg-gray-800 md: bg-gray-900  border-gray-700 font-[Montserrat]">
        <li class="flex items-center">
          <a href="{{ url('/') }}" 
             class="block py-2 px-3 rounded-sm transition-all duration-300 relative {{ request()->is('/') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md: text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700  text-white md: hover:text-blue-500  hover:bg-gray-700  hover:text-white md: hover:bg-transparent  border-gray-700' }} {{ request()->is('/') ? 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 md:after:bg-blue-700' : 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300' }}"
             {{ request()->is('/') ? 'aria-current="page"' : '' }}>
            ACCUEIL
          </a>
        </li>
        <li class="flex items-center">
          <a href="{{ url('/about') }}" 
             class="block py-2 px-3 rounded-sm transition-all duration-300 relative {{ request()->is('about') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md: text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700  text-white md: hover:text-blue-500  hover:bg-gray-700  hover:text-white md: hover:bg-transparent  border-gray-700' }} {{ request()->is('about') ? 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 md:after:bg-blue-700' : 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300' }}"
             {{ request()->is('about') ? 'aria-current="page"' : '' }}>
            À Propos
          </a>
        </li>
        
        <!-- COURS Dropdown - shows on hover -->
        <li class="relative group flex items-center">
          <button type="button" 
                  class="flex items-center justify-between py-2 px-3 rounded-sm transition-all duration-300 relative {{ request()->is('courses*') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md: text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto  text-white md: hover:text-blue-500  focus:text-white  hover:bg-gray-700 md: hover:bg-transparent' }} {{ request()->is('courses*') ? 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 md:after:bg-blue-700' : 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300' }}">
            Cours 
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <!-- Dropdown menu -->
          <div class="absolute z-50 hidden group-hover:block font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44  bg-gray-700  divide-gray-600 top-full left-0">
            <ul class="py-2 text-sm text-gray-700  text-gray-200">
              <li>
                <a href="{{ url('/courses/primaire') }}" 
                   class="block px-4 py-2 hover:bg-gray-100  hover:bg-gray-600  hover:text-white {{ request()->is('courses/primaire*') ? 'bg-blue-50 text-blue-700  bg-blue-600  text-white' : '' }}">
                  Primaire
                </a>
              </li>
              <li>
                <a href="{{ url('/courses/college') }}" 
                   class="block px-4 py-2 hover:bg-gray-100  hover:bg-gray-600  hover:text-white {{ request()->is('courses/college*') ? 'bg-blue-50 text-blue-700  bg-blue-600  text-white' : '' }}">
                  Collège
                </a>
              </li>
              <li>
                <a href="{{ url('/courses/lycee') }}" 
                   class="block px-4 py-2 hover:bg-gray-100  hover:bg-gray-600  hover:text-white {{ request()->is('courses/lycee*') ? 'bg-blue-50 text-blue-700  bg-blue-600  text-white' : '' }}">
                  Lycée
                </a>
              </li>
              <li>
                <a href="{{ url('/courses/concours') }}" 
                   class="block px-4 py-2 hover:bg-gray-100  hover:bg-gray-600  hover:text-white {{ request()->is('courses/concours*') ? 'bg-blue-50 text-blue-700  bg-blue-600  text-white' : '' }}">
                  Concours
                </a>
              </li>
            </ul>
          </div>
        </li>
        
        
        <li class="flex items-center">
          <a href="{{ url('/contact') }}" 
             class="block py-2 px-3 rounded-sm transition-all duration-300 relative {{ request()->is('contact') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md: text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700  text-white md: hover:text-blue-500  hover:bg-gray-700  hover:text-white md: hover:bg-transparent  border-gray-700' }} {{ request()->is('contact') ? 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 md:after:bg-blue-700' : 'after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-blue-700 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300' }}"
             {{ request()->is('contact') ? 'aria-current="page"' : '' }}>
            Contact
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
   

<footer class="bg-[#001226] text-white">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div class="col-span-1 md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center mb-4 space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('images/logocam.png') }}" class="h-12" alt="Elmoumen Academy Logo" />
                </a>
                <p class="text-gray-300 mb-4">
                El Moumen Academy, votre partenaire de confiance pour la réussite scolaire et l’épanouissement éducatif à tous les niveaux.
                </p>
                <div class="flex space-x-4">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/centreelmoumen/" target="_blank" class="bg-white/10 text-white rounded-full p-2 hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://web.facebook.com/centreelmoumen" target="_blank" class="bg-white/10 text-white rounded-full p-2 hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@abdelwahedelmoumen?_t=ZS-8ygKXDqNurs&_r=1" target="_blank" class="bg-white/10 text-white rounded-full p-2 hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 2.26-3.87 3.85-6.41 4.04-2.23.16-4.48-.31-6.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                    <!-- Kwai -->
                    <a href="https://www.kwai.com/@abdelwahedelmo883" target="_blank" class="bg-white/10 text-white rounded-full p-2 hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@AbdelwahedElMoumen" target="_blank" class="bg-white/10 text-white rounded-full p-2 hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="col-span-1">
                <h3 class="text-lg font-semibold mb-4">Navigation</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/') }}" class="text-gray-300 hover:text-white transition">ACCUEIL</a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}" class="text-gray-300 hover:text-white transition">À Propos</a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}" class="text-gray-300 hover:text-white transition">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Courses Links -->
            <div class="col-span-1">
                <h3 class="text-lg font-semibold mb-4">Cours</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/courses/primaire') }}" class="text-gray-300 hover:text-white transition">Primaire</a>
                    </li>
                    <li>
                        <a href="{{ url('/courses/college') }}" class="text-gray-300 hover:text-white transition">Collège</a>
                    </li>
                    <li>
                        <a href="{{ url('/courses/lycee') }}" class="text-gray-300 hover:text-white transition">Lycée</a>
                    </li>
                    <li>
                        <a href="{{ url('/courses/concours') }}" class="text-gray-300 hover:text-white transition">Concours</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-6 border-gray-700 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-400 sm:text-center">© 2025 <a href="{{ url('/') }}" class="hover:underline">Elmoumen Academy™</a>. Tous droits réservés.</span>
    </div>
</footer>

    <!-- Fixed WhatsApp Button (Bottom Left) -->
    @php
        $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
    @endphp
    @if($whatsappNumber)
    <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite avoir plus d'informations sur vos services." 
       target="_blank"
       class="fixed bottom-6 left-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 group">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
        </svg>
        <span class="absolute left-full ml-2 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Contactez-nous sur WhatsApp
        </span>
    </a>
    @endif

    <!-- Go to Top Button (Bottom Right) -->
    <button id="goToTopBtn" 
            class="fixed bottom-6 right-6 z-50 bg-[#001226] hover:bg-[#0a1a2e] text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 opacity-0 invisible">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<script>
// Fixed Navigation Bar on Scroll
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 100) {
        navbar.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'z-40', 'shadow-lg');
        navbar.classList.add('bg-gray-900', 'backdrop-blur-sm');
        document.body.style.paddingTop = navbar.offsetHeight + 'px';
    } else {
        navbar.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'z-40', 'shadow-lg');
        navbar.classList.remove('bg-gray-900', 'backdrop-blur-sm');
        document.body.style.paddingTop = '0';
    }
});

// Go to Top Button
const goToTopBtn = document.getElementById('goToTopBtn');

window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
        goToTopBtn.classList.remove('opacity-0', 'invisible');
        goToTopBtn.classList.add('opacity-100', 'visible');
    } else {
        goToTopBtn.classList.add('opacity-0', 'invisible');
        goToTopBtn.classList.remove('opacity-100', 'visible');
    }
});

goToTopBtn.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>

</body>
</html>
