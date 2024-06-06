<x-app-layout>
   <x-slot name="title">
      Kelola Pengguna
   </x-slot>

   <section class="flex flex-col md:flex-row" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000"
      data-aos-delay="500">

      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-xl md:text-2xl text-black font-bold mb-4">Kelola Pengguna</h2>

            <button class="bg-orange hover:bg-orangehv text-white font-bold py-2 px-4 rounded mb-4" id="addUserBtn"
               x-data="" x-on:click.prevent="$dispatch('open-modal', 'user-modal')">Tambah
               Pengguna</button>

            <!-- Responsive Table -->
            <div class="hidden md:block">
               <table class="min-w-full bg-beige text-black rounded-lg" id="userTable">
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
                                 class="bg-burgundy hover:bg-burgundyhv text-white font-bold py-1 px-2 rounded editUserBtn"
                                 data-id="{{ $user->id }}" x-data=""
                                 x-on:click.prevent="$dispatch('open-modal', 'user-modal')">Edit</button>
                              <button
                                 class="bg-maroon hover:bg-maroonhv text-white font-bold py-1 px-2 rounded deleteUserBtn"
                                 data-id="{{ $user->id }}">Hapus</button>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden">
               @foreach ($users as $user)
                  <div class="bg-beige text-black rounded-lg p-4 mb-4">
                     <p><strong>ID:</strong> {{ $user->id }}</p>
                     <p><strong>Nama:</strong> {{ $user->name }}</p>
                     <p><strong>Email:</strong> {{ $user->email }}</p>
                     <p><strong>Role:</strong> {{ $user->userrole }}</p>
                     <div>
                        <button
                           class="bg-burgundy hover:bg-burgundyhv text-white font-bold py-1 px-2 rounded editUserBtn"
                           data-id="{{ $user->id }}" x-data=""
                           x-on:click.prevent="$dispatch('open-modal', 'user-modal')">Edit</button>
                        <button class="bg-maroon hover:bg-maroonhv text-white font-bold py-1 px-2 rounded deleteUserBtn"
                           data-id="{{ $user->id }}">Hapus</button>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="flex justify-center">
            {{ $users->links() }}
         </div>
      </div>

      @include('admin.users.create')
   </section>

</x-app-layout>
