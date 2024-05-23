<x-app-layout>
    <x-slot name="title">
        Kelola Produk
    </x-slot>

    <section class="flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-4 text-white">
            <div class="container mx-auto py-8">
                <h2 class="text-2xl font-bold mb-4">Kelola Produk [V2]</h2>

                <div class="flex justify-between">
                    <button class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded mb-4"
                        onclick="window.location='{{ url('admin/products/add/v2/') }}'">Tambah Produk</button>

                    <div class="flex justify-center">

                        {{ $products->links() }}
                    </div>
                </div>

                <div class="flex flex-col gap-y-4 flex-shrink-0 w-full">
                    @foreach ($products as $product)
                        <div class="bg-gray-800 rounded-lg flex flex-row gap-x-4 p-4">
                            <div class="min-w-32">
                                <img src="{{ url($product->image) }}" alt="{{ $product->name }}"
                                    class="w-32 h-32 object-cover rounded">
                            </div>
                            <div class="min-w-32 flex flex-col gap-y-4">
                                <p>{{ $product->name }}</p>
                                <button
                                    onclick="window.location='{{ url('admin/products/edit/stock/v2/' . $product->id) }}'"
                                    class="bg-green-500 hover:bg-green-400 text-white font-bold py-1 px-2 rounded"
                                    data-id="{{ $product->id }}">Tambah Stok</button>
                                <button onclick="window.location='{{ url('admin/products/edit/v2/' . $product->id) }}'"
                                    class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-1 px-2 rounded"
                                    data-id="{{ $product->id }}">Edit</button>
                                <button
                                    onclick="window.location='{{ url('admin/products/delete/stock/v2/' . $product->id) }}'"
                                    class="bg-red-500 hover:bg-red-400 text-white font-bold py-1 px-2 rounded">Hapus
                                    Stok</button>
                                <button id="deleteProductBtn"
                                    class="bg-red-500 hover:bg-red-400 text-white font-bold py-1 px-2 rounded deleteProductBtn"
                                    data-id="{{ $product->id }}">Hapus Produk</button>
                            </div>
                            <div>
                                <p>{{ $product->description }}</p>
                                <p>Rp. {{ number_format($product->price) }}</p>
                                <table class="min-w-full bg-gray-800 rounded-lg" id="productTable">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4">Ukuran</th>
                                            <th class="py-2 px-4">Warna</th>
                                            <th class="py-2 px-4">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        @foreach ($productVariants as $variant)
                                            @if ($variant->product_id == $product->id)
                                                <tr>
                                                    <td class="py-2 px-4">{{ $variant->size }}</td>
                                                    <td class="py-2 px-4">{{ $variant->color }}</td>
                                                    <td class="py-2 px-4">{{ $variant->stock }}</td>

                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

</x-app-layout>
