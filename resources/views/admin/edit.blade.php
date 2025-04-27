<x-app-layout>
    <x-sidebar>
        
        <div class="w-full min-h-screen bg-white rounded-md p-6 shadow-md">
            @if (request()->routeIs('edit.meja'))
            <h1 class="text-2xl font-bold text-center mb-8 text-blue-600">Edit Meja {{ $meja->id }}</h1>
            <form action="{{ route('update.meja',['id'=>$meja->id]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-label for="kapasitas" class="block text-gray-700 text-lg mb-2">Kapasitas</x-label>
                    <x-input id="kapasitas" type="text" name="kapasitas"  value="{{ $meja->kapasitas }}" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200" placeholder="Masukkan kapasitas meja" />
                </div>

                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Status</x-label>
                    <select name="status" id="status" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200 ml-2">
                        <option value="{{ $meja->status }}" selected>{{ ucfirst($meja->status) }}</option>
                        <option value="terisi" id="terisiOption">Terisi</option>
                        <option value="kosong" id="kosongOption">Kosong</option>
                    </select>
                </div>

                <div class="flex justify-between items-center pt-8">
                    <a href="{{ route('admin.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Ubah</button>
                </div>
            </form>
        </div>
            @elseif (request()->routeIs('edit.menu'))

            <form action="{{ route('update.menu',['id'=>$menu->id]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-label for="kapasitas" class="block text-gray-700 text-lg mb-2">Nama</x-label>
                    <x-input id="kapasitas" type="text" name="nama"  value="{{ $menu->nama }}" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200" placeholder="Masukkan kapasitas meja" />
                </div>

            <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Harga</x-label>
                    <x-input  type="number" name="harga" class="w-full rounded-md border-gray-300 focus:border-blue 400 focus:ring" value="{{$menu->harga}}" />
                    
                </div>

                <div class="flex justify-between items-center pt-8">
                    <a href="{{ route('admin.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Ubah</button>
                </div>
            </form>
        </div>

            @elseif (request()->routeIs('edit.user'))
            <form action="{{ route('update.user',['id'=>$user->id]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <x-label for="kapasitas" class="block text-gray-700 text-lg mb-2">Nama</x-label>
                    <x-input id="kapasitas" type="text" name="nama"  value="{{ $user->name }}" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200" placeholder="Masukkan kapasitas meja" />
                </div>

            <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Email</x-label>
                    <x-input  type="email" name="email" class="w-full rounded-md border-gray-300 focus:border-blue 400 focus:ring" value="{{$user->email}}" />
                    
                </div>
                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Password</x-label>
                    <x-input  type="password" name="password" class="w-full rounded-md border-gray-300 focus:border-blue 400 focus:ring" value="{{$user->harga}}" />
                    
                </div>
                <div>
                    <x-label for="status" class="block text-gray-700 text-lg mb-2">Role</x-label>
                    <select name="role" id="status" class="w-full rounded-md border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-200 ml-2">
                        <option value="{{ $user->role }}" selected>{{ ucfirst($user->role) }}</option>
                        <option value="admin" id="adminOption">Admin</option>
                        <option value="waiter" id="waiterOption">Waiter</option>
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>

                <div class="flex justify-between items-center pt-8">
                    <a href="{{ route('admin.index') }}" class="text-blue-500 hover:underline">← Kembali</a>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Ubah</button>
                </div>
            </form>
        </div>
            @endif


            
        <script>
            function handleStatusChange() {
                const status = document.getElementById('status').value;
                const terisiOption = document.getElementById('terisiOption');
                const kosongOption = document.getElementById('kosongOption');
                const statusSelect = document.getElementById('status');
    const options = document.querySelectorAll('#status option');

    // Function untuk menghilangkan option yang sudah dipilih
    statusSelect.addEventListener('change', function() {
        options.forEach(option => {
            if (option.value === statusSelect.value) {
                option.style.display = 'none'; // Sembunyikan option yang sudah dipilih
            } else {
                option.style.display = 'block'; // Tampilkan option yang lain
            }
        });
    });

    // Trigger perubahan awal untuk menghilangkan opsi yang sesuai
    statusSelect.dispatchEvent(new Event('change'));

                if (status === 'terisi') {
                    terisiOption.style.display = 'none';
                } else {
                    terisiOption.style.display = 'block';
                }
                if(status ==='kosong'){
                    kosongOption.style.display = 'none';
                }else{
                    kosongOption.style.display = 'block';
                }
            }
        
            // Memanggil fungsi agar langsung bekerja ketika halaman dimuat
            handleStatusChange();
        </script>
    </x-sidebar>
</x-app-layout>
