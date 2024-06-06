@foreach ($users as $user)
   <div class="bg-beige text-black rounded-lg p-4 mb-4">
      <p><strong>ID:</strong> {{ $user->id }}</p>
      <p><strong>Nama:</strong> {{ $user->name }}</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
      <p><strong>Role:</strong> {{ $user->userrole }}</p>
      <div class="mt-4 lg:mt-0">
         <button class="bg-burgundy hover:bg-burgundyhv text-white font-bold py-1 px-2 rounded editUserBtn"
            data-id="{{ $user->id }}" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'user-modal')">Edit</button>
         <button class="bg-maroon hover:bg-maroonhv text-white font-bold py-1 px-2 rounded deleteUserBtn"
            data-id="{{ $user->id }}">Hapus</button>
      </div>
   </div>
@endforeach
