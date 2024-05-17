<x-app-layout>
   <x-slot name="title">
      Admin Dashboard
   </x-slot>

   <section class="flex">

      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>
            <p>Selamat datang, Admin!</p>
            <!-- Tambahkan konten dashboard admin di sini -->
         </div>
      </div>

   </section>
</x-app-layout>
