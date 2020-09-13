@extends('layouts.admin-master')
@section('title','Gudang')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Barang</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Barang</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="table-barang">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>No Seri</th>
                                <th>Jumlah Barang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($gudang->barangs as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->merk}}</td>
                                    <td>{{$item->no_seri}}</td>
                                    <td>{{$item->jumlah_barang}}</td>
                                    <td>{{$item->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    
    <script>

        var table = $('#table-barang').DataTable({
                    // 
                    })

    </script>

@endpush