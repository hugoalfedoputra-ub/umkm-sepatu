<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <h2 class="text-xl font-bold mb-4">Sidebar</h2>
    <ul>
        <li>
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">{{ __('Overview') }}</x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')">{{ __('Products') }}</x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('admin.products.products')" :active="request()->routeIs('admin.products.products') ||
                request()->routeIs('admin.products.edit') ||
                request()->routeIs('admin.products.add') ||
                request()->routeIs('admin.products.add_stock') ||
                request()->routeIs('admin.products.delete_stock')">{{ __('Products [V2]') }}</x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">{{ __('Users') }}</x-nav-link>
        </li>
    </ul>
</aside>
