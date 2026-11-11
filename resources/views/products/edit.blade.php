<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - MyFlorist</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-12">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Edit Produk
            </h1>

            <p class="text-gray-500 mb-8">
                Ubah informasi produk sesuai kebutuhan.
            </p>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Nama Produk
                    </label>
                    <input type="text"
                           name="nama_barang"
                           value="{{ old('nama_barang', $product->nama_barang) }}"
                           class="w-full border border-gray-300 rounded-lg p-3"
                           required>
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Harga
                    </label>
                    <input type="number"
                           name="harga"
                           value="{{ old('harga', $product->harga) }}"
                           class="w-full border border-gray-300 rounded-lg p-3"
                           min="0"
                           required>
                </div>

                <div class="mb-5">
                    <label class="block font-semibold mb-2">
                        Stok
                    </label>
                    <input type="number"
                           name="stok"
                           value="{{ old('stok', $product->stok) }}"
                           class="w-full border border-gray-300 rounded-lg p-3"
                           min="0"
                           required>
                </div>

                <div class="mb-7">
                    <label class="block font-semibold mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi"
                              rows="4"
                              class="w-full border border-gray-300 rounded-lg p-3"
                              required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('products.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>