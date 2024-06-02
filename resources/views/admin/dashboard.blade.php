<x-app-layout>
   <x-slot name="title">
      Admin Dashboard
   </x-slot>

   <section class="flex">

      <!-- Sidebar -->
      {{-- @include('layouts.sidebar') --}}

        <!-- Main Content -->
        <main class="flex-1 p-4 ">
            <div class="bg-whitebg container mx-auto">
                <h2 class="text-2xl text-black font-bold mb-4">Selamat Datang di Dashboard Admin</h2>
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <!-- Card untuk jumlah produk -->
                    <div class="bg-beige p-4 rounded-lg shadow-md">
                        <h3 class="text-lg text-black font-semibold">Banyak Produk</h3>
                        <p class="text-2xl text-brown">{{ $productCount }}</p>
                    </div>
                    <!-- Card untuk jumlah pengguna -->
                    <div class="bg-beige p-4 rounded-lg shadow-md">
                        <h3 class="text-lg text-black font-semibold">Banyak Pengguna</h3>
                        <p class="text-2xl text-brown">{{ $userCount }}</p>
                    </div>
                    <div class="bg-beige p-4 rounded-lg shadow-md">
                        <h3 class="text-lg text-black font-semibold">Net Sales</h3>
                        <p class="text-2xl text-brown">Rp. {{ number_format($netSales) }}</p>
                    </div>
                </div>

                {{-- Card untuk statistika penjualan --}}

                <div id="sales_chart" class="container mb-8 text-black">
                    <div class="p-4 bg-beige rounded-lg">
                        {!! $chart->container() !!}
                    </div>
                </div>

                <script src="{{ $chart->cdn() }}"></script>

                {{ $chart->script() }}

                <div class="flex flex-row justify-between">
                    <h2 class="text-2xl text-black font-bold mb-4">Pesanan Terbaru</h2>
                    <div class="flex justify-center">

                        {{ $recentOrders->links() }}
                    </div>
                </div>

                <!-- Card untuk pesanan terbaru -->
                <form action="{{ route('admin.dashboard') }}" method="GET">
                    <div class="flex flex-row gap-4 flex-shrink-0 mb-4 flex-wrap items-center">
                        <select name="sort" class="bg-beige text-brown p-2 rounded-lg">
                            <option value="waktu_order" {{ request('sort') == 'waktu_order' ? 'selected' : '' }}>Waktu
                                order
                            </option>
                            <option value="nomor_id" {{ request('sort') == 'nomor_id' ? 'selected' : '' }}>Nomor ID
                            </option>
                            <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status pesanan
                            </option>
                            <option value="kuantitas" {{ request('sort') == 'kuantitas' ? 'selected' : '' }}>Kuantitas
                                pesanan
                            </option>
                            <option value="harga" {{ request('sort') == 'harga' ? 'selected' : '' }}>Harga total
                                pesanan
                            </option>
                            <option value="nama_produk" {{ request('sort') == 'nama_produk' ? 'selected' : '' }}>Nama
                                produk
                            </option>
                        </select>

                        <select name="direction" class="bg-beige text-brown p-2 rounded-lg w-56">
                            <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Terbesar
                                hingga
                                terkecil</option>
                            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Terkecil
                                hingga
                                terbesar</option>
                        </select>

                        <button type="submit"
                            class="bg-orange py-2 px-3 rounded-lg shadow-md rounded-r-md hover:orangehv transition-colors duration-300">Urutkan</button>
                    </div>
                </form>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($recentOrders as $order)
                        <div class="flex flex-row justify-between bg-beige p-4 rounded-lg shadow-md relative">
                            <div class="text-brown">
                                <p>Order ID: {{ $order->nomor_id }}</p>
                                <p>Total Price: Rp{{ number_format($order->harga, 2) }}</p>
                                <p>Status: <span
                                        style="color:
                                        @switch($order->status)
                                            @case('pending')
                                                maroon;
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
                            <button onclick="window.location='{{ url('admin/orders/update/' . $order->nomor_id) }}'"
                                class="bg-orange hover:bg-orangehv text-white font-bold py-1 px-2 rounded absolute bottom-4 right-4">Edit
                                pesanan</button>
                        </div>
                    @endforeach
                </div>
            </div>
      </main>
   </section>
</x-app-layout>
