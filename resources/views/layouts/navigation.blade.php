<nav x-data="{ open: false, openSearch: false }"
   class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-brown border-b border-gray-100 dark:border-gray-700">
   <!-- Primary Navigation Menu -->
   <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
         <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center" style="width: 90px;">
               <a href="{{ route('home') }}">
                  <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
               </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
               @if (Auth::check() && Auth::user()->userrole == 'admin')
                  <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs(['admin.dashboard'])">{{ __('Dashboard Admin') }}</x-nav-link>
                  <x-nav-link :href="route('admin.products.products')" :active="request()->routeIs('admin.products.*')">{{ __('Products') }}</x-nav-link>
                  <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">{{ __('Users') }}</x-nav-link>
               @else
                  <x-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-nav-link>
                  <x-nav-link :href="route('products.index')" :active="request()->routeIs(['products.index', 'products.show', 'search', 'filter'])">{{ __('Product') }}</x-nav-link>
                  <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">{{ __('Tentang Kami') }}</x-nav-link>
                  <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">{{ __('Kontak') }}</x-nav-link>
                  @auth
                     <x-nav-link :href="route('cart.index')" :active="request()->routeIs(['cart.index', 'checkout.index'])">{{ __('Keranjang') }}</x-nav-link>
                     <x-nav-link :href="url('history/' . \Auth::id())" :active="request()->routeIs(['history.index'])">{{ __('Pemesanan') }}</x-nav-link>
                  @endauth
               @endif
            </div>
         </div>


         <!-- Settings Dropdown -->
         <div class="hidden sm:flex sm:items-center sm:ms-6">

            <!-- Search Button -->
            <div class="mr-3 relative">
               <button id="searchButton" @click="openSearch = !openSearch"
                  class="inline-flex items-center justify-center p-1 rounded-md text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-200 dark:focus:bg-gray-800 focus:text-gray-600 dark:focus:text-gray-300 transition duration-150 ease-in-out">
                  <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
               </button>

               <!-- Search Input Field -->
               <div x-show="openSearch" @click.away="openSearch = false"
                  x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                  x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                  x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                  class="absolute right-0 mt-4 w-full sm:w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                  <form action="{{ route('filter') }}" method="GET" class="relative">
                     <div class="relative">
                        <input type="text" name="query" id="search"
                           class="w-full border-0 rounded bg-gray-50 pl-4 pr-10 py-3 text-sm leading-5 text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-gray-500"
                           placeholder="Search..." oninput="this.form.sub.disabled = !this.value.trim();">
                        <!-- Arrow Button -->
                        <button type="submit" name="sub"
                           class="absolute inset-y-0 right-0 flex items-center rounded-r-md bg-gray-200 hover:bg-gray-300 transition-colors duration-300"
                           disabled>
                           <span class="px-2 text-gray-700">→</span>
                        </button>
                     </div>
                  </form>
                  <!-- Search Results Container -->
                  <div id="search-results"
                     class="absolute w-full bg-white border border-gray-300 mt-1 rounded-md shadow-lg z-50 hidden text-black max-h-72 overflow-y-auto">
                  </div>
               </div>
            </div>

            @auth
               <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                     <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                           <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                 d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                 clip-rule="evenodd" />
                           </svg>
                        </div>
                     </button>
                  </x-slot>

                  <x-slot name="content">
                     <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                     </x-dropdown-link>

                     <!-- Authentication -->
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                           onclick="event.preventDefault();
                                                   this.closest('form').submit();">
                           {{ __('Log Out') }}
                        </x-dropdown-link>
                     </form>
                  </x-slot>
               </x-dropdown>
            @else
               <div class="mx-3">
                  <x-nav-link :href="route('login')" :active="request()->routeIs('login')">{{ __('Login') }}</x-nav-link>
               </div>
               <div class="mx-3">
                  <x-nav-link :href="route('register')" :active="request()->routeIs('register')">{{ __('Register') }}</x-nav-link>
               </div>
            @endauth
         </div>


         <!-- Mobile Search Field -->
         <div class="-me-2 flex items-center sm:hidden">
            @if (Auth::check() && Auth::user()->userrole != 'admin')
               <button @click="openSearch = !openSearch"
                  class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                  <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
               </button>
            @endif
            <!-- Mobile Search Input Field -->
            <div x-show="openSearch" @click.away="openSearch = false"
               x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-4 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 mr-10"
               style="margin-top: 120px;">
               <form action="{{ route('filter') }}" method="GET" class="relative">
                  <div class="relative">
                     <input type="text" name="query" id="search"
                        class="w-full border-0 rounded bg-gray-50 pl-4 pr-10 py-3 text-sm leading-5 text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-gray-500"
                        placeholder="Search..." oninput="this.form.sub.disabled = !this.value.trim();">
                     <!-- Arrow Button -->
                     <button type="submit" name="sub"
                        class="absolute inset-y-0 right-0 flex items-center rounded-r-md bg-gray-200 hover:bg-gray-300 transition-colors duration-300"
                        disabled>
                        <span class="px-2 text-gray-700">→</span>
                     </button>
                  </div>
               </form>
               <!-- Search Results Container -->
               <div id="search-results"
                  class="absolute w-full bg-white border border-gray-300 mt-1 rounded-md shadow-lg z-50 hidden text-black max-h-72 overflow-y-auto">
               </div>
            </div>

            <!-- Hamburger -->
            <button @click="open = ! open"
               class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
               <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                     stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                     stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
               </svg>
            </button>
         </div>
      </div>
   </div>

   <!-- Responsive Navigation Menu -->
   <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

      @if (Auth::check() && Auth::user()->userrole == 'admin')
         <x-responsive-nav-link :href="route('admin.dashboard')"
            :active="request()->routeIs(['admin.dashboard'])">{{ __('Dashboard Admin') }}</x-responsive-nav-link>
         <x-responsive-nav-link :href="route('admin.products.products')" :active="request()->routeIs('admin.products.*')">{{ __('Products') }}</x-responsive-nav-link>
         <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">{{ __('Users') }}</x-responsive-nav-link>
      @else
         <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-responsive-nav-link>
         <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs(['products.index', 'products.show'])">Produk</x-responsive-nav-link>
         <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">Tentang Kami</x-responsive-nav-link>
         <x-responsive-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">Kontak</x-responsive-nav-link>
         @auth
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">Keranjang</x-responsive-nav-link>
         @endauth
      @endif


      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600" x-transition>

         @auth
            <div class="px-4">
               <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
               <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
               <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                  {{ __('Profile') }}
               </x-responsive-nav-link>

               <!-- Authentication -->
               <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-responsive-nav-link :href="route('logout')"
                     onclick="event.preventDefault();
                                           this.closest('form').submit();">
                     {{ __('Log Out') }}
                  </x-responsive-nav-link>
               </form>
            </div>
         @else
            <div>
               <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">{{ __('Login') }}</x-nav-link>
            </div>
            <div>
               <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">{{ __('Register') }}</x-nav-link>
            </div>
         @endauth

      </div>
   </div>
</nav>
