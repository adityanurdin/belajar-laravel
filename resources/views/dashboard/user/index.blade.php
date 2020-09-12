@extends('layouts.admin-master')

@section('title')
    Users
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>List Users</h4>
                </div>
                <div class="card-body">

                    @if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>
                    @endif

                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3 float-right"><i class="fa fa-plus"></i> Tambah Data</a>
                    <table class="table" id="table-user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
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

        var table = $('#table-user').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.data') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                ]
            })

    </script>

@endpush