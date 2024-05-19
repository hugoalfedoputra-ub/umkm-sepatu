<x-app-layout>
   <x-slot name="title">
      Edit User
   </x-slot>

   <section class="flex">
      @include('layouts.sidebar')

      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Edit User</h2>
            <div class="bg-white text-black p-4 rounded-lg shadow-md">
               <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                     <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                     <input type="text" name="name" id="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $user->name }}"
                        required>
                  </div>
                  <div class="mb-4">
                     <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                     <input type="email" name="email" id="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $user->email }}"
                        required>
                  </div>
                  <div class="mb-4">
                     <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                     <select name="role" id="role"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                     </select>
                  </div>
                  <div>
                     <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</x-app-layout>
