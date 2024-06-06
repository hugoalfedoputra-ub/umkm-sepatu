<x-app-layout>
   <x-slot name="title">
      Tambah Produk
   </x-slot>

   <section class="flex" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000" data-aos-delay="500">

      <div class="bg-whitebg flex-1 p-4 text-black">
         <button class="text-base font-bold underline"
            onclick="window.location='{{ route('admin.products.products') }}' ">
            Kembali </button>
         <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Tambah Produk Baru</h2>

            <form action="{{ url('admin/products/add/save') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="flex flex-col gap-y-4 flex-shrink-0 w-full">
                  @foreach ($errors->all() as $error)
                     <p>{{ $error }}</p>
                  @endforeach
                  <div class="bg-beige rounded-lg flex flex-row gap-x-4 p-4">
                     <div>
                        <table class="min-w-full bg-gray-800 rounded-lg" id="productTable">
                           <thead>
                              <tr>
                                 <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-black">Nama</label>
                                    <input type="text" name="name" id="name"
                                       class="mt-1 block w-full bg-white border-gray-700 text-white rounded-md shadow-sm"
                                       placeholder="Masukkan nama produk..." required>
                                 </div>
                                 <div class="mb-4">
                                    <label for="description"
                                       class="block text-sm font-medium text-black">Deskripsi</label>
                                    <textarea name="description" id="description"
                                       class="mt-1 block w-full bg-white border-gray-700 text-white rounded-md shadow-sm"
                                       placeholder="Masukkan deskripsi produk..." required></textarea>
                                 </div>
                                 <div class="mb-4">
                                    <label for="price" class="block text-sm font-medium text-black">Harga</label>
                                    <input type="number" name="price" id="price"
                                       class="mt-1 block w-full bg-white border-gray-700 text-white rounded-md shadow-sm"
                                       placeholder="0" required>
                                 </div>
                                 <div class="mb-4">
                                    <label for="fileInput" class="block text-sm font-medium text-black">File
                                       Gambar</label>
                                    <input type="file" name="imageFile" id="fileInput"
                                       accept="image/png, image/jpeg, image/jpg" required>
                                 </div>
                                 <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-black">File akan
                                       disimpan
                                       sebagai</label>
                                    <input type="text" name="imageName" id="imageName"
                                       class="mt-1 block w-full bg-white border-gray-700 text-white rounded-md shadow-sm"
                                       required readonly>
                                 </div>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="pt-4">
                  <button onclick="window.location='{{ route('admin.products.products') }}'"
                     class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                  <button
                     class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
               </div>
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
   </script>

</x-app-layout>
