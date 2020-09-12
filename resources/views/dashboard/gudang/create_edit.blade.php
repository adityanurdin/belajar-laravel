@extends('layouts.admin-master')

@section('title')
{{isset($gudang) ? 'Edit' : 'Create' }}  Gudang
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Gudang</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{isset($gudang) ? 'Edit' : 'Create' }} Gudangs</h4>
                </div>
                <div class="card-body">
                    <form action="{{isset($gudang) ? route('gudang.update', $gudang->slug) : route('gudang.store') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($gudang)
                            @method('PUT')
                        @endisset

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Gudang</label>
                                <input type="text" name="nama_gudang" value="{{isset($gudang) ? $gudang->nama_gudang : ' ' }}" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Gudang</label>
                                    <input type="text" name="kode_gudang" value="{{isset($gudang) ? $gudang->kode_gudang : ' ' }}" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea type="text" name="alamat_gudang"  id="" class="form-control">{{isset($gudang) ? $gudang->alamat_gudang : ' ' }}</textarea>
                                </div>
                            </div>

                        </div>
                       
                        

                        <a href="#" class="btn btn-outline-primary float-left">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection