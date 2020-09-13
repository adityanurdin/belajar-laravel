@extends('layouts.admin-master')

@section('title')
{{isset($barang) ? 'Edit' : 'Create' }}  Barang
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Barang</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{isset($barang) ? 'Edit' : 'Create' }} Barang</h4>
                </div>
                <div class="card-body">
                    <form action="{{isset($barang) ? route('barang.update', $barang->slug) : route('barang.store') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($barang)
                            @method('PUT')
                        @endisset

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                <input type="text" name="nama_barang" value="{{isset($barang) ? $barang->nama_barang : ' ' }}" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Merk Barang</label>
                                    <input type="text" name="merk" value="{{isset($barang) ? $barang->merk : ' ' }}" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No Seri</label>
                                    <input type="text" name="no_seri" id="" value="{{isset($barang) ? $barang->no_seri : ' ' }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Barang</label>
                                    <input type="number" name="jumlah_barang" id="" value="{{isset($barang) ? $barang->jumlah_barang : ' ' }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="selectgroup w-100">
                                      <label class="selectgroup-item">
                                        <input type="radio" name="status" value="Baik" class="selectgroup-input" {{ isset($barang) ? $barang->status == 'Baik' ? 'checked' : '' : '' }}>
                                        <span class="selectgroup-button">Baik</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <input type="radio" name="status" value="Tidak Baik" class="selectgroup-input" {{ isset($barang) ? $barang->status == 'Tidak Baik' ? 'checked' : '' : '' }}>
                                        <span class="selectgroup-button">Tidak Baik</span>
                                      </label>
                                    </div>
                                  </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Gudang</label>
                                    <select class="form-control select2" name="gudang_id">
                                        @foreach ($gudang as $item)
                                            <option value="{{$item->id}}" {{isset($barang) ? $barang->gudang_id == $item->id ? 'selected' : '' : ''}}>{{$item->nama_gudang}}</option>
                                        @endforeach
                                    </select>
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