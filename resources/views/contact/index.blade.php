<x-app-layout>
   <x-slot name="title">
      Kontak Kami
   </x-slot>

   <section class="contact py-8">
      <div class="container mx-auto">
         <h2 class="text-2xl font-bold mb-4">Kontak Kami</h2>
         <form>
            <div class="mb-4">
               <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
               <input type="text" id="name"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  required>
            </div>
            <div class="mb-4">
               <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
               <input type="email" id="email"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  required>
            </div>
            <div class="mb-4">
               <label for="message" class="block text-gray-700 font-bold mb-2">Pesan</label>
               <textarea id="message" rows="5"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  required></textarea>
            </div>
            <button type="submit"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
               Kirim Pesan
            </button>
         </form>
      </div>
   </section>
</x-app-layout>
