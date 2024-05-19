<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
   <h2 class="text-xl font-bold mb-4">Sidebar</h2>
   <ul>
      <li>
         <x-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')">{{ __('Products') }}</x-nav-link>
      </li>
      <li>
         <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">{{ __('Users') }}</x-nav-link>
      </li>
   </ul>
</aside>
