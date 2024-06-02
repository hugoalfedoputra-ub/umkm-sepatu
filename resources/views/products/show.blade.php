<x-app-layout>
   <x-slot name="title">
      Produk - {{ $product->name }}
   </x-slot>

   <section class="bg-whitebg product-detail py-8">
      <div class="container mx-auto flex text-black bg-beige p-4 rounded-lg shadow-md">
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
            <p class="text-green-600 text-2xl font-semibold mb-4">Rp {{ number_format($product->price) }}</p>
            <p class="mb-4">{{ $product->description }}</p>
            <form action="{{ route('cart.store') }}" method="POST" class="mt-4" id="addToCartForm">

               @csrf
               <input type="hidden" name="product_id" value="{{ $product->id }}">

               <label for="color" class="block text-sm font-medium text-gray-700">Warna</label>
               <select name="color" id="color"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                  @foreach ($product->variants->unique('color') as $variant)
                     <option value="{{ $variant->color }}">{{ ucfirst($variant->color) }}</option>
                  @endforeach
               </select>

               <label for="size" class="block text-sm font-medium text-gray-700 mt-4">Ukuran</label>
               <select name="size" id="size"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                  @foreach ($product->variants->unique('size') as $variant)
                     <option value="{{ $variant->size }}">{{ $variant->size }}</option>
                  @endforeach
               </select>

               <label for="quantity"
                  class="quantity-label block text-sm font-medium text-gray-700 mt-4">Quantity</label>
               <input type="number" name="quantity" id="quantity" value="1" min="1"
                  class="mt-1 block w-16 rounded-md border-gray-300 shado w-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">

               <div id="stock-info" class="mt-2 text-sm"></div>

               <button type="submit" class="bg-orange hover:bg-orangehv mt-4 inline-block text-white py-2 px-4 rounded"
                  id="add-to-cart-button">Tambah ke
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

   <script>
      window.productVariants = @json($product->variants);
   </script>

</x-app-layout>
