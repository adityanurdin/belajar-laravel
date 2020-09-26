<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gudang;
use App\Models\Barang;

use Str;
use DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gudang = Gudang::all();
        return view('dashboard.barang.create_edit', compact('gudang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::of($request->nama_barang)->slug('-');
        $request->merge(['slug'=>$slug]);
        $barang = Barang::create($request->all());
        if($barang){
            return redirect()->route('barang.index');
        } else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $gudang = Gudang::all();
        $barang = Barang::where('slug' , $slug)->first();
        return view('dashboard.barang.create_edit', compact('gudang', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $barang = Barang::whereSlug($slug)->first();
        if($barang){
            $slug = Str::of($request->nama_barang)->slug('-');
            $request->merge(['slug'=>$slug]);
            $barang->update($request->all());
            return redirect()->route('barang.index');
        }else{
            return redirect()->route('barang.edit',$slug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $barang = Barang::find($slug);
        if ($barang) {
            $barang->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'barang berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'barang gagal di hapus'
            ]);
        }
    }

    public function restore($slug)
    {
        $barang = Barang::where('slug', $slug)
                            ->onlyTrashed()
                            ->first();
        if ($barang) {
            $barang->restore();
            return redirect()->route('barang.index');
        }
    }

    public function data()
    {
        $data = Barang::withTrashed()->get();

        return DataTables::of($data)
                            ->addIndexColumn()
                            ->editColumn('nama_barang', function($item) {
                                $nama = $item->nama_barang.'<br>';
                                $edit = '<a href="'. route('barang.edit', $item->slug) .'">Edit</a> ';
                                $delete = $item->deleted_at == NULL ? '<a href="javascript:void(0)" onclick="myConfirm('.$item->id.')">Delete</a>' : '<a href="'.route('barang.restore', $item->slug).'" >Restore</a>';
                                return $nama.$edit.$delete;
                            })
                            ->addColumn('gudang', function($item) {
                                $gudang = Gudang::find($item->gudang_id);
                                return $gudang->nama_gudang;
                            })
                            ->escapeColumns([])
                            ->make(true);
    }
}
