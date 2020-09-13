@extends('layouts.admin-master')
@section('title','Barang')
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
                    <a href="{{route('barang.create')}}" class="btn btn-primary float-right mb-5">Tambah Data</a>
                    <table class="table" id="table-barang">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>No Seri</th>
                                <th>Jumlah Barang</th>
                                <th>Gudang</th>
                                <th>Status</th>
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

        var table = $('#table-barang').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('barang.data') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'nama_barang', name: 'nama_barang'},
                            {data: 'merk', name: 'merk'},
                            {data: 'no_seri', name: 'no_seri'},
                            {data: 'jumlah_barang', name: 'jumlah_barang'},
                            {data: 'gudang', name: 'gudang'},
                            {data: 'status', name: 'status'},
                        ]
                    })


            function myConfirm(id) {
                var r = confirm("Yakin ingin menghapus ?")
                if (r) {
                    $.ajax({
                        url : "/barang/"+id+"/delete",
                        type: 'GET',
                        success: function(result) {
                            console.log(result)
                            if (result.status == true) {
                                alert(result.pesan)
                                table.draw()
                            } else {
                                alert(result.pesan)
                            }
                        }
                    })
                }
            }

    </script>

@endpush