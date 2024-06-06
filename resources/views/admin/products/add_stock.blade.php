<x-app-layout>
   <x-slot name="title">
      Tambah Inventaris Produk
   </x-slot>

   <section class="flex md:container md:mx-auto py-8 lg:px-16" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="300">

      <div class="bg-whitebg flex-1 p-4 text-black">
         <button class="text-base font-bold underline" onclick="window.location='{{ route('admin.products.products') }}'">
            Kembali </button>
         <div class="container mx-auto py-8">

            <h2 class="text-2xl font-bold mb-4">Tambah Inventaris Produk</h2>
            @foreach ($errors->all() as $error)
               <p>{{ $error }}</p>
            @endforeach
            <button
               class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange text-base font-medium text-white hover:bg-orangehv focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
               onclick="addRow()">Tambah baris</button>

            <form action="{{ url('admin/products/edit/stock/save/v2/' . $product->id) }}" method="POST">
               @csrf
               <table class="min-w-full bg-beige rounded-lg mt-4" id="productTable">
                  <thead>
                     <tr>
                        <th class="p-4">Ukuran</th>
                        <th class="p-4">Warna</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4">Aksi</th>
                     </tr>
                  </thead>
                  <tbody id=tableBody>

                  </tbody>
               </table>
               <div class="mt-4">
                  <button
                     class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange text-base font-medium text-white hover:bg-orangehv focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
               </div>

               <br>
            </form>


         </div>
   </section>

   <script>
      document.getElementById('fileInput').addEventListener('change', function(event) {
         const file = event.target.files[0];
         const fileExtension = getFileExtension(file.name);
         const timestamp = Date.now();
         const newFileName = 'storage/images/sepatu_' + timestamp + '.' + fileExtension;
         document.getElementById('imageName').value = newFileName;
      });

      function getFileExtension(filename) {
         return filename.split('.').pop();
      }

      function addRow() {
         // Create a new table row element
         const newRow = document.createElement('tr');

         // Create and append cells with input fields
         for (let i = 0; i < 3; i++) {
            const cell = document.createElement('td');
            const wrapper = document.createElement('div');
            wrapper.classList.add('p-4');
            const input = document.createElement('input');
            if (i == 0) {
               input.type = 'number'
               input.name = 'sizes[]';
            } else if (i == 1) {
               input.type = 'text'
               input.name = 'colors[]';
            } else {
               input.type = 'number';
               input.name = 'stock[]'
            }
            input.setAttribute('required', '');
            input.classList.add('pt-1', 'block', 'w-full', 'bg-gray-900', 'border-gray-700', 'text-white', 'rounded-md',
               'shadow-sm');
            wrapper.appendChild(input);
            cell.appendChild(wrapper);
            newRow.appendChild(cell);
         }

         // Create and append a cell for removal button
         const removeCell = document.createElement('td');
         const removeButton = document.createElement('button');
         removeButton.classList.add('bg-red-500', 'hover:bg-red-400', 'text-white', 'font-bold', 'py-1', 'px-2',
            'rounded');
         removeButton.textContent = 'Remove';
         removeButton.addEventListener('click', function() {
            this.parentElement.parentElement.remove(); // Remove the entire row
         });
         removeCell.appendChild(removeButton);
         newRow.appendChild(removeCell);

         // Append the new row to the table body
         document.getElementById('tableBody').appendChild(newRow);

         if (rowCount > 0) {
            document.getElementById('showIfRowsExist').hidden = false;
         }
      }
   </script>

</x-app-layout>
