<x-app-layout>
   <x-slot name="title">
      Checkout
   </x-slot>

   <section class="bg-whitebg checkout py-8" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000"
      data-aos-delay="500">
      <div class="md:container md:mx-auto lg:px-16">
         <h2 class="text-2xl text-black font-bold mb-4">Checkout</h2>
         <div class="bg-beige p-4 text-black rounded-lg shadow-md">
            <h3 class="text-xl text-black font-bold mb-4">Rincian Pesanan</h3>
            <table class="w-full mb-4">
               <thead>
                  <tr>
                     <th class="text-left">Produk</th>
                     <th class="text-left">Jumlah</th>
                     <th class="text-left">Ukuran</th>
                     <th class="text-left">Warna</th>
                     <th class="text-left">Harga</th>
                     <th class="text-left">Total</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($cartItems as $item)
                     <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->size }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
            <div class="text-right mb-4">
               <h3 class="text-xl font-bold" id="totalPrice" data-total-price="{{ $totalPrice }}">Total:
                  {{ number_format($totalPrice, 2) }}</h3>
            </div>
            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
               @csrf
               <div class="mb-4">
                  <label for="address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                  <input type="text" name="address" id="address"
                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
               </div>
               <div class="mb-4">
                  <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode
                     Pembayaran</label>
                  <select name="payment_method" id="payment_method"
                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                     <option value="credit_card">Kartu Kredit</option>
                     <option value="bank_transfer">Transfer Bank</option>
                     <option value="cash_on_delivery">Bayar di Tempat</option>
                  </select>
               </div>
               <div class="text-right">
                  <button type="submit" id="whatsapp-button"
                     class="bg-orange text-white px-4 py-2 rounded hover:bg-orangehv">Pesan via
                     Whatsapp</button>
               </div>
            </form>

         </div>
      </div>
   </section>
</x-app-layout>
