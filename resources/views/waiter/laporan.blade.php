<x-app-layout>
    <x-sidebar>
        <div class="w-full h-screen bg-white p-5 border border-black rounded-md">

       
        <div class=" w-full h-[500px] ">
            <div class="overflow-y-auto max-h-[410px]">
            <table class="w-full bg-white text-left border-collapse">
                <thead class="top-0 sticky bg-white border-main text-main z-10">
                    <tr class="border-2 top-0 sticky text-center border-main  ">
                        <th class="border-2 border-black">No</th>
                        <th class="border-2 border-black">Pelanggan</th>
                        <th class="border-2 border-black">Menu</th>
                        <th class="border-2 border-black">Total Harga</th>
                        <th class="border-2 border-black">Uang Diberikan</th>
                        <th class="border-2 border-black">Kembalian</th>
                        <th class="border-2 border-black">Status</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                     @foreach ($pesanan as $pesan)
                     

                    <tr class="border-2 border-gray-500 text-center">
                       
                            <td class=" text-black py-2 ">{{$pesan->id}}</td>
                            <td class="border border-black">{{ $pesan->pelanggan->nama }}</td>
                            <td class="border border-black">
                                <ul class="list-disc pl-5">
                                    @foreach ($pesan->transaksi as $transaksi)
                                        <li class="text-left">{{ $transaksi->menu->nama }} <span class="text-gray-500 text-sm font-thin">x{{ $transaksi->jumlah }}</span></li>
                                    @endforeach
                                </ul>
                                
                            </td>
                            <td class="border border-black">{{ $pesan->total_harga }}</td>
                            <td class="border border-black">
                                @if ($pesan->uang_diberikan === null)
                                    <span class="text-gray-700 font-thin italic text-sm">Menunggu Pembayaran</span>
                                @else
                                    {{ $pesan->uang_diberikan }}
                                @endif
                            </td>
                            <td class="border border-black">
                                @if ($pesan->kembalian === null)
                                    <span class="text-gray-700 font-thin italic text-sm">Menunggu Pembayaran</span>
                                @else
                                    {{ $pesan->kembalian }}
                                @endif
                            </td>
                            
                            <td class="border border-black">
                                @php
                                $statusClass = match($pesan->status) {
                                    'completed' => 'bg-green-500 text-white',
                                    'pending' => 'bg-red-500 text-white',
                                    default => 'bg-gray-300 text-black', // Kalo status lain, bisa diatur
                                };
                            @endphp
                            <span class="font-bold w-[50px] border px-2 py-1 rounded-xl {{ $statusClass }}">
                                {{ $pesan->status }}
                            </span>
                            </td>
                    </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div>
        </div>
        @php
            $role = Auth::user()->role;
        @endphp
        <a href="{{ route("kasir.export") }}" class="bg-blue-500 p-2 rounded-xl text-white font-bold hover:bg-blue-900  transition-all duration-300 hover:text-black/"><span class="hover:scale-105">Download Laporan Excel</span></a>
    </div>
    </x-sidebar>
</x-app-layout>