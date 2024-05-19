<x-app-layout>
   <x-slot name="title">
      Manage Users
   </x-slot>

   <section class="flex">
      @include('layouts.sidebar')

      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Manage Users</h2>

            @if (session('success'))
               <div class="bg-green-500 text-white p-2 rounded mb-4">
                  {{ session('success') }}
               </div>
            @endif

            <div class="bg-white text-black p-4 rounded-lg shadow-md">
               <table class="table-auto w-full">
                  <thead>
                     <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($users as $user)
                        <tr>
                           <td class="border px-4 py-2">{{ $user->name }}</td>
                           <td class="border px-4 py-2">{{ $user->email }}</td>
                           <td class="border px-4 py-2">{{ $user->role }}</td>
                           <td class="border px-4 py-2">
                              <a href="{{ route('admin.users.edit', $user->id) }}"
                                 class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                              <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                 class="inline-block">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>
</x-app-layout>
