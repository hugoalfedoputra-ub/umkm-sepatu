<x-app-layout>
   <x-slot name="title">
      Hapus Inventaris Produk
   </x-slot>

   <section class="flex md:container md:mx-auto py-8 lg:px-16" data-aos="fade-in" data-aos-easing="linear"
      data-aos-duration="500" data-aos-delay="300">

      <div class="bg-whitebg flex-1 p-4 text-black">
         <button class=" text-base font-bold underline"
            onclick="window.location='{{ route('admin.products.products') }}'">
            Kembali </button>
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Hapus Inventaris Produk</h2>



            <div class="flex flex-col gap-y-4 flex-shrink-0 w-full">

               <table class="lg:w-[50%] md:w-[70%] sm:w-full bg-beige rounded-lg" id="productTable">
                  <thead>
                     <tr>
                        <th class="py-2 px-4">Ukuran</th>
                        <th class="py-2 px-4">Warna</th>
                        <th class="py-2 px-4">Stok</th>
                        <th class="py-2 px-4">Aksi</th>
                     </tr>
                  </thead>
                  <tbody id="productTableBody">
                     @foreach ($productVariant as $variant)
                        @if ($variant->product_id == $product->id)
                           <tr>
                              <td class="py-2 px-4">{{ $variant->size }}</td>
                              <td class="py-2 px-4">{{ $variant->color }}</td>
                              <td class="py-2 px-4">{{ $variant->stock }}</td>
                              <td class="flex justify-center">
                                 <form
                                    action="{{ url('admin/products/delete/stock/v2/' . $variant->id . '/' . $product->id) }}"
                                    method="GET">
                                    <button type="submit"
                                       class="bg-orange hover:bg-orangehv text-white font-bold py-1 px-2 rounded">Hapus
                                       Stok</button>
                                 </form>
                              </td>
                           </tr>
                        @endif
                     @endforeach
                  </tbody>
               </table>

            </div>

         </div>

      </div>
      </div>
      </div>

   </section>

</x-app-layout>
