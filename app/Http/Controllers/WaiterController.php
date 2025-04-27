<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class WaiterController extends Controller
{
    public function index(){
        $meja = Meja::where('status','=','kosong')->get();
        $menus = Menu::all();

        return view('waiter.index',compact('meja','menus'));
    }
    public function store(Request $request){
        $meja = Meja::all();
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:1|max:255',
            'jenisK'=>'required|string|',
            'noHp'=>'required|string|min:12|max:12',
            'alamat'=>'required|string|max:255',
            'meja' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'Take Away' && !Meja::where('id', $value)->exists()) {
                        $fail('The selected meja is invalid.');
                    }
                },
            ],
            'menus' => 'required|array',
            'menus.*.id' => 'exists:menus,id',
            'menus.*.jumlah' => 'required|integer|min:1',
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $MejaId = $request->meja === 'Take Away' ? null : $request->meja;

        $pelanggan = Pelanggan::create([
            'nama'=>$request->nama,
            'jenisK'=>$request->jenisK,
            'noHp'=>$request->noHp,
            'alamat'=>$request->alamat,
        ]);
        $pesanan = Pesanan::create([
            
            'meja_id'=>$MejaId,
            'user_id'=>Auth::user()->id, 
            'pelanggan_id'=>$pelanggan->id,
            'total_harga'=> 0,
            'status'=>'pending',
           
        ]);
      
       
        $totalHarga = 0;

        foreach ($request->menus as $menu) {
            if (!isset($menu['id']) || !isset($menu['jumlah'])) {
                continue; // Skip kalau ada yang kosong
            }
    
            $menuData = Menu::find($menu['id']);
            if (!$menuData) {
                continue; //Skip kalau menu tidak ditemukan
            }
    
            $subtotal = $menuData->harga * $menu['jumlah'];
            

            // Simpan ke tabel order detail (pastikan relasi sudah benar)
            $pesanan->transaksi()->create([ 
                'menu_id' => $menu['id'],
                'jumlah' => $menu['jumlah'],
                'subtotal' => $subtotal
            ]);
            $totalHarga += $subtotal;
            
        }
        $pesanan->update(['total_harga'=>$totalHarga,]);

        $meja = Meja::find($request->meja);
        if($meja){
        $meja->update(['status'=>'terisi']);
        }

        return redirect()->back()->with('success',"pesanan $pesanan->id berhasil dibuat, Data Pelanggan $pelanggan->id berhasil disimpan");
    }
    public function laporan(){
        $pesanan = Pesanan::with('pelanggan.transaksi.menu')->get();
        // dd($pesanan->toArray());
       return view('waiter.laporan',compact('pesanan'));
    }
    public function export(){
        return Excel::download(new LaporanExport,'laporan_pesanan.xlsx');
    }
}
