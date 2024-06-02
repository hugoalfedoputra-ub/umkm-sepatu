<aside class="w-64 bg-beige text-orange min-h-screen p-4">
    <h2 class="text-3xl font-sans mb-4">SIDEBAR</h2>
    <ul>
        <li>
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard', 'admin.orders.update')">{{ __('Overview') }}</x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')">{{ __('Products') }}</x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('admin.products.products')" :active="request()->routeIs(
                'admin.products.products',
                'admin.products.edit',
                'admin.products.add_stock',
                'admin.products.delete_stock',
            )">{{ __('Products [V2]') }}</x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">{{ __('Users') }}</x-nav-link>
        </li>
    </ul>
</aside>
