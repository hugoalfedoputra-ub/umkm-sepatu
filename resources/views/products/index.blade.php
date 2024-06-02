<x-app-layout>
   <x-slot name="title">
      Produk
   </x-slot>

   <section class="bg-whitebg products md:container md:mx-auto py-8 lg:px-16">
      <div class="container mx-auto">
         <h2 class="text-2xl text-black font-bold mb-4">Produk</h2>
         <div class="grid grid-cols-1 text-black md:grid-cols-3 gap-4">
            @foreach ($products as $product)
               <div class="bg-beige p-4 rounded-lg shadow-md m-2">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     class="w-full h-48 object-cover mb-4 rounded">
                  <h3 class="font-bold">{{ $product->name }}</h3>
                  <p class="text-green-600 font-semibold">Rp {{ number_format($product->price) }}</p>
                  <a href="/products/{{ $product->id }}"
                     class="mt-4 inline-block bg-orange text-white py-2 px-4 rounded hover:bg-orangehv">Beli
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
