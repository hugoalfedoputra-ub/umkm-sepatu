<x-app-layout>
    <x-slot name="title">
        Admin Dashboard
    </x-slot>

    <section class="flex">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-4 text-white">
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">Selamat Datang di Dashboard Admin</h2>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <!-- Card untuk jumlah produk -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Jumlah Produk</h3>
                        <p class="text-2xl">{{ $productCount }}</p>
                    </div>
                    <!-- Card untuk jumlah pengguna -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Jumlah Pengguna</h3>
                        <p class="text-2xl">{{ $userCount }}</p>
                    </div>
                </div>

                <!-- Card untuk pesanan terbaru -->
                <h2 class="text-2xl font-bold mb-4">Pesanan Terbaru</h2>
                <form action="{{ route('admin.dashboard') }}" method="GET">
                    <div class="flex flex-row gap-4 flex-shrink-0 mb-4 flex-wrap items-center">
                        <div class="flex flex-col">
                            <div>
                                <input type="radio" id="waktu_order" name="sort" value="waktu_order"
                                    {{ request('sort') == 'waktu_order' ? 'checked' : '' }}>
                                <label for="waktu_order">Waktu order</label>
                            </div>
                            <div>
                                <input type="radio" id="nomor_id" name="sort" value="nomor_id"
                                    {{ request('sort') == 'nomor_id' ? 'checked' : '' }}>
                                <label for="nomor_id">Nomor ID</label>
                            </div>
                            <div>
                                <input type="radio" id="status" name="sort" value="status"
                                    {{ request('sort') == 'status' ? 'checked' : '' }}>
                                <label for="status">Status pesanan</label>
                            </div>
                            <div>
                                <input type="radio" id="kuantitas" name="sort" value="kuantitas"
                                    {{ request('sort') == 'kuantitas' ? 'checked' : '' }}>
                                <label for="kuantitas">Kuantitas pesanan</label>
                            </div>
                            <div>
                                <input type="radio" id="harga" name="sort" value="harga"
                                    {{ request('sort') == 'harga' ? 'checked' : '' }}>
                                <label for="harga">Harga total pesanan</label>
                            </div>
                            <div>
                                <input type="radio" id="nama_produk" name="sort" value="nama_produk"
                                    {{ request('sort') == 'nama_produk' ? 'checked' : '' }}>
                                <label for="nama_produk">Nama produk</label>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div>
                                <input type="radio" id="desc" name="direction" value="desc"
                                    {{ request('direction') == 'desc' ? 'checked' : '' }}>
                                <label for="desc">Terbesar hingga terkecil</label>
                            </div>
                            <div>
                                <input type="radio" id="asc" name="direction" value="asc"
                                    {{ request('direction') == 'asc' ? 'checked' : '' }}>
                                <label for="asc">Terkecil hingga terbesar</label>
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-gray-800 p-4 rounded-lg shadow-md rounded-r-md hover:bg-gray-700 transition-colors duration-300">Urutkan</button>
                    </div>
                </form>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($recentOrders as $order)
                        <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                            <p>Order ID: {{ $order->nomor_id }}</p>
                            <p>Total Price: Rp{{ number_format($order->harga, 2) }}</p>
                            <p>Status: <span
                                    style="color:
                            @switch($order->status)
                                @case('pending')
                                    yellow;
                                    @break
                                @case('diproses')
                                    orange;
                                    @break
                                @case('dalam perjalanan')
                                    blue;
                                    @break
                                @case('selesai')
                                    green;
                                    @break
                                @case('canceled')
                                    red;
                                    @break
                            @endswitch
                        ">{{ $order->status }}</span>
                            </p>
                            <p>Order Items:</p>
                            <ul>
                                <p>&emsp;&emsp;Product: {{ $order->nama_produk }}</p>
                                <p>&emsp;&emsp;Color: {{ $order->color }}</p>
                                <p>&emsp;&emsp;Quantity: {{ $order->kuantitas }}</p>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

    </section>
</x-app-layout>
