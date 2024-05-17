<x-app-layout>
   <x-slot name="title">Keranjang Belanja</x-slot>

   <section class="cart py-4 lg:py-8">
      <div class="container mx-auto px-4 lg:px-8">
         <h2 class="text-2xl font-bold mb-4">Keranjang Belanja</h2>
         @if ($cart && $cart->items->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
               @foreach ($cart->items as $item)
                  <div class="bg-white text-black p-3 lg:p-4 rounded-lg shadow-md flex flex-col justify-between">
                     <div class="flex justify-between items-center">
                        <form action="{{ route('cart.updateS', $item->id) }}" method="POST">
                           @csrf
                           <input type="checkbox" name="selected" value="1" {{ $item->selected ? 'checked' : '' }}
                              onchange="this.form.submit()">
                        </form>
                        <button type="submit" form="remove-form-{{ $item->id }}"
                           class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                     </div>
                     <div class="flex flex-col items-center mt-2 lg:mt-4">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                           class="w-24 lg:w-32 h-24 lg:h-32 object-cover rounded mb-2 lg:mb-4">
                        <span class="font-bold">{{ $item->name }}</span>
                     </div>
                     <div class="mt-2 lg:mt-4 flex flex-col items-center">
                        <form action="{{ route('cart.updateQ', $item->id) }}" method="POST" class="flex items-center"
                           id="quantity-form-{{ $item->id }}">
                           @csrf
                           <div class="quantity-input-wrapper flex items-center">
                              <button type="button" class="quantity-button"
                                 onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                              <input type="number" name="quantity" id="quantity-input-{{ $item->id }}"
                                 value="{{ $item->quantity }}" min="1" class="quantity-input mx-1 lg:mx-2">
                              <button type="button" class="quantity-button"
                                 onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                           </div>
                        </form>
                     </div>
                     <div class="mt-2 lg:mt-4 text-center">
                        <p>Harga Satuan: {{ number_format($item->price, 2) }}</p>
                        <p>Total: {{ number_format($item->price * $item->quantity, 2) }}</p>
                     </div>
                     <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                        id="remove-form-{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                     </form>
                  </div>
               @endforeach
            </div>
         @else
            <p>Keranjang Anda kosong.</p>
         @endif

         <div class="text-right mt-2 lg:mt-4">
            <p class="text-lg font-bold">Total Harga: {{ number_format($totalPrice, 2) }}</p>
            <a href="{{ route('checkout.index') }}"
               class="mt-2 lg:mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Lanjutkan
               ke
               Pembayaran</a>
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
