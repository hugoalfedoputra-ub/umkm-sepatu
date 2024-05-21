<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>
         @isset($title)
            {{ $title }}
         @else
            Default Title
         @endisset
      </title>

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

      {{-- Style --}}
      <link href="{{ 'css/app.css' }}" rel="stylesheet">

      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>

   <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 flex flex-col min-h-screen">
      @include('layouts.navigation')

      <!-- Page Heading -->
      @if (isset($header))
         <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
               {{ $header }}
            </div>
         </header>
      @endif

      <!-- Page Content -->
      <main class="flex-grow">
         <!-- Main Content -->

         @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
               {{ session('error') }}
            </div>
         @endif

         @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
               {{ session('success') }}
            </div>
         @endif

         {{ $slot }}
      </main>

      @include('layouts.footer')
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="{{ mix('js/app.js') }}"></script>
   </body>

</html>
