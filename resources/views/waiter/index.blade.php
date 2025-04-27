<x-app-layout>
    <x-sidebar>
        
          
                <h1 class="capitalize text-center py-2 rounded-t-md text-2xl bg-main text-blue-400 font-bold">order makanan/minuman</h1>
                <div class="flex w-full h-[700px]  p-2  ">
                    <div class="w-full  bg-white shadow-xl rounded-xl p-2 border-2   "
                    x-transition:enter.duration.600ms
                    x-transition:leave.duration.600ms
                    :class="open ? 'w-[600px]' :'w-[750px]'">
                   
                    <form action="{{ route('waiter.store') }}" method="POST" id="orderForm" class="px-5 bg-white   pt-2">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-main font-medium ">Nama</label>
                            <x-input type="text" name="nama" class="block  w-full" required/>
                        </div>
                        <div class="mb-4">
                            <label class="block text-main font-medium ">Jenis Kelamin</label>
                            <select type="text" name="jenisK" class="block focus:ring-main mt-2 ml-2 duration-300 rounded-md w-full" required> 
                                <option  class="duration-300" value="Laki_laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-main font-medium ">Nomor HandPhone</label>
                            <x-input type="number" name="noHp" class="block  w-full" required/>
                        </div>
                        <div class="mb-4">
                            <label class="block text-main font-medium ">Alamat</label>
                            <x-input type="text" name="alamat" class="block  w-full" required/>
                        </div>
                        <div class="mb-4">
                            <label class="block text-main font-medium">Pilih Meja</label>
                         
                            <select name="meja" class="w-full mt-2 ml-2 text-main rounded-md focus:ring-main duration-300">
                                @if ($meja->isEmpty()) <!-- Corrected method name -->
                                    <option value="Take Away">Take Away</option> <!-- Ensure the value matches the validation -->
                                @else
                                    @foreach ($meja as $index => $mj)
                                        <option value="{{ $mj->id }}" class="hover:bg-main hover:text-black">
                                            {{ $index + 1 }}. Kapasitas: {{ $mj->kapasitas }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                           
                            
                        </div>
                        <div class="mb-4 ">
                            <label class="block text-main font-medium ">Pilih Menu</label>
                        
                        <div class="space-y-4 overflow-auto max-h-[31vh]">
                            @foreach ($menus as $menu)
                            <div x-data="{ checked: false }" class="flex items-center justify-between bg-main text-white bg-blue-600 px-3 py-3 rounded-lg hover:bg-opacity-90 transition">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="menus[{{ $menu->id }}][id]" value="{{ $menu->id }}"
                                        class="form-checkbox text-coklatd focus:ring-0"
                                        @click="checked = !checked">
                                    <span>{{ $menu->nama }} - Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                </label>
                                <div x-show="checked"
                                x-transition.enter.200ms class="flex items-center space-x-2">
                                    <button type="button" class="px-2 bg-white border-2 border-secs text-main rounded decrement"
                                        data-target="jumlah_{{ $menu->id }}">−</button>
                                    <input type="number" name="menus[{{ $menu->id }}][jumlah]" min="1" value="1"
                                        id="jumlah_{{ $menu->id }}" class="w-12 border text-center p-1 text-yellow-800 rounded">
                                    <button type="button" class="px-2 bg-white border-2 border-secs text-main rounded increment"
                                        data-target="jumlah_{{ $menu->id }}">+</button>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        </div>
                        <div class="space-y-4">
                            <x-button type="button" class="block w-full justify-center bg-blue-600 " id="buatPesanan">buat pesanan</x-button>
                        </div>
                    </form>

                
                    </div>
                   
                </div>
          
            <script>
                document.querySelectorAll('.increment').forEach(button => {
                    button.addEventListener('click', function () {
                        let input = document.getElementById(this.dataset.target);
                        input.value = parseInt(input.value) + 1;
                    });
                });
                

                document.querySelectorAll('.decrement').forEach(button => {
                    button.addEventListener('click', function () {
                        let input = document.getElementById(this.dataset.target);
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    });
                });
            </script>
      
    
    </x-sidebar>
</x-app-layout>