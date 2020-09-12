<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User;
use Validator;
use Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6'
        ])->validate();

        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        $user = User::create($request->except('password_confirmation'));

        if ($user) {
            return redirect()->route('users.index')->with('info', 'User Berhasil di buat');
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
            $user->update($request->except('password_confirmation'));
            return redirect()->route('users.index')->with('info', 'User Berhasil di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('info', 'User Berhasil di hapus');
    }

    public function data()
    {
        $data = User::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('name', function($item) {
                            $nama = $item->name.'<br>';
                            $edit = '<a href="'. route('users.edit', $item->id) .'">Edit</a> ';
                            $delete = '<a href="'. route('users.destroy', $item->id) .'">Delete</a>';
                            return $nama.$edit.$delete;
                        })
                        ->escapeColumns([])
                        ->make(true);
    }
}
