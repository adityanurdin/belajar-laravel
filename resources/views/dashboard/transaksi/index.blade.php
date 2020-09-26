@extends('layouts.admin-master')

@section('title')
    Transaksi
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Transaksi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>List Transaksi</h4>
                </div>
                <div class="card-body">
                    <a href="{{route('transaksi.create')}}" class="btn btn-primary float-right mb-4">Buat Transaksi</a>
                    <table class="table" id="table-transaksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                                <th>Status Bayar</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#table-transaksi').DataTable({
            processing: true,
                serverSide: true,
                ajax: "{{ route('transaksi.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_barang', name: 'nama_barang'},
                {data: 'qty', name: 'qty'},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'status', name: 'status'},
                ]
        })
    </script>
@endpush