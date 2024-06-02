<x-app-layout>
   <x-slot name="title">
      Update Pesanan
   </x-slot>

   <section class="flex">
      @include('layouts.sidebar')

<<<<<<< HEAD
        <div class="flex-1 p-4 text-white">
            <button class="underline text-black font-bold" onclick="window.location='{{ route('admin.dashboard') }}'">
                Kembali </button>
            <div class="container mx-auto py-8">
                <h2 class="text-2xl text-black font-bold mb-4">Update Pesanan</h2>
=======
      <div class="flex-1 p-4 text-white">
>>>>>>> 0c737c266b1be29e5da31c051ce944939eeec25f

         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Detail Pesanan</h2>

            <table style="border: none;">
               <tr>
                  <td>Order ID</td>
                  <td>: {{ $orders->id }}</td>
               </tr>
               <tr>
                  <td>Waktu Order</td>
                  <td>: {{ $orders->created_at }}</td>
               </tr>
               <tr>
                  <td>Status</td>
                  <td>: <span
                        style="color:
                        @switch($orders->status)
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
                    ">
                        {{ $orders->status }}</span>
                  </td>
               </tr>
               <tr>
                  <td>Alamat</td>
                  <td>: {{ $orders->address }}</td>
               </tr>
               <tr>
                  <td>Total harga</td>
                  <td>: Rp{{ number_format($orders->total_price, 2) }}</td>
               </tr>
            </table>

<<<<<<< HEAD
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($recentOrder as $order)
                        <div class="flex flex-row justify-between bg-beige p-4 rounded-lg shadow-md relative">
                            <div class="text-black">
                                <p>Order ID: {{ $order->nomor_id }}</p>
                                <p>Total Price: Rp{{ number_format($order->harga, 2) }}</p>
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
                                <p>Order Items:</p>
                                <ul>
                                    <p>&emsp;&emsp;Product: {{ $order->nama_produk }}</p>
                                    <p>&emsp;&emsp;Color: {{ $order->color }}</p>
                                    <p>&emsp;&emsp;Quantity: {{ $order->kuantitas }}</p>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $order_status = $order->status;
                        $order_id = $order->nomor_id;
                        ?>
                    @endforeach
                </div>
                <br>
                <form action="{{ url('admin/orders/update/save/' . $order_id) }}" method="POST">
                    @csrf
                    <div class="text-black">
                        Status:
                        <select name="status" class="bg-beige text-brown rounded-md">
                            <option value="pending" @if ($order_status == 'pending') selected @endif>
                                Pending</option>
                            <option value="diproses" @if ($order_status == 'diproses') selected @endif>
                                Diproses</option>
                            <option value="dalam perjalanan" @if ($order_status == 'dalam perjalanan') selected @endif>Dalam
                                Perjalanan</option>
                            <option value="selesai" @if ($order_status == 'selesai') selected @endif>
                                Selesai</option>
                            <option value="canceled" @if ($order_status == 'canceled') selected @endif>
                                Canceled</option>
                        </select>
                    </div>
                    <div class="pt-4">
                        <button
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange text-base font-medium text-white hover:orangehv focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                    </div>
                </form>

=======
            <p class="text-2xl mt-4">Produk pesanan :</p>
            <div class="grid grid-cols-2 gap-4 mt-4">
               @foreach ($orders->items as $order)
                  <div class="flex flex-row justify-between bg-gray-800 p-4 rounded-lg shadow-md relative">
                     <div class="">
                        <table>
                           <tr>
                              <td class="pr-2">Nama Produk</td>
                              <td>: {{ $order->name }}</td>
                           </tr>
                           <tr>
                              <td>Warna</td>
                              <td>: {{ $order->color }}</td>
                           </tr>
                           <tr>
                              <td>Kuantitas</td>
                              <td>: {{ $order->quantity }}</td>
                           </tr>
                           <tr>
                              <td>Harga</td>
                              <td>: Rp{{ number_format($order->price, 2) }}</td>
                           </tr>
                        </table>
                     </div>
                  </div>
               @endforeach
>>>>>>> 0c737c266b1be29e5da31c051ce944939eeec25f
            </div>
            <br>
            <form action="{{ url('admin/orders/update/save/' . $orders->id) }}" method="POST">
               @csrf
               <div>
                  Status:
                  <select name="status" class="bg-gray-700 text-white rounded-md">
                     <option value="pending" @if ($orders->status == 'pending') selected @endif>
                        Pending</option>
                     <option value="diproses" @if ($orders->status == 'diproses') selected @endif>
                        Diproses</option>
                     <option value="dalam perjalanan" @if ($orders->status == 'dalam perjalanan') selected @endif>Dalam
                        Perjalanan</option>
                     <option value="selesai" @if ($orders->status == 'selesai') selected @endif>
                        Selesai</option>
                     <option value="canceled" @if ($orders->status == 'canceled') selected @endif>
                        Canceled</option>
                  </select>
               </div>
               <div class="mt-8">
                  <button
                     class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm"
                     onclick="window.location='{{ route('admin.dashboard') }}'">
                     Kembali </button>
                  <button
                     class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
               </div>
            </form>

         </div>
      </div>

   </section>

</x-app-layout>
