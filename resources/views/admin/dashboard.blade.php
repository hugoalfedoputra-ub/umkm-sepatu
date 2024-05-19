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
                     @foreach ($recentOrders as $order)
                        <li>{{ $order->name }} - Rp{{ number_format($order->total, 2) }}</li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </main>

   </section>
</x-app-layout>
