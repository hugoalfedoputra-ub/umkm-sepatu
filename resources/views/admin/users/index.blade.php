<x-app-layout>
   <x-slot name="title">
      Kelola Pengguna
   </x-slot>

   <section class="flex">
      @include('layouts.sidebar')

      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Kelola Pengguna</h2>

            <button class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded mb-4"
               id="addUserBtn">Tambah Pengguna</button>

            <!-- User Table -->
            <table class="min-w-full bg-gray-800 rounded-lg" id="userTable">
               <thead>
                  <tr>
                     <th class="py-2 px-4">ID</th>
                     <th class="py-2 px-4">Nama</th>
                     <th class="py-2 px-4">Email</th>
                     <th class="py-2 px-4">Role</th>
                     <th class="py-2 px-4">Aksi</th>
                  </tr>
               </thead>
               <tbody id="userTableBody">
                  @foreach ($users as $user)
                     <tr>
                        <td class="py-2 px-4">{{ $user->id }}</td>
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">{{ $user->userrole }}</td>
                        <td class="py-2 px-4">
                           <button
                              class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-1 px-2 rounded editUserBtn"
                              data-id="{{ $user->id }}">Edit</button>
                           <button
                              class="bg-red-500 hover:bg-red-400 text-white font-bold py-1 px-2 rounded deleteUserBtn"
                              data-id="{{ $user->id }}">Hapus</button>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>

      @include('admin.users.create')
      {{-- @include('admin.users.edit') --}}
   </section>

</x-app-layout>
