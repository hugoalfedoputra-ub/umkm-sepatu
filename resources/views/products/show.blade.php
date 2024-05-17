<x-app-layout>
   <x-slot name="title">
      {{ $product->name }}
   </x-slot>

   <section class="product-detail py-8">
      <div class="container mx-auto flex text-black bg-white p-4 rounded-lg shadow-md">
         <div class="w-1/2">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
               class="w-full h-96 object-cover rounded-lg mb-4">
            <div class="flex space-x-4">
               {{-- @foreach ($product->images as $image)
                   <img src="{{ $image }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded">
                @endforeach --}}
            </div>
         </div>
         <div class="w-1/2 pl-8">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-green-600 text-2xl font-semibold mb-4">{{ $product->price }}</p>
            <p class="mb-4">{{ $product->description }}</p>
            <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
               @csrf
               <input type="hidden" name="product_id" value="{{ $product->id }}">
               <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
               <input type="number" name="quantity" id="quantity" value="1" min="1"
                  class="mt-1 block w-16 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
               <button type="submit"
                  class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Tambah ke
                  Keranjang</button>
            </form>
            <section class="reviews mt-8">
               <h2 class="text-2xl font-bold mb-4">Ulasan Pelanggan</h2>
               @foreach ($product->reviews as $review)
                  <div class="bg-gray-100 p-4 rounded-lg mb-4">
                     <h3 class="font-bold">{{ $review->customer_name }}</h3>
                     <p class="text-sm text-gray-600">{{ $review->rating }} / 5</p>
                     <p>{{ $review->comment }}</p>
                  </div>
               @endforeach
            </section>
         </div>
      </div>
   </section>
</x-app-layout>
