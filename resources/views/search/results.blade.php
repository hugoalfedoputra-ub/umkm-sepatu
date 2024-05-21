<x-app-layout>
    <x-slot name="title">
        Hasil Pencarian
    </x-slot>

    <section class="products md:container md:mx-auto py-8 lg:px-16">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Hasil Pencarian untuk "{{ $query }}"</h2>

            @if($products->isEmpty())
                <p>Tidak ada hasil yang ditemukan.</p>
            @else
                <div class="grid grid-cols-1 text-black md:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 rounded-lg shadow-md m-2">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">
                            <h3 class="font-bold">{{ $product->name }}</h3>
                            <p class="text-green-600 font-semibold">Rp {{ number_format($product->price) }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="mt-4 inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Beli Sekarang</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
