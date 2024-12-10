
@extends('layouts.main')
@section('title', 'Data Barang')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('button_header')
@endsection
@section('judul_header', 'Data Barang')

@section('content')

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
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
                <script
            src="https://code.jquery.com/jquery-3.5.1.js">
        </script>
        <script
            src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
        </script>
        <script
            src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js">
        </script>

    </head>
        <body>
            <div class="container" style="margin-top: -55px; margin-bottom: 20px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded-md mt-4">
                            <div class="card-body">
                                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                                <table class="table table-bordered table-striped" id="tblContact">

                                <thead>
                                    <tr>
                                    <th style="min-width: 150px; font-weight:500;padding-left:10px">Nama Barang</th>
                                    <th style="min-width: 120px; font-weight:500;">Kategori</th>
                                    <th style="min-width: 70px; font-weight:500; ">Stok</th>
                                    <th style="min-width: 200px; font-weight:500; ">Deskripsi</th>
                                    <th style="min-width: 100px; font-weight:500; ">Gambar</th>
                                    <th style="min-width: 100px; font-weight:500; ">Harga</th>
                                    <th style="font-weight:500; ">Aksi</th>

                                    </tr>
                                </thead>

                                <tbody id="table-barangs">
                                    @foreach($barangs as $barang)
                                    <tr id="index_{{ $barang->id }}">
                                    <td style="padding-left:10px">{{ $barang->nama }}</td>
                                    <td>{{ $barang->kategori }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>{{ $barang->deskripsi }}</td>
                                    <td><img src="{{ url('/storage/gambar/'.$barang->gambar) }}" width="100" height="100"/></td>
                                    <td>Rp. {{ $barang->harga }}</td>
                                    <td class="text-center" style="padding-right:10px"> <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $barang->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                    
                                    </td>
                              </tr>
                                   @endforeach
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('barang.modal-create')
            @include('barang.update')
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
    <script type="text/javascript">
      $(document).ready(function () {
          $('#tblContact').dataTable({
              "iDisplayLength": 2,
              "lengthMenu": [4,10, 25, 50, 100]
          });
      });
  </script>
@endsection
        </body>
</html>