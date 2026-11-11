
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - MyFlorist</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#f5f7f2] min-h-screen">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5 mb-8">
        <div>
            <p class="text-green-700 font-semibold text-sm mb-2">
                MYFLORIST / INVENTARIS
            </p>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                Daftar Produk
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola persediaan produk toko bunga dengan mudah.
            </p>
        </div>

        <button type="button"
                onclick="openModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold shadow-sm">
            + Tambah Item
        </button>
    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- NOTIFIKASI ERROR -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-800 p-4 rounded-xl mb-6">
            <p class="font-semibold mb-2">Periksa kembali input kamu:</p>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- RINGKASAN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Total Jenis Produk</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $products->count() }}
            </h2>
            <p class="text-green-700 text-sm mt-2">Produk terdaftar</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Total Stok Barang</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $products->sum('stok') }}
            </h2>
            <p class="text-green-700 text-sm mt-2">Unit persediaan</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Total Nilai Persediaan</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-2">
                Rp {{ number_format($products->sum(function($item) {
                    return $item->harga * $item->stok;
                }), 0, ',', '.') }}
            </h2>
            <p class="text-green-700 text-sm mt-2">Harga × jumlah stok</p>
        </div>

    </div>

    <!-- TABEL PRODUK -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Data Persediaan Produk
                </h2>
                <p class="text-gray-500 text-sm mt-1">
                    Daftar seluruh produk MyFlorist.
                </p>
            </div>

            <input
                type="text"
                id="search"
                placeholder="Cari nama produk..."
                class="border border-gray-300 rounded-xl px-4 py-3 w-full md:w-72 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">

                <thead class="bg-[#edf3e9] text-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold">No</th>
                        <th class="px-6 py-4 text-sm font-bold">Nama Barang</th>
                        <th class="px-6 py-4 text-sm font-bold">Harga</th>
                        <th class="px-6 py-4 text-sm font-bold">Stok</th>
                        <th class="px-6 py-4 text-sm font-bold">Deskripsi</th>
                        <th class="px-6 py-4 text-sm font-bold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="productTable">

                    @forelse($products as $product)
                        <tr class="border-b border-gray-100 hover:bg-green-50 transition">

                            <td class="px-6 py-5 text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="font-semibold text-gray-800">
                                    {{ $product->nama_barang }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-gray-700">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-5">
                                @if($product->stok <= 5)
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $product->stok }} (Menipis)
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $product->stok }} (Tersedia)
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-gray-500 max-w-xs">
                                {{ $product->deskripsi ?: '-' }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-2">

                                    <!-- TOMBOL EDIT -->
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="bg-blue-100 text-blue-700 px-3 py-2 rounded-lg hover:bg-blue-200 text-sm font-semibold">
                                        Edit
                                    </a>

                                    <!-- TOMBOL HAPUS -->
                                    <form action="{{ route('products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-100 text-red-700 px-3 py-2 rounded-lg hover:bg-red-200 text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400">
                                <div class="text-4xl mb-3">🌷</div>
                                <p class="font-semibold text-gray-600">
                                    Belum ada produk
                                </p>
                                <p class="text-sm mt-1">
                                    Silakan tambahkan produk pertama MyFlorist.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="p-5 bg-gray-50 text-sm text-gray-500">
            Menampilkan {{ $products->count() }} produk.
        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center text-gray-400 text-sm mt-8">
        © 2026 MyFlorist - Sistem Informasi Persediaan Barang
    </div>

</div>


<!-- MODAL TAMBAH ITEM -->
<div id="modalTambah"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4 overflow-y-auto">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 my-auto">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Item
                </h2>
                <p class="text-gray-500 text-sm">
                    Masukkan informasi produk baru.
                </p>
            </div>

            <button type="button"
                    onclick="closeModal()"
                    class="text-gray-500 hover:text-red-600 text-2xl">
                &times;
            </button>
        </div>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-2">Nama Produk</label>
                <input type="text"
                       name="nama_barang"
                       value="{{ old('nama_barang') }}"
                       placeholder="Masukkan nama produk"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Harga</label>
                <input type="number"
                       name="harga"
                       value="{{ old('harga') }}"
                       placeholder="Masukkan harga"
                       min="0"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Stok</label>
                <input type="number"
                       name="stok"
                       value="{{ old('stok') }}"
                       placeholder="Masukkan jumlah stok"
                       min="0"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                       required>
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi"
                          rows="3"
                          placeholder="Masukkan deskripsi produk"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                          required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeModal()"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg">
                    Batal
                </button>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold">
                    Simpan Item
                </button>
            </div>
        </form>

    </div>
</div>


<!-- JAVASCRIPT -->
<script>
    // Pencarian produk
    document.getElementById('search').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();

        document.querySelectorAll('#productTable tr').forEach(function(row) {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });

    // Membuka modal
    function openModal() {
        const modal = document.getElementById('modalTambah');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Menutup modal
    function closeModal() {
        const modal = document.getElementById('modalTambah');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Klik area luar untuk menutup modal
    document.getElementById('modalTambah').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
</script>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        openModal();
    });
</script>
@endif
</script>

</body>
</html>