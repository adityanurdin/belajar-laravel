@extends('layouts.admin-master')
@section('title','Gudang')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Gudang</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Gudang</h4>
                </div>
                <div class="card-body">
                    <a href="{{route('gudang.create')}}" class="btn btn-primary float-right mb-5">Tambah Data</a>
                    <table class="table" id="table-gudang">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gudang</th>
                                <th>Kode Gudang</th>
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

        var table = $('#table-gudang').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('gudang.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_gudang', name: 'nama_gudang'},
                {data: 'kode_gudang', name: 'kode_gudang'},
                ]
            })


            function myConfirm(id) {
                var r = confirm("Yakin ingin menghapus ?")
                if (r) {
                    $.ajax({
                        url : "/gudang/"+id+"/delete",
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