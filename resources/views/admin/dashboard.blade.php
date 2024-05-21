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
            <div class="grid grid-cols-3 gap-4">
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
               <!-- Card untuk pesanan terbaru -->
               <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                  <h3 class="text-lg font-semibold">Pesanan Terbaru</h3>
                  <ul>
                     <hr>
                     @foreach ($recentOrders as $order)
                        <li>Order ID: {{ $order->id }}</li>
                        <li>Total Price: Rp{{ number_format($order->total_price, 2) }}</li>
                        <li>Status: <span
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
                        </li>
                        <li>Order Items:</li>
                        <ul>
                           @foreach ($order->items as $orderItem)
                              <li>&emsp;&emsp;Product: {{ $orderItem->name }}</li>
                              <li>&emsp;&emsp;Quantity: {{ $orderItem->quantity }}</li>
                           @endforeach
                        </ul>
                        <hr>
                     @endforeach

                  </ul>
               </div>
            </div>
         </div>
      </main>

   </section>
</x-app-layout>
