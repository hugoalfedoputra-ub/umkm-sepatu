   <x-app-layout>
      <x-slot name="title">
         Kelola Produk
      </x-slot>

      <section class="flex" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="300">

         <div class="bg-whitebg flex-1 p-4 text-black">
            <div class="container mx-auto py-8">
               <h2 class="text-2xl font-bold mb-4">Kelola Produk</h2>


               <div class="flex flex-col sm:flex-row justify-between mb-4">
                  <button class="bg-orange hover:bg-orangehv text-white font-bold py-2 px-4 rounded lg:mb-0 mb-2"
                     onclick="window.location='{{ url('admin/products/add/v2/') }}'">Tambah Produk</button>

                  <div class="flex flex-col justify-between lg:flex-row text-black">
                     <input type="text" id="productSearchInput" class="border rounded p-2 mr-2 mb-2 lg:mb-0"
                        placeholder="Cari produk...">
                     <div class="flex flex-row justify-between mb-2 lg:mb-0">
                        <select id="productSortBy" class="border rounded w-full mr-2 sm:mb-0">
                           <option value="id">Id</option>
                           <option value="name">Nama</option>
                           <option value="price">Harga</option>
                        </select>
                        <select id="productSortOrder" class="border rounded w-full mr-2 sm:mb-0">
                           <option value="asc">Asc</option>
                           <option value="desc">Desc</option>
                        </select>
                     </div>
                     <button id="productSearchBtn"
                        class="bg-orange hover:bg-orangehv text-white font-bold py-2 px-4 rounded">Cari</button>
                  </div>
               </div>

               <div id="productTableContainer" class="flex flex-col gap-y-4 flex-shrink-0 w-full">
                  @include('admin.products.partials.product_table', [
                      'products' => $products,
                      'productVariants' => $productVariants,
                  ])
               </div>

               <div id="paginationLinks" class="flex justify-center mt-8">
                  {{ $products->links() }}
               </div>
            </div>
         </div>

      </section>
   </x-app-layout>
