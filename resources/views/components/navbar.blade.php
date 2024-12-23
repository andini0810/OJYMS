<nav class="fixed top-0 left-0 w-full bg-gray-800 z-50" x-data="{ isOpen: false }">
  <style>
    body, main, nav {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="shrink-0">
          <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi">
        </div>
        <div class="hidden md:block">
          @auth
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/home" 
              class="{{ request()->is('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">Home</a>
            <a href="/findjobs" 
              class="{{ request()->is('findjobs') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">Find Jobs</a>
            <a href="/events" 
              class="{{ request()->is('events') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">Events</a>
            <a href="/alumni/applications" 
              class="{{ request()->is('dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">Dashboard</a>
          </div>
          @else
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/" 
              class="{{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">Overview</a>
            <a href="/jobs" 
              class="{{ request()->is('jobs') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">Jobs</a>
            <a href="/about" 
              class="{{ request()->is('about') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium " aria-current="page">About</a>
          </div>
          @endauth
        </div>
      </div>

      <div class="hidden md:block">
        @auth
        <div class="ml-4 flex items-center md:ml-6">

          <div class="relative ml-3">
            <div>
              <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm text-white font-medium focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                {{ auth()->user()->name ?? 'Guest' }}
              </button>
            </div>

            <div x-show="isOpen" x-transition class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
              <a href="/userprofile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">Your Profile</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">Settings</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        </div>
        @else
        <div class="ml-4 flex items-center md:ml-6">
          <a href="/login" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Login</a>
          <a href="/register" class="ml-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Register</a>
        </div>
        @endauth
      </div>

      <div class="-mr-2 flex md:hidden">
        <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div x-show="isOpen" class="md:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
      @auth
      <a href="/home" class="block rounded-md px-3 py-2 text-base font-medium text-white bg-gray-900">Home</a>
      <a href="/findjobs" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Find Jobs</a>
      <a href="/events" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Events</a>
      <a href="/alumni/applications" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
      @else
      <a href="/" class="block rounded-md px-3 py-2 text-base font-medium text-white bg-gray-900">Overview</a>
      <a href="/jobs" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Jobs</a>
      <a href="/about" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">About</a>
      @endauth
    </div>
    <div class="border-t border-gray-700 pb-3 pt-4">
      @auth
      <div class="px-2 space-y-1">
        <a href="/userprofile" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Your Profile</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Settings</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
      </div>
      @else
      <div class="px-2 space-y-1">
        <a href="/login" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Login</a>
        <a href="/register" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Register</a>
      </div>
      @endauth
    </div>
  </div>
</nav>
