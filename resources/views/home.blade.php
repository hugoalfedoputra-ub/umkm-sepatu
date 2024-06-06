<x-app-layout>
   <x-slot name="title">
      Home
   </x-slot>

   <section class="hero bg-cover bg-center h-64 text-white"
      style="background: 
            linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url('/storage/images/sepatu.jpg') no-repeat center center; background-size: cover;"
      data-aos="fade-in" data-aos-easing="linear" data-aos-duration="900" data-aos-delay="600">
      <div class="container mx-auto flex justify-center items-center h-full">
         <div class="text-center">
            <h1 class="text-4xl font-bold">Selamat Datang di Butik Sepatu</h1>
            <p class="text-lg">Temukan sepatu terbaik untuk gaya Anda</p>
         </div>
      </div>
   </section>

   <section class="products py-8 min-h-screen p-4 lg:px-16 md:container md:mx-auto" data-aos="fade-up"
      data-aos-easing="linear" data-aos-duration="1000" data-aos-delay="900">
      <div class="container mx-auto">
         <h2 class="text-2xl text-black font-bold mb-4">Produk Terbaru</h2>
         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($products as $product)
               <div class="bg-beige text-black p-4 rounded-lg shadow-md m-2">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     class="w-full h-48 object-cover mb-4 rounded">
                  <h3 class="font-bold">{{ $product->name }}</h3>
                  <p class="text-green-600 font-semibold">Rp {{ number_format($product->price) }}</p>
                  <a href="/products/{{ $product->id }}"
                     class="mt-4 inline-block bg-orange text-white py-2 px-4 rounded hover:bg-orangehv">Beli
                     Sekarang</a>
               </div>
            @endforeach
         </div>


      </div>

   </section>
</x-app-layout>
