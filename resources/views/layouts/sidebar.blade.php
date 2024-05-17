<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
   <h2 class="text-xl font-bold mb-4">Sidebar</h2>
   <ul>
      <x-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-nav-link>
      <x-nav-link :href="route('about')" :active="request()->routeIs('about')">{{ __('About') }}</x-nav-link>
      <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">{{ __('Contact') }}</x-nav-link>
      <!-- Add more links as needed -->
   </ul>
</aside>
