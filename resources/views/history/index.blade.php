<x-app-layout>
   <x-slot name="title">
      Pemesanan
   </x-slot>

<<<<<<< HEAD
    <section class="bg-whitebg cart py-4 lg:py-8">
        <div class="md:container md:mx-auto px-4 lg:px-8">
            <h2 class="text-2xl text-black font-bold mb-4">Pemesanan Anda</h2>
            <div>
                @if ($myOrders->isNotEmpty())
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($myOrders as $order)
                            <div class="bg-beige p-4 rounded-lg shadow-md">
                                <div class="text-black">
                                    <p>Order ID: {{ $order->nomor_id }}</p>
                                    <p>Total Price: Rp{{ number_format($order->harga, 2) }}</p>
                                    <p>Status: <span
                                            style="color:
=======
   <section class="cart py-4 lg:py-8">
      <div class="md:container md:mx-auto px-4 lg:px-8">
         <h2 class="text-2xl font-bold mb-4">Pemesanan Anda</h2>
         <div>
            @if ($myOrders->isNotEmpty())
               <div class="grid grid-cols-3 gap-4">
                  @foreach ($myOrders as $order)
                     <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <div class="">
                           <p>Order ID: {{ $order->nomor_id }}</p>
                           <p>Total Price: Rp{{ number_format($order->harga, 2) }}</p>
                           <p>Status: <span
                                 style="color:
>>>>>>> 0c737c266b1be29e5da31c051ce944939eeec25f
                                        @switch($order->status)
                                            @case('pending')
                                                yellow;
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
                           <p>Order Items:</p>
                           <ul>
                              <p>&emsp;&emsp;Product: {{ $order->nama_produk }}</p>
                              <p>&emsp;&emsp;Color: {{ $order->color }}</p>
                              <p>&emsp;&emsp;Quantity: {{ $order->kuantitas }}</p>
                           </ul>
                        </div>
                     </div>
                  @endforeach
               </div>
               <div class="mt-4 flex justify-center">
                  {{ $myOrders->links() }}
               </div>
            @else
               <p>Anda belum memesan.</p>
            @endif
         </div>
      </div>
</x-app-layout>
