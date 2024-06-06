<x-app-layout>
   <x-slot name="title">
      Produk - {{ $product->name }}
   </x-slot>

   <section class="bg-whitebg product-detail md:container md:mx-auto py-8 p-4 lg:px-16" data-aos="fade-in"
      data-aos-easing="linear" data-aos-duration="500" data-aos-delay="500">
      <div class="container mx-auto flex flex-col md:flex-row text-black bg-beige p-4 rounded-lg shadow-md">
         <div class="md:w-1/2">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
               class="md:w-full object-cover rounded-lg mb-4">
            <div class="flex space-x-4">
               {{-- @foreach ($product->images as $image)
                   <img src="{{ $image }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded">
                @endforeach --}}
            </div>
         </div>
         <div class="md:w-1/2 md:pl-8">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-maroon text-2xl font-semibold mb-4">Rp {{ number_format($product->price) }}</p>
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
                  class="mt-1 block w-16 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">

               <div id="stock-info" class="mt-2 text-sm"></div>

               <div>

                  @if (Auth::check() && Auth::user()->userrole === 'admin')
                     <button
                        class="mt-4 inline-block text-white py-2 px-4 rounded opacity-50 cursor-not-allowed button-disabled">Tambah
                        ke
                        Keranjang</button>
                  @else
                     <button type="submit"
                        class="mt-4 inline-block bg-orange text-white py-2 px-4 rounded hover:bg-orangehv"
                        id="add-to-cart-button">Tambah ke
                        Keranjang</button>
                  @endif
               </div>
            </form>
         </div>
      </div>

      <div class="container mx-auto mt-8 p-4 text-black">
         <div class="w-full">
            <h2 class="text-2xl text-black font-bold mb-4">Deskripsi Produk</h2>
            <div x-data="{ open: false }" class="pb-8">
               <p x-show="!open" class="mb-4">{{ Str::limit($product->description, 450, '...') }}</p>
               <p x-show="open" class="mb-4">{{ $product->description }}</p>
               <button @click="open = !open" class="text-maroon">
                  <span x-show="!open">Tampilkan lebih banyak</span>
                  <span x-show="open">Tampilkan lebih sedikit</span>
               </button>
            </div>
            <section class="reviews">
               <h2 class="text-2xl text-black font-bold mb-4">Ulasan Pelanggan</h2>
               @php
                  $averageRating = $product->reviews->avg('rating');
                  $reviewCount = $product->reviews->count();
                  $ratingsCount = [];
                  foreach (range(5, 1, -1) as $rating) {
                      $ratingsCount[$rating] = $product->reviews->where('rating', $rating)->count();
                  }
               @endphp
               <div class="flex bg-beige p-4 rounded-lg mb-4 justify-between">
                  <div class="flex flex-col justify-center mr-2 items-center" style="width: 20%;">
                     <h3 class="font-bold text-black text-2xl">{{ number_format($averageRating, 1) }} <span
                           class="text-sm text-gray-600">/ 5</span></h3>
                     <p class="text-sm text-gray-600">{{ $reviewCount }} ulasan</p>
                  </div>
                  <div class="" style="width: 100%;">
                     @foreach ($ratingsCount as $rating => $count)
                        <div class="rating-bar-container">
                           <div class="rating-label">{{ $rating }} ★:</div>
                           <progress value="{{ $count }}" max="{{ $reviewCount }}"
                              class="rating-bar"></progress>
                           <span class="rating-count">{{ $count }}</span>
                        </div>
                     @endforeach
                  </div>
               </div>
               @foreach ($reviews as $review)
                  <div class="bg-gray-100 p-4 rounded-lg mb-4">
                     <h3 class="font-bold text-black">{{ $review->customer_name }}</h3>
                     <p class="text-sm text-gray-600">{{ $review->rating }} / 5</p>
                     <p class="text-black">{{ $review->comment }}</p>
                  </div>
               @endforeach
               {{ $reviews->links() }}
            </section>

            <section class="create-review mt-4">
               <h2 class="text-2xl text-black font-bold mb-4">Tulis Ulasan</h2>
               @auth
                  <form class="text-black" action="{{ route('reviews.store') }}" method="POST">
                     @csrf
                     <label for="rating" class="block text-sm font-medium text-brown mt-4">Rating:</label>
                     <select name="rating" id="rating"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-maroon focus:ring focus:ring-maroon focus:ring-opacity-50">
                        <option value="5">5 ★</option>
                        <option value="4">4 ★</option>
                        <option value="3">3 ★</option>
                        <option value="2">2 ★</option>
                        <option value="1">1 ★</option>
                     </select>

                     <input type="hidden" name="product_id" value="{{ $product->id }}">
                     <textarea name="comment" class="mt-2 w-full rounded border-gray-300" rows="4"
                        placeholder="Masukkan ulasan Anda..."></textarea>

                     <button type="submit" class="mt-4 inline-block text-white bg-orange py-2 px-4 rounded">Submit
                        Ulasan</button>
                  </form>
               @else
                  <p>Anda harus <a href="{{ route('login') }}" class="text-blue-500">login</a> untuk menulis ulasan.</p>
               @endauth
            </section>
         </div>
      </div>
   </section>

   <script>
      window.productVariants = @json($product->variants);
   </script>

</x-app-layout>
