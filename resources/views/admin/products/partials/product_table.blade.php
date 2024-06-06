   @foreach ($products as $product)
      <div class="bg-beige rounded-lg flex flex-row gap-x-12 lg:gap-x-16 p-4">
         <div class="min-w-32 item-center">
            <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
         </div>
         <div class="min-w-32 flex flex-col gap-y-4">
            <p class="text-xl font-semibold">{{ $product->name }}</p>
            <button onclick="window.location='{{ url('admin/products/edit/stock/v2/' . $product->id) }}'"
               class="bg-softbrown hover:bg-softbrownhv text-white font-bold py-1 px-2 rounded"
               data-id="{{ $product->id }}">Tambah Stok</button>
            <button onclick="window.location='{{ url('admin/products/edit/v2/' . $product->id) }}'"
               class="bg-maroon hover:bg-maroonhv text-white font-bold py-1 px-2 rounded"
               data-id="{{ $product->id }}">Edit</button>
            <button onclick="window.location='{{ url('admin/products/delete/stock/v2/' . $product->id) }}'"
               class="bg-burgundy hover:bg-burgundyhv text-white font-bold py-1 px-2 rounded">Hapus
               Stok</button>
            <button id="deleteProductBtn"
               class="bg-lightorange hover:bg-lightorangehv text-white font-bold py-1 px-2 rounded deleteProductBtn"
               data-id="{{ $product->id }}">Hapus Produk</button>
         </div>
         <div class="space-y-4 hidden lg:block">
            <p>{{ Str::limit($product->description, 220, '...') }}</p>
            <p class="text-xl font-bold">Rp. {{ number_format($product->price) }}</p>
            <div class="overflow-y-auto h-56 w-80 rounded-lg bg-softbrown">
               <table class="min-w-full text-center" id="productTable">
                  <thead>
                     <tr>
                        <th class="px-4 py-2 border-brown border bg-orangehv text-semibold">Ukuran</th>
                        <th class="px-4 py-2 border-brown border bg-orangehv text-semibold">Warna</th>
                        <th class="px-4 py-2 border-brown border bg-orangehv text-semibold">Stok</th>
                     </tr>
                  </thead>
                  <tbody id="productTableBody">
                     @foreach ($productVariants as $variant)
                        @if ($variant->product_id == $product->id)
                           <tr>
                              <td class="py-1 px-4 border-brown border">{{ $variant->size }}</td>
                              <td class="py-2 px-4 border-brown border">{{ $variant->color }}</td>
                              <td class="py-2 px-4 border-brown border">{{ $variant->stock }}</td>
                           </tr>
                        @endif
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   @endforeach
