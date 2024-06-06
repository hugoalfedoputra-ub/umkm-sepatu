<x-app-layout>
   <x-slot name="title">
      Update Pesanan
   </x-slot>

   <section class="flex" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000" data-aos-delay="500">

      <div class="flex-1 p-4 text-white">

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
