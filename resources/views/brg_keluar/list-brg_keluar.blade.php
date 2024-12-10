@extends('layouts.main')
@section('title', 'Data Barang Keluar')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('button_header')
@endsection
@section('judul_header', 'Data Barang Keluar')

@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Barang Keluar</title>
    
    <style>
    body {
        background-color: lightgray !important;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container" style="margin-top: -200px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                    <table class="table table-bordered table-striped" id="tblContact">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Nama Customer</th>
                            <th>Tanggal keluar</th>
                            <th>Jumlah keluar</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>

                    <tbody id="table-brg_keluars">
                        @foreach($brg_keluars as $brg_keluar)
                        <tr id="index_{{ $brg_keluar->id }}">
                            <td>{{ $brg_keluar-> nama }}</td>
                            <td>{{ $brg_keluar-> nama_customer }}</td>
                            <td>{{ $brg_keluar-> tgl_keluar }}</td>
                            <td>{{ $brg_keluar-> jumlah_keluar }}</td>
                            <td>{{ number_format($brg_keluar-> total_harga) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@include('brg_keluar.modal-create')
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
              "iDisplayLength": 5,
              "lengthMenu": [5,10, 25, 50, 100]
          });
      });
  </script>
@endsection
        </body>
</html>