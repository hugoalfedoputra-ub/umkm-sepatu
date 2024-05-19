<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
   <h2 class="text-xl font-bold mb-4">Sidebar</h2>
   <ul>
      <x-nav-link :href="route('home')" :active="request()->routeIs('home')">{{ __('Home') }}</x-nav-link>
      <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">{{ __('About') }}</x-nav-link>
      <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">{{ __('Contact') }}</x-nav-link>
      {{-- <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">{{ __('Manage Products') }}</x-nav-link>
      <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">{{ __('Manage Users') }}</x-nav-link> --}}
   </ul>
</aside>
