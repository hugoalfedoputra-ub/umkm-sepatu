<x-app-layout>
   <x-slot name="title">
      Pemesanan
   </x-slot>

   <section class="cart py-4 lg:py-8" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000"
      data-aos-delay="500">
      <div class="md:container md:mx-auto px-4 lg:px-8 text-black">
         <h2 class="text-2xl text-black font-bold mb-4">Pemesanan Anda</h2>
         <div>
            @if ($myOrders->isNotEmpty())
               <div class="grid grid-cols-3 gap-4">
                  @foreach ($myOrders as $order)
                     <div class="bg-beige p-4 rounded-lg shadow-md">
                        <p>Order Items:</p>
                        <ul>
                           <p>&emsp;&emsp;Product: {{ $order->nama_produk }}</p>
                           <p>&emsp;&emsp;Color: {{ $order->color }}</p>
                           <p>&emsp;&emsp;Quantity: {{ $order->kuantitas }}</p>
                        </ul>
                        <div class="">
                           <p>Status: <span
                                 style="color:
                                        @switch($order->status)
                                            @case('pending')
                                                maroon;
                                                @break
                                            @case('diproses')
                                                orange;
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
                           </p>
                           <p>Total Price: Rp{{ number_format($order->harga, 2) }}</p>
                        </div>

                     </div>
                  @endforeach
               </div>
               <div class="mt-4 flex justify-center">
                  {{ $myOrders->links() }}
               </div>
            @else
               <p class="text-black">Anda belum memesan.</p>
            @endif
         </div>
      </div>
</x-app-layout>
