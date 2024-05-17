<x-app-layout>
   <x-slot name="title">
      Produk
   </x-slot>

   <section class="products py-8">
      <div class="container mx-auto px-4 md:px-8 lg:px-16 py-8">
         <h2 class="text-2xl font-bold mb-4">Produk</h2>
         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($products as $product)
               <div class="bg-white p-4 rounded-lg shadow-md">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     class="w-full h-48 object-cover mb-4 rounded">
                  <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                  <p class="text-green-600 text-lg font-semibold">{{ $product->price }}</p>
                  <a href="/products/{{ $product->id }}"
                     class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Beli
                     Sekarang</a>
               </div>
            @endforeach
         </div>

         <div class="grid place-items-center full-height mt-10">
            {{ $products->links() }}
         </div>
      </div>
   </section>
</x-app-layout>
