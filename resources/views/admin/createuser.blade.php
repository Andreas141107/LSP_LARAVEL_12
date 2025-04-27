<x-app-layout>
    <x-sidebar>
        <div class="w-full min-h-screen bg-white rounded-md p-6 shadow-md">
            <h1 class="text-2xl font-bold text-center mb-8 text-blue-600">Tambah User</h1>

            <form action="{{ route('user.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <x-label for="Nama" class="block text-gray-700 text-lg mb-2">Nama</x-label>
                    <x-input id="Nama" type="text" name="nama" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200" placeholder="Masukkan Nama user" required />
                </div>

                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Email</x-label>
                    <x-input type="email" name="email" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200 duration-300" placeholder="Masukkan Email user" required />
                </div>
                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">password</x-label>
                    <x-input type="password" name="password" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200 duration-300" placeholder="Masukkan Password user" required />
                </div>
                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Role</x-label>
                   <select name="role" class="w-full rounded-md border-gray-300 focus ml-2" >
                        <option value="admin">Admin</option>
                        <option value="waiter">Waiter</option>
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                   </select>
                </div>

                <div class="flex justify-between items-center pt-8">
                    
                    <a href="{{ route('admin.user') }}" class="text-blue-500 hover:underline">← Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </x-sidebar>
</x-app-layout>
