<x-app-layout>
    <x-sidebar>
        <div class="w-full min-h-screen bg-white rounded-md p-6 shadow-md">
            <h1 class="text-2xl font-bold text-center mb-8 text-blue-600">Tambah Menu</h1>

            <form action="{{ route('menu.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <x-label for="Nama" class="block text-gray-700 text-lg mb-2">Nama</x-label>
                    <x-input id="Nama" type="text" name="nama" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200" placeholder="Masukkan Nama Menu" />
                </div>

                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Harga</x-label>
                    <x-input type="number" name="harga" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200 duration-300" placeholder="Masukkan Harga Menu"></x-input>
                </div>

                <div class="flex justify-between items-center pt-8">
                    
                    <a href="{{ route('admin.menu') }}" class="text-blue-500 hover:underline">← Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </x-sidebar>
</x-app-layout>
