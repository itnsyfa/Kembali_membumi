
@extends('layouts.main')
@section('title', 'Data User')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('button_header')
@endsection
@section('judul_header', 'Data User')

@section('content')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel Ajax CRUD</title>
        
        <style>
            body {
                background-color: lightgray !important;
            }
        </style>

        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
        </script> 
        <script
            src="//cdn.jsdelivr.net/npm/sweetalert2@11">
        </script>
    </head>
        <body>
            <div class="container" style="margin-top: -360px;">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card border-0 shadow-sm rounded-md mt-4">

                            <div class="card-body">

                                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>

                                <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                    <th style=" font-weight:500;padding-left:10px">Nama User</th>
                                    <th style="font-weight:500;">Jenis Kelamin</th>
                                    <th style="font-weight:500;">Alamat</th>
                                    <th style="font-weight:500;">Username</th>
                                    <th style="font-weight:500;">Password</th>
                                    <th style="font-weight:500;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="table-users">
                                    @foreach($users as $user)
                                    <tr id="index_{{ $user->id }}">
                                    <td style="padding-left: 10px;;">{{ $user->nama_user }}</td>
                                    <td>{{ $user->jenis_kelamin }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td class="text-center"> <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $user->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                    
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('user.modal-create')
            @include('user.update')
            @endsection
@section('js')
    <script src="{{url('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        $('#kt_datatable_example_5').DataTable({
            "language":{
                "lengthMenu": "Show MENU",
            },
            "dom":
            "<'row'"+
            "<'col-sm-6 d-flex align-items-center justify-content-start'l"> +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>"+
            ">" +

            "<'table-responsive'tr>"+

            "<'row'"+
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>"+
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>"+
            ">"
        });
    </script>
@endsection
        </body>
</html>