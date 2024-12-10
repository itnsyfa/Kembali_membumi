<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH BARANG KELUAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label>
                        <select name="id_barangs" id="id_barangs" class="form-select" required>
                           @foreach($barangs as $barang)
                            <option selected="selected"  value="{{$barang->id}}">{{$barang->nama}}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Customer</label>
                        <select name="id_customers" id="id_customers" class="form-select" required>
                           @foreach($customers as $customer)
                            <option selected="selected"  value="{{$customer->id}}">{{$customer->nama_customer}}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div id="detail_barang"></div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Keluar</label>
                        <input type="text" class="form-control" id="tgl_keluar" name="tgl_keluar">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_keluar"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Keluar</label>
                        <input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jumlah_keluar"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Total Harga</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-total_harga"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
    //button create post event
    $('body').on('click', '#btn-create-post', function () {
        //open modal
        $('#modal-create').modal('show');
    });
    //action create post
    $('#store').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = new
        FormData(document.getElementById("formData"));
        data.append("id_barangs", $('#id_barangs').val());
        data.append("id_customers", $('#id_customers').val());
        data.append("tanggal_keluar",$('#tanggal_keluar').val());
        data.append("jumlah_keluar", $('#jumlah_keluar').val());
        data.append("total_harga",$('#total_harga').val());

        
        
        //ajax
        $.ajax({
            url: '{{url('api/brg_keluars')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('jumlah_keluar') },
            
            success:function(response){
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                //data post
                let barang = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.id_barangs}</td>
                        <td>${response.data.id_customers}</td>
                        <td>${response.data.tanggal_keluar}</td>
                        <td>${response.data.jumlah_keluar}</td>
                        <td>${response.data.total_harga}</td>

                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                        </td>
                    </tr>
                `;
                //append to table
                $('#table-barangs').prepend(brg_keluars);
                //clear form
                $('#id_barangs').val('');
                $('#id_customers').val('');
                $('#total_harga').val('');
                $('#jumlah_keluar').val('');
                $('#tanggal_keluar').val('');

                //close modal
                $('#modal-create').modal('hide');
            },
            
            error:function(error){
                for (const value of data.values()) {
                        console.log(value);
                    }
                    if(error.responseJSON.jumlah_keluar[0]) {
                        $('#alert-jumlah_keluar').removeClass('d-none');
                        $('#alert-jumlah_keluar').addClass('d-block');
                        $('#alert-jumlah_keluar').html(error.responseJSON.jumlah_keluar[0]);
    
                        
                    }
                    if(error.responseJSON.total_harga[0]) {
                        $('#alert-total_harga').removeClass('d-none');
                        $('#alert-total_harga').addClass('d-block');
                        $('#alert-total_harga').html(error.responseJSON.total_harga[0]);
    
                    }
                    if(error.responseJSON.tanggal_keluar[0]) {
                        $('#alert-tanggal_keluar').removeClass('d-none');
                        $('#alert-tanggal_keluar').addClass('d-block');
                        $('#alert-tanggal_keluar').html(error.responseJSON.tanggal_keluar[0]);
    
                    }
                    if(error.responseJSON.id_barangs[0]) {
                        $('#alert-id_barangs').removeClass('d-none');
                        $('#alert-id_barangs').addClass('d-block');
                        $('#alert-id_barangs').html(error.responseJSON.id_barangs[0]);
    
                    }

                    if(error.responseJSON.id_customers[0]) {
                        $('#alert-id_customers').removeClass('d-none');
                        $('#alert-id_customers').addClass('d-block');
                        $('#alert-id_customers').html(error.responseJSON.id_customers[0]);
    
                    }
            }
        });
    });
    </script>