<x-app-layout>
   <x-slot name="title">
      Produk
   </x-slot>

   <section class="products md:container md:mx-auto py-8 lg:px-16">
      <div class="container mx-auto">
         <h2 class="text-2xl font-bold mb-4">Produk</h2>

         <form action="{{ route('filter') }}" method="GET" class="flex flex-col md:flex-row md:space-x-4 mb-6">
            <input type="text" name="query" placeholder="Cari produk" class="bg-gray-800 border p-2 rounded-lg mb-4 md:mb-0 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-auto placeholder-white">
            <div class="relative mb-4 md:mb-0 flex-grow">
               <select name="color" class="bg-gray-800 border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                     <option value="">Pilih Warna</option>
                     @foreach ($colors as $color)
                        <option value="{{ $color->color }}">{{ ucfirst($color->color) }}</option>
                     @endforeach
               </select>
            </div>
            <div class="relative mb-4 md:mb-0 flex-grow">
               <select name="size" class="bg-gray-800 border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                     <option value="">Pilih Ukuran</option>
                     @foreach ($sizes as $size)
                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                     @endforeach
               </select>
            </div>
            <input type="number" name="price_min" placeholder="Harga Min" class="bg-gray-800 border p-2 rounded-lg mb-4 md:mb-0 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-auto placeholder-white" step="1000" min="0">
            <input type="number" name="price_max" placeholder="Harga maks" class="bg-gray-800 border p-2 rounded-lg mb-4 md:mb-0 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-auto placeholder-white" step="1000" min="0">
            <div class="relative mb-4 md:mb-0 flex-grow">
               <select name="sort" class="bg-gray-800 border p-2 rounded-lg w-full text-white focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                     <option value="">Urutkan</option>
                     <option value="rating_desc">Rating Tertinggi</option>
                     <option value="rating_asc">Rating Terendah</option>
                     <option value="price_desc">Harga Tertinggi</option>
                     <option value="price_asc">Harga Terendah</option>
                     <option value="comments_desc">Komentar Terbanyak</option>
                     <option value="comments_asc">Komentar Paling Sedikit</option>
               </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg h-10">filter</button>
         </form>



         <div class="grid grid-cols-1 text-black md:grid-cols-3 gap-4">
            @foreach ($products as $product)
               <div class="bg-white p-4 rounded-lg shadow-md m-2">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">
                  <h3 class="font-bold">{{ $product->name }}</h3>
                  <p class="text-green-600 font-semibold">Rp {{ number_format($product->price) }}</p>
                  <a href="/products/{{ $product->id }}" class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Beli Sekarang</a>
               </div>
            @endforeach
         </div>

         <div class="grid place-items-center full-height mt-10">
            {{ $products->links() }}
         </div>
      </div>
   </section>
</x-app-layout>
