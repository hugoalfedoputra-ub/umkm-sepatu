<x-app-layout>
   <x-slot name="title">Keranjang Belanja</x-slot>

   <section class="cart py-8">
      <div class="container mx-auto py-8">
         <h2 class="text-2xl font-bold mb-4">Keranjang Belanja</h2>
         @if ($cart && $cart->items->isNotEmpty())
            <div class="bg-white text-black p-4 rounded-lg shadow-md">

               <table class="table-auto w-full table-border" cellpadding="10" cellspacing="10">
                  <thead>
                     <tr>
                        <th class="px-4 py-2">Pilih</th>
                        <th class="px-4 py-2">Produk</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Harga Satuan</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Aksi</th>
                     </tr>
                  </thead>
                  <tbody class="text-center">

                     @foreach ($cart->items as $item)
                        <tr>
                           <td class="border px-4 py-2 text-center w-1">
                              <form action="{{ route('cart.updateS', $item->id) }}" method="POST">
                                 @csrf
                                 <input type="checkbox" name="selected" value="1"
                                    {{ $item->selected ? 'checked' : '' }} onchange="this.form.submit()">
                              </form>
                           </td>
                           <td class="border px-4 py-2">
                              <div class="flex text-center justify-center items-center">
                                 <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                    class="w-16 h-16 object-cover rounded">
                                 <span class="ml-4">{{ $item->name }}</span>
                              </div>
                           <td class="border px-4 py-2 grid place-items-center full-height">
                              <form action="{{ route('cart.updateQ', $item->id) }}" method="POST"
                                 class="flex items-center" id="quantity-form-{{ $item->id }}">
                                 @csrf
                                 <div class="quantity-input-wrapper">
                                    <button type="button" class="quantity-button"
                                       onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                    <input type="number" name="quantity" id="quantity-input-{{ $item->id }}"
                                       value="{{ $item->quantity }}" min="1" class="quantity-input">
                                    <button type="button" class="quantity-button"
                                       onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                 </div>
                              </form>
                           </td>
                           <td class="border px-4 py-2">{{ number_format($item->price, 2) }}</td>
                           <td class="border px-4 py-2">{{ number_format($item->price * $item->quantity, 2) }}
                           </td>
                           <td class="border px-4 py-2">
                              <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         @else
            <p>Keranjang Anda kosong.</p>
         @endif

         <div class="text-right mt-4">
            @if ($totalPrice != 0)
               <p class="text-lg font-bold">Total Harga: {{ number_format($totalPrice, 2) }}</p>
               <a href="{{ route('checkout.index') }}"
                  class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Lanjutkan ke
                  Pembayaran</a>
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
