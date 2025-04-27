<x-app-layout>
    <div x-data="{ uangDiberikan: 0, total: {{ $order->total_harga }} }"
         class="bg-gray-100 border-black/20 border rounded-lg shadow-2xl p-6 w-96 mx-auto fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
    
        <h2 class="text-xl font-thin text-black bg-main/80   rounded-xl font-sans tracking-wide text-center border-b border-black border-dashed">PEMBAYARAN</h2>
    
        <div class=" space-y-3">
            <ul class="mt-8 border-b pb-2">
                @foreach ($order->transaksi as $transaksi)
                    <li class="flex justify-between">
                        <span>{{ $transaksi->menu->nama }}</span>
                        <span>{{ $transaksi->jumlah }}x</span>
                        <span>Rp. {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
    
            <p class="text-sm font-thin">Total Harga: 
                <span class="text-main">Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </p>
    
            <label class="block text-sm font-thin text-gray-600">Uang Diberikan :</label>
            <input type="number" x-model.number="uangDiberikan" class="border p-1 px-4 w-full rounded-md focus:ring-main transition focus:border-main">
            

    
            <p class="text-sm  font-thin">Kembalian: 
                <span 
                    :class="uangDiberikan - total >= 0 ? 'text-green-600' : 'text-red-600'" 
                    x-text="'Rp. ' + (uangDiberikan - total).toLocaleString('id-ID')">
                </span>
            </p>
        </div>
    
        <div class="flex justify-between border-t mt-5 border-black border-dashed">
            <a href="{{ route('kasir.index') }}" class=" px-3 rounded-xl text-xl py-2 mt-3 text-main hover:text-blue-900 tracking-wider hover:font-semibold font-medium">Kembali</a>
            <form action="{{ route('waiter.bayar',['id'=>$order->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="uang_diberikan"  x-bind:value="uangDiberikan">
                <button 
                type="submit"
                :disabled="uangDiberikan < total"
                :class="uangDiberikan < total 
                    ? 'px-3 rounded-xl text-xl py-2 mt-3 text-gray-500 tracking-wider font-medium cursor-not-allowed' 
                    : 'px-3 rounded-xl text-xl py-2 mt-3 text-main font-medium  hover:text-blue-900 hover:font-semibold tracking-wider transition'"
            >
                bayar
            </button>
            
            </form>
        </div>
    </div>
    </x-app-layout>
    