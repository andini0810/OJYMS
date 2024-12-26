<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
      body, main, .navbar {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
  </style>
    
</head>
<body>
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
  <x-navbar></x-navbar>
  <div class="pt-16">
    <x-header  >One Journey Many Success</x-header>
  </div>

  
  <main>
    <div >
      {{ $slot }}
    </div>
    <x-footer>{{ $slot }}</x-footer>
  </main>
</div>

    
</body>
</html>