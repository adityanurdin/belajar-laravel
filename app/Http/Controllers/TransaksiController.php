<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Transaksi;
use DataTables;

class TransaksiController extends Controller
{
    

    public function index() 
    {
        return view('dashboard.transaksi.index');
    }

    public function create()
    {
        $barang = Barang::where('status', 'Baik')->get();
        return view('dashboard.transaksi.create', compact('barang'));
    }

    public function store(Request $request) 
    {
        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->jumlah_barang === 0) {
            return redirect()->route('transaksi.create')->with('info', 'Stock sedang habis.');
        } elseif ($request->qty > $barang->jumlah_barang) {
            return redirect()->route('transaksi.create')->with('info', 'Qty melebihi batas stock.');
        }

        $barang->update([
            'jumlah_barang' => $barang->jumlah_barang - $request->qty,
        ]);

        $total_harga = $barang->harga * $request->qty;

        $transaksi = Transaksi::create([
            'barang_id'     => $barang->id,
            'qty'           => $request->qty,
            'total_harga'   => $total_harga,
            'status'        => $request->status
        ]);

        if ($transaksi) {
            return redirect()->route('transaksi.index');
        }

        return redirect()->route('transaksi.create');
        
    }

    public function data() 
    {
        $data = Transaksi::with('barang')->get();

        return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('nama_barang', function($item) {
                                return $item->barang['nama_barang'];
                            })
                            ->editColumn('total_harga', function($item) {
                                return \Dit::Rupiah($item->total_harga);
                            })
                            ->editColumn('status', function($item) {
                                if ($item->status == 'sudah_bayar') {
                                    return 'Sudah Bayar';
                                }

                                return 'Belum Bayar';
                            })
                            ->escapeColumns([])
                            ->make(true);

    }


}
