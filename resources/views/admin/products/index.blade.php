<x-app-layout>
   <x-slot name="title">
      Manage Products
   </x-slot>

   <section class="flex">
      @include('layouts.sidebar')

      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Manage Products</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add New
               Product</a>

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
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($products as $product)
                        <tr>
                           <td class="border px-4 py-2">{{ $product->name }}</td>
                           <td class="border px-4 py-2">{{ $product->description }}</td>
                           <td class="border px-4 py-2">{{ $product->price }}</td>
                           <td class="border px-4 py-2"><img src="{{ url($product->image) }}" alt="{{ $product->name }}"
                                 class="w-16 h-16 object-cover"></td>
                           <td class="border px-4 py-2">
                              <a href="{{ route('admin.products.edit', $product->id) }}"
                                 class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                              <form action="{{ route('admin.products.delete', $product->id) }}" method="POST"
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
         <div class="flex justify-center">
            {{ $products->links() }}
         </div>
      </div>
   </section>
</x-app-layout>
