<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index(){
        $order = Pesanan::where('status','=','pending')->
        orderBy('created_at','asc')->
        with('pelanggan.transaksi.menu')->get();
        // dd($order->toArray());
        return view('kasir.index',compact('order'));
    }
    public function show($id)
    {
        $order = Pesanan::with('transaksi.menu')->find($id);
          
        return view('kasir.show',compact('order'));
        
    }
    public function bayar(Request $request,$id){
           
        $request->validate([
            'uang_diberikan' => 'required|integer|min:0',
        ]);
    
        $uangDiberikan = (int) $request->input('uang_diberikan');
      
        // Mencari pesanan berdpasarkan ID
        $transaksi = Pesanan::with('transaksi')->find($id);
        
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
        
        $total = $transaksi->total_harga;
        
        // Cek apakah uang yang diberikan cukup
        if ($uangDiberikan < $total) {
            return redirect()->back()->with('error', 'Uang yang diberikan tidak cukup.');
        }
    
        $kembalian = $uangDiberikan - $total;
        // Update setiap transaksi terkait
    
        
    
        // Update status pesanan
        $transaksi->update([
            'status' => 'completed',
            'kembalian' =>$kembalian,
            'uang_diberikan'=>$uangDiberikan,
        ]);
        
        return redirect()->route('kasir.index')->with('success', "Pesanan $transaksi->id Berhasil Dibayar");
    
    }
}
