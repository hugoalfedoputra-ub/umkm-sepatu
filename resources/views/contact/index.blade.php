<x-app-layout>
   <x-slot name="title">
      Kontak Kami
   </x-slot>

   <section class="bg-whitebg contact py-8" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500"
      data-aos-delay="100">
      <div class="md:container md:mx-auto px-4 md:px-8 lg:px-16 py-8">
         <h2 class="text-2xl text-black font-bold mb-4">Kontak Kami</h2>
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
               class="bg-orange hover:bg-orangehv text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
               Kirim Pesan
            </button>
         </form>
      </div>
   </section>
</x-app-layout>
