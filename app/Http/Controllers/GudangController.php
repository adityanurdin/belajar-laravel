<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gudang;
use Str;
use DataTables;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.gudang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.gudang.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::of($request->nama_gudang)->slug('-');
        $request->merge(['slug'=>$slug]);
        $gudang = Gudang::create($request->all());
        if($gudang){
            return redirect()->route('gudang.index');
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
    public function show($slug)
    {
        $gudang = Gudang::with('barangs')
                        ->where('slug', $slug)
                        ->first();
        return view('dashboard.gudang.show', compact('gudang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $gudang = Gudang::where('slug', $slug)->first();
        if(!$gudang){
            abort(404);
        }
        return view('dashboard.gudang.create_edit',compact('gudang'));
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
        $gudang = Gudang::whereSlug($slug)->first();
        if($gudang){
            $slug = Str::of($request->nama_gudang)->slug('-');
            $request->merge(['slug'=>$slug]);
            $gudang->update($request->all());
            return redirect()->route('gudang.index');
        }else{
            return redirect()->route('gudang.edit',$slug);
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
        $gudang = Gudang::find($slug);
        if ($gudang) {
            $gudang->delete();
            return response()->json([
                'status' => true,
                'pesan'  => 'Gudang berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Gudang gagal di hapus'
            ]);
        }
    }

    public function data()
    {
        $data = Gudang::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('nama_gudang', function($item) {
                            $nama = $item->nama_gudang.'<br>';
                            $edit = '<a href="'. route('gudang.edit', $item->slug) .'">Edit</a> ';
                            $delete = '<a href="javascript:void(0)" onclick="myConfirm('.$item->id.')">Delete</a> ';
                            $show   = '<a href="'.route('gudang.show', $item->slug).'">Show</a>';
                            return $nama.$edit.$delete.$show;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
