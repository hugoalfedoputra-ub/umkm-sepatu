@foreach ($users as $user)
   <tr>
      <td class="py-2 px-4">{{ $user->id }}</td>
      <td class="py-2 px-4">{{ $user->name }}</td>
      <td class="py-2 px-4">{{ $user->email }}</td>
      <td class="py-2 px-4 ">{{ $user->userrole }}</td>
      <td class="py-2 px-4 flex justify-center gap-x-2">
         <button class="bg-burgundy hover:bg-burgundyhv text-white font-bold py-1 px-2 rounded editUserBtn"
            data-id="{{ $user->id }}" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'user-modal')">Edit</button>
         <button class="bg-maroon hover:bg-maroonhv text-white font-bold py-1 px-2 rounded deleteUserBtn"
            data-id="{{ $user->id }}">Hapus</button>
      </td>
   </tr>
@endforeach
