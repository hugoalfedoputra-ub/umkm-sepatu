<x-app-layout>
   <x-slot name="title">
      Tambah Pengguna Baru
   </x-slot>

   <section class="flex">
      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Tambah Pengguna Baru</h2>

            <!-- Form untuk menambahkan pengguna baru -->
            <form action="{{ route('admin.users.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
               @csrf

               <div class="mb-4">
                  <label for="name" class="block text-sm font-medium text-gray-300">Nama</label>
                  <input type="text" name="name" id="name"
                     class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm" required>
                  @error('name')
                     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
               </div>

               <div class="mb-4">
                  <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                  <input type="email" name="email" id="email"
                     class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm" required>
                  @error('email')
                     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
               </div>

               <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                  <input type="password" name="password" id="password"
                     class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm" required>
                  @error('password')
                     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
               </div>

               <div class="mb-4">
                  <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Konfirmasi
                     Password</label>
                  <input type="password" name="password_confirmation" id="password_confirmation"
                     class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm" required>
               </div>

               <div class="mb-4">
                  <label for="role" class="block text-sm font-medium text-gray-300">Role</label>
                  <select name="role" id="role"
                     class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm" required>
                     <option value="user">User</option>
                     <option value="admin">Admin</option>
                  </select>
                  @error('role')
                     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
               </div>

               <div class="mt-6">
                  <button type="submit"
                     class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">Tambah
                     Pengguna</button>
               </div>
            </form>
         </div>
      </div>
   </section>
</x-app-layout>
