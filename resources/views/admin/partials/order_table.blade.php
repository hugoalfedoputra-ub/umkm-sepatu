@foreach ($recentOrders as $order)
   <div class="w-full md:w-1/2 px-2 mb-4">
      <div class="bg-beige p-4 rounded-lg shadow-md relative">
         <table class="w-full text-black" style="border-collapse: collapse; border: none; font-size: 0.9rem;">
            <tr class="mb-2">
               <td class="w-44 font-semibold">Order ID</td>
               <td>: {{ $order->id }}</td>
            </tr>
            <tr class="mb-2">
               <td class="font-semibold">Total Price</td>
               <td>: Rp{{ number_format($order->total_price, 2) }}</td>
            </tr>
            <tr class="mb-2">
               <td class="font-semibold">Status</td>
               <td>:
                  <span
                     style="color:
                     @switch($order->status)
                         @case('pending')
                             yellow;
                             @break
                         @case('diproses')
                             brown;
                             @break
                         @case('dalam perjalanan')
                             blue;
                             @break
                         @case('selesai')
                             green;
                             @break
                         @case('canceled')
                             red;
                             @break
                     @endswitch
                  ">{{ $order->status }}</span>
               </td>
            </tr>
            <tr class="mb-2">
               <td class="font-semibold">Jumlah Produk Dibeli</td>
               <td>: {{ $order->items->sum('quantity') }}</td>
            </tr>
            <tr>
               <td class="font-semibold">Waktu Order</td>
               <td>: {{ $order->created_at->format('d M Y H:i') }}</td>
            </tr>
            <tr>
               <td></td>
               <td class="flex justify-end mt-2">
                  <button onclick="window.location='{{ url('admin/orders/update/' . $order->id) }}'"
                     class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-2 rounded">Detail
                     pesanan</button>
               </td>
            </tr>
         </table>
      </div>
   </div>
@endforeach
