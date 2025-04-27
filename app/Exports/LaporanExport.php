<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection,WithHeadings,WithStyles,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function collection()
    {
        return Pesanan::with('transaksi.menu')->get()
        ->map(function($pesanan){
            return[
                'ID'=>$pesanan->id,
                'Pelanggan'=>$pesanan->pelanggan->nama,
                'Total Harga'=>$pesanan->total_harga,
                'Uang Diberikan'=>$pesanan->uang_diberikan ?? 'menunggu pembayaran',
                'Kembalian'=>(string) ($pesanan->kembalian ??  'menunggu pembayaran'),
                'Status'=>$pesanan->status,
                'Menu' =>$pesanan->transaksi->map(function($transaksi){
                    return $transaksi->menu->menu.'('.$transaksi->jumlah.')';
                })->join(','),
            ];
        });

    }
    public function headings():array
    {
        return[
            'ID Pesanan',
            'Nama Pelanggan',
            'Harga Total',
            'Uang Diberikan',
            'Kembalian',
            'Status',
            'Menu'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:G100' => ['borders' => [
                'allBorders' => [
                    'borderStyle' =>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ]],
        ];
    }
}
