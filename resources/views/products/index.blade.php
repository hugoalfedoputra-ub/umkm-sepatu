<x-app-layout>
   <x-slot name="title">
      Produk
   </x-slot>

   <section class="bg-whitebg products md:container md:mx-auto py-8 lg:px-16">
      <div class="container mx-auto">
         <h2 class="text-2xl text-black font-bold mb-4">Produk</h2>

         <!-- Search Input -->
         <form action="{{ route('filter') }}" method="GET" class="mb-6">
            <input type="text" name="query" placeholder="Cari produk" class="bg-brown border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-white h-10 mb-4">
         
            <!-- Filters -->
            <div class="flex flex-wrap md:flex-nowrap md:space-x-4">
               <div class="flex-grow mb-4 md:mb-0">
                  <select name="color" class="bg-brown border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                     <option value="">Pilih Warna</option>
                     @foreach ($colors as $color)
                        <option value="{{ $color->color }}">{{ ucfirst($color->color) }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="flex-grow mb-4 md:mb-0">
                  <select name="size" class="bg-brown border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                     <option value="">Pilih Ukuran</option>
                     @foreach ($sizes as $size)
                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="flex-grow mb-4 md:mb-0">
                  <input type="number" name="price_min" placeholder="Harga Min" class="bg-brown border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-white h-10" step="1000" min="0">
               </div>
               <div class="flex-grow mb-4 md:mb-0">
                  <input type="number" name="price_max" placeholder="Harga Maks" class="bg-brown border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-white h-10" step="1000" min="0">
               </div>
               <div class="flex-grow mb-4 md:mb-0">
                  <select name="sort" class="bg-brown border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                     <option value="">Urutkan</option>
                     <option value="rating_desc">Rating Tertinggi</option>
                     <option value="rating_asc">Rating Terendah</option>
                     <option value="price_desc">Harga Tertinggi</option>
                     <option value="price_asc">Harga Terendah</option>
                     <option value="comments_desc">Komentar Terbanyak</option>
                     <option value="comments_asc">Komentar Paling Sedikit</option>
                  </select>
               </div>
               <div class="flex-grow mb-4 md:mb-0">
                  <button type="submit" class="bg-orange text-white py-2 px-4 rounded-lg w-full h-10">Filter</button>
               </div>
            </div>
         </form>

         <div class="grid grid-cols-1 text-black md:grid-cols-3 gap-4">
            @foreach ($products as $product)
               <div class="bg-beige p-4 rounded-lg shadow-md m-2">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">
                  <h3 class="font-bold">{{ $product->name }}</h3>
                  <p class="text-brown font-semibold">Rp {{ number_format($product->price) }}</p>
                  <a href="/products/{{ $product->id }}" class="mt-4 inline-block bg-orange text-white py-2 px-4 rounded hover:bg-orangehv">Beli Sekarang</a>
               </div>
            @endforeach
         </div>

         <div class="grid place-items-center full-height mt-10">
            {{ $products->links() }}
         </div>
      </div>
   </section>
</x-app-layout>
