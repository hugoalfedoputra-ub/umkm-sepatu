<x-app-layout>
   <x-slot name="title">Keranjang Belanja</x-slot>

   <meta name="csrf-token" content="{{ csrf_token() }}">

   <section class="bg-whitebg cart md:container md:mx-auto py-8 p-4 lg:px-16" data-aos="fade-in" data-aos-easing="linear"
      data-aos-duration="300" data-aos-delay="300">
      <div class="md:container md:mx-auto px-4 lg:px-8">
         <h2 class="text-2xl text-black font-bold mb-4">Keranjang Belanja</h2>
         <div id="isikart">

            @if ($cart && $cart->items->isNotEmpty())
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                  @foreach ($cart->items as $item)
                     <div id="cart-item-{{ $item->id }}"
                        class="bg-beige text-black p-3 lg:p-4 rounded-lg shadow-md flex flex-row relative">
                        <div class="absolute top-2 right-2">
                           <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                              id="remove-form-{{ $item->id }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="remove-button text-red-500 hover:text-red-700"
                                 data-item-id="{{ $item->id }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M19.5 9l-1.327 10.581a2.25 2.25 0 01-2.243 2.169H8.07a2.25 2.25 0 01-2.243-2.17L4.5 9m15 0H4.5m3-4.5V6a3 3 0 003 3h3a3 3 0 003-3V4.5m3 0V6a3 3 0 01-3 3h-3a3 3 0 01-3-3V4.5m6 0V3m0 3V4.5m0 0H6m12 0h-3m3 0V3m0 3V4.5">
                                    </path>
                                 </svg>
                              </button>
                           </form>
                        </div>
                        <div class="flex flex-row items-center justify-between">
                           <input class="item-checkbox rounded" type="checkbox" name="selected" value="1"
                              {{ $item->selected ? 'checked' : '' }} data-item-id="{{ $item->id }}"
                              style="transform: scale(1.5); cursor: pointer">
                        </div>
                        <div class="flex flex-row items-center ml-4 w-full">
                           <img src="{{ $item->image }}" alt="{{ $item->name }}"
                              class="w-28 h-28 lg:w-36 lg:h-36 object-cover rounded">
                           <div class="flex flex-col justify-between ml-4 w-full">
                              <div class="my-1">
                                 <span class="font-bold">{{ $item->name }}</span>
                              </div>
                              <div>
                                 <small>Color: {{ $item->color }}</small>
                              </div>
                              <div>
                                 <small>Size: {{ $item->size }}</small>
                              </div>
                              <div class="my-1">
                                 <p id="price-{{ $item->id }}">Rp {{ number_format($item->price) }}</p>
                              </div>
                              <div>
                                 <div>
                                    <small class="text-green-600">Tersedia:
                                       {{ $item->product->variants->filter(function ($variant) use ($item) {
                                               return $variant->size == $item->size && $variant->color == $item->color;
                                           })->first()->stock ?? 'Tidak tersedia' }}

                                    </small>
                                 </div>
                              </div>
                              <div class="my-1 flex items-center">
                                 <div class="quantity-input-wrapper flex items-center bg-white">
                                    <button type="button" class="quantity-button p-1"
                                       data-item-id="{{ $item->id }}" data-delta="-1">-</button>
                                    <input type="number" name="quantity" id="quantity-input-{{ $item->id }}"
                                       value="{{ $item->quantity }}" min="1"
                                       max="{{ $item->product->variants->filter(function ($variant) use ($item) {
                                               return $variant->size == $item->size && $variant->color == $item->color;
                                           })->first()->stock }}"
                                       class="quantity-input mx-1 lg:mx-2 text-sm w-12"
                                       data-stock="{{ $item->product->variants->filter(function ($variant) use ($item) {
                                               return $variant->size == $item->size && $variant->color == $item->color;
                                           })->first()->stock }}">
                                    <button type="button" class="quantity-button p-1"
                                       data-item-id="{{ $item->id }}" data-delta="1">+</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            @else
               <p class="text-xl text-black mb-4">Keranjang Anda Kosong</p>
            @endif
         </div>

         <div class="text-right mt-2 lg:mt-4" id="pricenih">
            @if ($cart && $cart->items !== null && $cart->items->isNotEmpty())
               <p id="total-price" class="text-lg text-black font-bold"></p>

               <form id="buy-form" action="{{ route('cart.confirmChanges') }}" method="POST" style="display: none;">
                  @csrf
               </form>

               <button id="buy-button"
                  class="mt-2 lg:mt-4 bg-orange inline-block text-white py-2 px-4 rounded hover:bg-orangehv">
               </button>
            @endif
         </div>
      </div>
   </section>

</x-app-layout>
