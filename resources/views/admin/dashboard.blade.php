<x-app-layout>
   <x-slot name="title">
      Admin Dashboard
   </x-slot>

   <section class="flex">

      <!-- Sidebar -->
      {{-- @include('layouts.sidebar') --}}

      <!-- Main Content -->
      <main class="flex-1 p-4 ">
         <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Selamat Datang di Dashboard Admin</h2>
            <div class="flex flex-wrap justify-between gap-4 mb-8">
               <!-- Card untuk jumlah produk -->
               <div class="bg-gray-800 p-4 rounded-lg shadow-md flex-1">
                  <h3 class="text-lg font-semibold">Banyak Produk</h3>
                  <p class="text-2xl">{{ $productCount }}</p>
               </div>
               <!-- Card untuk jumlah pengguna -->
               <div class="bg-gray-800 p-4 rounded-lg shadow-md flex-1">
                  <h3 class="text-lg font-semibold">Banyak Pengguna</h3>
                  <p class="text-2xl">{{ $userCount }}</p>
               </div>
               <!-- Card untuk Net Sales -->
               <div class="bg-gray-800 p-4 rounded-lg shadow-md flex-1">
                  <h3 class="text-lg font-semibold">Net Sales</h3>
                  <p class="text-2xl">Rp. {{ number_format($netSales) }}</p>
               </div>
            </div>

            {{-- Dropdown untuk memilih data chart --}}
            <form action="{{ route('admin.dashboard') }}" method="GET">
               <div class="flex flex-row gap-4 flex-shrink-0 mb-4 flex-wrap items-center">
                  <select name="chart_type" class="bg-gray-800 text-white p-2 rounded-lg w-44">
                     <option value="status" {{ request('chart_type') == 'status' ? 'selected' : '' }}>Status Pesanan
                     </option>
                     <option value="sales" {{ request('chart_type') == 'sales' ? 'selected' : '' }}>Produk Terjual
                     </option>
                  </select>
                  <button type="submit"
                     class="bg-gray-800 py-2 px-3 rounded-lg shadow-md hover:bg-gray-700 transition-colors duration-300">Tampilkan</button>
               </div>
            </form>

            {{-- Card untuk statistika penjualan --}}
            <div id="sales_chart" class="container mb-8 text-black">
               <div class="p-4 bg-gray-100 rounded-lg">
                  {!! $chart->container() !!}
               </div>
            </div>

            <script src="{{ $chart->cdn() }}"></script>
            {{ $chart->script() }}

            <div class="flex flex-row justify-between">
               <h2 class="text-2xl font-bold mb-4">Pesanan Terbaru</h2>
               <div class="flex justify-center">
                  {{ $recentOrders->links() }}
               </div>
            </div>

            <!-- option untuk recent order -->
            <form action="{{ route('admin.dashboard') }}" method="GET">
               <div class="flex flex-row gap-4 flex-shrink-0 mb-4 flex-wrap items-center">
                  <select name="sort" class="bg-gray-800 text-white p-2 rounded-lg">
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
                  </select>

                  <select name="direction" class="bg-gray-800 text-white p-2 rounded-lg w-56">
                     <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Terbesar
                        hingga
                        terkecil</option>
                     <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Terkecil
                        hingga
                        terbesar</option>
                  </select>

                  <button type="submit"
                     class="bg-gray-800 py-2 px-3 rounded-lg shadow-md rounded-r-md hover:bg-gray-700 transition-colors duration-300">Urutkan</button>
               </div>
            </form>

            {{-- cards untuk recent Order --}}
            <div class="flex flex-wrap -mx-2">
               @foreach ($recentOrders as $order)
                  <div class="w-full md:w-1/2 px-2 mb-4">
                     <div class="bg-gray-800 p-4 rounded-lg shadow-md relative">
                        <table class="w-full text-white"
                           style="border-collapse: collapse; border: none; font-size: 0.9rem;">
                           <tr class="mb-2">
                              <td class="font-bold">Order ID</td>
                              <td>: {{ $order->id }}</td>
                           </tr>
                           <tr class="mb-2">
                              <td class="font-bold">Total Price</td>
                              <td>: Rp{{ number_format($order->total_price, 2) }}</td>
                           </tr>
                           <tr class="mb-2">
                              <td class="font-bold">Status</td>
                              <td>:
                                 <span
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
                              </td>
                           </tr>
                           <tr class="mb-2">
                              <td class="font-bold">Jumlah Produk Dibeli</td>
                              <td>: {{ $order->items->sum('quantity') }}</td>
                           </tr>
                           <tr>
                              <td class="font-bold">Waktu Order</td>
                              <td>: {{ $order->created_at->format('d M Y H:i') }}</td>
                           </tr>
                           <tr>
                              <td></td>
                              <td class="flex justify-end mt-2">
                                 <button onclick="window.location='{{ url('admin/orders/update/' . $order->id) }}'"
                                    class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-1 px-2 rounded">Detail
                                    pesanan</button>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
      </main>
   </section>
</x-app-layout>
