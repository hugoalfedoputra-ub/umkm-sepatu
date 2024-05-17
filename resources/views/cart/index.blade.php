<x-app-layout>
   <x-slot name="title">Keranjang Belanja</x-slot>

   <section class="cart py-4 lg:py-8">
      <div class="container mx-auto px-4 lg:px-8">
         <h2 class="text-2xl font-bold mb-4">Keranjang Belanja</h2>
         @if ($cart && $cart->items->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
               @foreach ($cart->items as $item)
                  <div class="bg-white text-black p-3 lg:p-4 rounded-lg shadow-md flex flex-row relative">
                     <div class="absolute top-2 right-2">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                           id="remove-form-{{ $item->id }}">
                           @csrf
                           @method('DELETE')
                           <button type="submit" form="remove-form-{{ $item->id }}"
                              class="text-red-500 hover:text-red-700">
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
                        <form action="{{ route('cart.updateS', $item->id) }}" method="POST" class="mb-4">
                           @csrf
                           <input class="rounded" type="checkbox" name="selected" value="1"
                              {{ $item->selected ? 'checked' : '' }} onchange="this.form.submit()"
                              style="transform: scale(1.5);">
                        </form>
                     </div>
                     <div class="flex flex-row items-center ml-4 w-full">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                           class="w-32 h-32 lg:w-40 lg:h-40 object-cover rounded">
                        <div class="flex flex-col justify-between ml-4 w-full">
                           <div class="my-1">
                              <span class="font-bold">{{ $item->name }}</span>
                           </div>
                           <div class="my-1">
                              <p>Rp {{ number_format($item->price) }}</p>
                           </div>
                           <div class="my-1 flex items-center">
                              <form action="{{ route('cart.updateQ', $item->id) }}" method="POST"
                                 class="flex items-center" id="quantity-form-{{ $item->id }}">
                                 @csrf
                                 <div class="quantity-input-wrapper flex items-center">
                                    <button type="button" class="quantity-button p-1"
                                       onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                    <input type="number" name="quantity" id="quantity-input-{{ $item->id }}"
                                       value="{{ $item->quantity }}" min="1"
                                       class="quantity-input mx-1 lg:mx-2 text-sm w-12">
                                    <button type="button" class="quantity-button p-1"
                                       onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         @else
            <p>Keranjang Anda kosong.</p>
         @endif

         <div class="text-right mt-2 lg:mt-4">
            @if ($totalPrice != 'miaw')
               @if ($totalPrice != 0)
                  <p class="text-lg font-bold">Total: Rp {{ number_format($totalPrice) }}</p>
                  <a href="{{ route('checkout.index') }}"
                     class="mt-2 lg:mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">
                     Beli ({{ $countSelect }})
                  </a>
               @else
                  <p class="text-lg font-bold">Total: -</p>
                  <button class="mt-2 lg:mt-4 inline-block bg-gray-600 text-white py-2 px-4 rounded cursor-not-allowed"
                     disabled>
                     Beli
                  </button>
               @endif
            @endif
         </div>
      </div>
   </section>

   <script>
      function updateQuantity(itemId, delta) {
         const quantityInput = document.getElementById('quantity-input-' + itemId);
         let currentValue = parseInt(quantityInput.value);
         if (currentValue + delta >= 1) {
            quantityInput.value = currentValue + delta;
            document.getElementById('quantity-form-' + itemId).submit();
         }
      }
   </script>
</x-app-layout>
