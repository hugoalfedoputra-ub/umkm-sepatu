<x-app-layout>
   <x-slot name="title">
      Edit Product
   </x-slot>

   <section class="flex">
      @include('layouts.sidebar')

      <div class="flex-1 p-4 text-white">
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
            <div class="bg-white text-black p-4 rounded-lg shadow-md">
               <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                     <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                     <input type="text" name="name" id="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $product->name }}"
                        required>
                  </div>
                  <div class="mb-4">
                     <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                     <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $product->description }}</textarea>
                  </div>
                  <div class="mb-4">
                     <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                     <input type="number" name="price" id="price"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $product->price }}"
                        required>
                  </div>
                  <div class="mb-4">
                     <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                     <input type="file" name="image" id="image"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                     <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                        class="w-16 h-16 object-cover mt-2">
                  </div>
                  <div>
                     <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Product</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</x-app-layout>
