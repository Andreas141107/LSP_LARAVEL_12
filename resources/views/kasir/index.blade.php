<x-app-layout>
    <x-sidebar>
  
                <div class="p-5 text-center w-full min-h-screen mt-2 rounded-xl">
                    <div class="h-full rounded-xl ">
        
        
                        @if($order->isEmpty())
                            {{-- tampilkan saat data kosong --}}
                            <div class="flex flex-col items-center justify-center h-[400px] text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mb-4 text-gray-400 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8h18M3 16h18M3 12h18" />
                                </svg>
                                <p class="text-lg font-semibold">belum ada orderan Masuk</p>
                               
                            </div>
                        @else
                            {{-- tampilkan daftar order --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 p-4">
                                @foreach ($order as $ordr) 
                                    <a href="{{ route('kasir.show',['id'=>$ordr->id]) }}" class="hover:scale-105 transition">
                                        <div class="bg-white hover:bg-gray-100 border border-gray-200 rounded-xl shadow-md p-4 text-left">
                                            <h2 class="text-lg font-bold text-main mb-2">{{ $ordr->pelanggan->nama }}</h2>
        
                                            <p class="text-sm text-gray-600 font-medium mb-2">pesanan:</p>
                                            <ul class="list-disc pl-5 text-sm text-gray-600 mb-3">
                                                @foreach ($ordr->transaksi as $tr)
                                                    <li>{{ $tr->menu->nama ?? '-' }} ({{ $tr->jumlah }}x)</li>
                                                @endforeach
                                            </ul>
        
                                            <p class="text-sm text-gray-600">total:  
                                                <span class="font-semibold text-main">
                                                    Rp{{ number_format($ordr->transaksi->sum('subtotal'), 0, ',', '.') }}
                                                </span>
                                            </p>
        
                                            <p class="text-sm text-gray-600">status: 
                                                <span class="text-yellow-500 font-semibold capitalize">{{ $ordr->status ?? '-' }}</span>
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
         
        
    </x-sidebar>
</x-app-layout>
