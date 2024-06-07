<x-app-layout>
   <x-slot name="title">
      Admin Dashboard
   </x-slot>

   <section class="bg-whitebg dashboard-ad md:container md:mx-auto py-8 lg:px-16" data-aos="fade-in"
      data-aos-easing="linear" data-aos-duration="600" data-aos-delay="500">

      <!-- Sidebar -->
      {{-- @include('layouts.sidebar') --}}

      <!-- Main Content -->
      <main class="flex-1 p-4 ">
         <div class="bg-whitebg container mx-auto">
            <h2 class="text-2xl text-black font-bold mb-4">Selamat Datang di Dashboard Admin</h2>
            <div class="flex flex-wrap justify-between gap-4 mb-8">
               <!-- Card untuk jumlah produk -->
               <div class="bg-beige p-4 rounded-lg shadow-md flex-1">
                  <h3 class="text-lg text-black font-semibold">Banyak Produk</h3>
                  <p class="text-2xl text-brown">{{ $productCount }}</p>
               </div>
               <!-- Card untuk jumlah pengguna -->
               <div class="bg-beige p-4 rounded-lg shadow-md flex-1">
                  <h3 class="text-lg text-black font-semibold">Banyak Pengguna</h3>
                  <p class="text-2xl text-brown">{{ $userCount }}</p>
               </div>
               <div class="bg-beige p-4 rounded-lg shadow-md flex-1">
                  <h3 class="text-lg text-black font-semibold">Net Sales</h3>
                  <p class="text-2xl text-brown">Rp. {{ number_format($netSales) }}</p>
               </div>
            </div>

            {{-- Dropdown untuk memilih data chart --}}
            <form action="{{ route('admin.dashboard') }}" method="GET">
               <div class="flex flex-row gap-4 flex-shrink-0 mb-4 flex-wrap items-center">
                  <select name="chart_type" class="bg-brown text-white p-2 rounded-lg w-44">
                     <option value="status" {{ request('chart_type') == 'status' ? 'selected' : '' }}>Status Pesanan
                     </option>
                     <option value="sales" {{ request('chart_type') == 'sales' ? 'selected' : '' }}>Produk Terjual
                     </option>
                  </select>
               </div>
            </form>

            {{-- Card untuk statistika penjualan --}}
            <div id="chart-container">
               @include('admin.partials.chart')
            </div>

            <div class="flex flex-col sm:flex-row justify-between">
               <h2 class="text-2xl text-black font-bold mb-4">Pesanan Terbaru</h2>
               <div class="flex justify-center">
                  <form id="sort-form" action="{{ route('admin.dashboard') }}" method="GET"
                     class="flex flex-col md:flex-row gap-4 flex-shrink-0 mb-4 flex-wrap items-center">

                     <input type="text" name="search" placeholder="Cari..."
                        class="w-full md:w-32 bg-beige text-brown p-2 rounded-lg md:text-sm"
                        value="{{ request('search') }}">

                     <div class="flex flex-row gap-4 flex-shrink-0 flex-wrap items-center">
                        <select name="sort" class="bg-beige text-brown p-2 rounded-lg md:text-sm">
                           <option value="waktu_order" {{ request('sort') == 'waktu_order' ? 'selected' : '' }}>Waktu
                              order
                           </option>
                           <option value="nomor_id" {{ request('sort') == 'nomor_id' ? 'selected' : '' }}>Nomor ID
                           </option>
                           <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status pesanan
                           </option>
                           <option value="kuantitas" {{ request('sort') == 'kuantitas' ? 'selected' : '' }}>Kuantitas
                              pesanan</option>
                           <option value="harga" {{ request('sort') == 'harga' ? 'selected' : '' }}>Harga total
                              pesanan
                           </option>
                           <option value="nama_produk" {{ request('sort') == 'nama_produk' ? 'selected' : '' }}>Nama
                              produk</option>
                        </select>
                        <select name="direction" class="bg-beige text-brown p-2 rounded-lg w-32">
                           <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>desc</option>
                           <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>asc</option>
                        </select>
                     </div>
                     <button type="submit"
                        class="bg-brown py-2 px-3 rounded-lg shadow-md rounded-r-md hover:bg-brownhv transition-colors duration-300">Urutkan</button>
                  </form>
               </div>
            </div>

            {{-- cards untuk recent Order --}}
            <div id="recent-orders-container" class="flex flex-wrap -mx-2">
               @include('admin.partials.order_table', compact('recentOrders'))
            </div>

         </div>
      </main>
   </section>

</x-app-layout>
