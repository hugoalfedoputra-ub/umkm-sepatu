   <x-app-layout>
      <x-slot name="title">
         Kelola Pengguna
      </x-slot>

      <section class="flex flex-col md:flex-row md:container md:mx-auto py-8 lg:px-16" data-aos="fade-in"
         data-aos-easing="linear" data-aos-duration="500" data-aos-delay="300">

         <div class="flex-1 p-4 text-white">
            <div class="container mx-auto py-8">
               <h2 class="text-xl md:text-2xl text-black font-bold mb-4">Kelola Pengguna</h2>

               <div class="flex flex-col sm:flex-row justify-between mb-4">
                  <button class="bg-orange hover:bg-orangehv text-white font-bold py-2 px-4 rounded mb-2 lg:mb-0"
                     id="addUserBtn" x-data=""
                     x-on:click.prevent="$dispatch('open-modal', 'user-modal')">Tambah
                     Pengguna</button>

                  <div class="flex flex-col justify-between md:flex-row text-black">
                     <input type="text" id="userSearchInput" class="border rounded p-2 mr-2 mb-2 md:mb-0"
                        placeholder="Cari pengguna...">
                     <div class="flex flex-row justify-between mb-2 md:mb-0">
                        <select id="userSortBy" class="border rounded w-full mr-2 sm:mb-0">
                           <option value="id">Id</option>
                           <option value="name">Nama</option>
                           <option value="email">Email</option>
                           <option value="userrole">Role</option>
                        </select>
                        <select id="userSortOrder" class="border rounded w-full mr-2 sm:mb-0">
                           <option value="asc">Asc</option>
                           <option value="desc">Desc</option>
                        </select>
                     </div>
                     <button id="userSearchBtn"
                        class="bg-orange hover:bg-orangehv text-white font-bold py-2 px-4 rounded">Cari</button>
                  </div>
               </div>


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
                        @include('admin.users.partials.user_table', compact('users'))
                     </tbody>
                  </table>
               </div>

               <!-- Mobile View -->
               <div class="md:hidden" id="mobileUserTable">
                  @include('admin.users.partials.mobile_user_table', compact('users'))
               </div>
            </div>
            @include('admin.users.partials.pagination', compact('users'))
         </div>
      </section>
      @include('admin.users.create')
   </x-app-layout>
