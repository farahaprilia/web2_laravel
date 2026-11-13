<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ara Store</title>
</head>
<body>
    <div class="w-full max-w-6xl mx-auto p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <h1 class="text-xl sm:text-2xl font-bold">Tabel Buku</h1>
            <button onclick="toggle_modal()" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Barang
            </button>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse border border-gray-400 text-sm sm:text-base">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-400 p-2 text-left">Nama Barang</th>
                        <th class="border border-gray-400 p-2 text-left">Stok</th>
                        <th class="border border-gray-400 p-2 text-left">Harga</th>
                        <th class="border border-gray-400 p-2 text-left">Deskripsi</th>
                        <th class="border border-gray-400 p-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border border-gray-400 p-2">{{ $product->nama_produk }}</td>
                            <td class="border border-gray-400 p-2">{{ $product->stok }}</td>
                            <td class="border border-gray-400 p-2">{{ $product->harga }}</td>
                            <td class="border border-gray-400 p-2">{{ $product->deskripsi }}</td>
                            <td class="border border-gray-400 p-2 text-center">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1.5 px-3 rounded text-xs sm:text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-tambah-item" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4">
        <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-lg w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">Tambah Item Baru</h2>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <input type="text" name="nama_produk" placeholder="Nama Barang" class="border border-gray-300 rounded px-2.5 py-1.5 mb-2 w-full text-sm sm:text-base">
                <input type="number" name="stok" placeholder="Stok" class="border border-gray-300 rounded px-2.5 py-1.5 mb-2 w-full text-sm sm:text-base">
                <input type="number" name="harga" placeholder="Harga" class="border border-gray-300 rounded px-2.5 py-1.5 mb-2 w-full text-sm sm:text-base">
                <textarea name="deskripsi" placeholder="Deskripsi" class="border border-gray-300 rounded px-2.5 py-1.5 mb-3 w-full text-sm sm:text-base"></textarea>
                <div class="flex flex-col sm:flex-row gap-2">
                    <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                    <button type="button" onclick="toggle_modal()" class="w-full sm:w-auto bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggle_modal() {
            const modal = document.getElementById('modal-tambah-item');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>
</html>