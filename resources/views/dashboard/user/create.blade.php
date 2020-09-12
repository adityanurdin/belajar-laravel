@extends('layouts.admin-master')

@section('title')
    Create User
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Create Users</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="" class="form-control">
                                </div>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" id="" class="form-control">
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