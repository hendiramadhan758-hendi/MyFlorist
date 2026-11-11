
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item - MyFlorist</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#f5f7f2] min-h-screen">

    <div class="max-w-5xl mx-auto px-6 py-12">

        <!-- Header -->
        <div class="mb-8">
            <p class="text-green-700 font-semibold text-sm mb-2">
                MYFLORIST / INVENTARIS
            </p>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                Tambah Item Baru
            </h1>

            <p class="text-gray-500 mt-2 text-base">
                Tambahkan produk baru ke dalam daftar persediaan toko.
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 md:p-10">

            <div class="flex items-center gap-3 mb-8 pb-5 border-b">
                <div class="bg-green-100 p-3 rounded-xl">
                    <span class="text-2xl">🌷</span>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-800">
                        Informasi Produk
                    </h2>
                    <p class="text-sm text-gray-500">
                        Lengkapi informasi barang berikut.
                    </p>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">

                    <!-- Nama Barang -->
                    <div class="md:col-span-2">
                        <label class="block text-base font-semibold text-gray-700 mb-2">
                            Nama Barang
                        </label>

                        <input
                            type="text"
                            name="nama_barang"
                            value="{{ old('nama_barang') }}"
                            placeholder="Contoh: Bunga Mawar Merah"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 text-base focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-base font-semibold text-gray-700 mb-2">
                            Harga Produk (Rp)
                        </label>

                        <input
                            type="number"
                            name="harga"
                            value="{{ old('harga') }}"
                            placeholder="Contoh: 15000"
                            min="0"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 text-base focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-base font-semibold text-gray-700 mb-2">
                            Jumlah Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            value="{{ old('stok') }}"
                            placeholder="Masukkan jumlah stok"
                            min="0"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 text-base focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block text-base font-semibold text-gray-700 mb-2">
                            Deskripsi Produk
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            placeholder="Tuliskan keterangan produk..."
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 text-base focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('deskripsi') }}</textarea>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-10 pt-6 border-t">

                    <a href="{{ route('products.index') }}"
                       class="text-center px-7 py-3.5 rounded-xl border border-gray-300 text-gray-600 font-semibold hover:bg-gray-100">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-8 py-3.5 rounded-xl bg-green-700 text-white font-semibold hover:bg-green-800 shadow-md">
                        + Simpan Item
                    </button>

                </div>

            </form>
        </div>

        <p class="text-center text-gray-400 text-sm mt-8">
            © 2026 MyFlorist - Sistem Informasi Persediaan Barang
        </p>

    </div>

</body>
</html>
