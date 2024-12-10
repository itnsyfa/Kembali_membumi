<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH BARANG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option selected="selected"></option>
                            <option value="indoor">Indoor</option>
                            <option value="outdoor">Outdoor</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Stok</label>
                        <input type="text" class="form-control" id="stok" name="stok">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-gambar"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga"></div>
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
        data.append("nama", $('#nama').val());
        data.append("kategori",$('#kategori').val());
        data.append("stok",$('#stok').val());
        data.append("deskripsi", $('#deskripsi').val());
        data.append('gambar', $('input[id="gambar"]')[0].files[0]);
        data.append("harga", $('#harga').val());
        
        
        //ajax
        $.ajax({
            url: '{{url('api/barangs')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama') },
            
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
                        <td>${response.data.nama}</td>
                        <td>${response.data.kategori}</td>
                        <td>${response.data.stok}</td>
                        <td>${response.data.deskripsi}</td>
                        <td><img src="{{ url('storage/storage/gambar/')}}${"/"+response.data.gambar}"  style="width: 100px; height:100px"></td>
                        <td>${response.data.harga}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                        </td>
                    </tr>
                `;
                //append to table
                $('#table-barangs').prepend(barang);
                //clear form
                $('#nama').val('');
                $('#kategori').val('');
                $('#stok').val('');
                $('#deskripsi').val('');
                $('#gambar').val('');
                $('#harga').val('');
                //close modal
                $('#modal-create').modal('hide');
            },
            
            error:function(error){
                for (const value of data.values()) {
                        console.log(value);
                    }
                    if(error.responseJSON.nama[0]) {
                        $('#alert-nama').removeClass('d-none');
                        $('#alert-nama').addClass('d-block');
                        $('#alert-nama').html(error.responseJSON.nama[0]);
    
                        
                    }
                    if(error.responseJSON.kategori[0]) {
                        $('#alert-kategori').removeClass('d-none');
                        $('#alert-kategori').addClass('d-block');
                        $('#alert-kategori').html(error.responseJSON.kategori[0]);
    
                    }
                    if(error.responseJSON.stok[0]) {
                        $('#alert-stok').removeClass('d-none');
                        $('#alert-stok').addClass('d-block');
                        $('#alert-stok').html(error.responseJSON.stok[0]);
    
                    }
                    if(error.responseJSON.deskripsi[0]) {
                        $('#alert-deskripsi').removeClass('d-none');
                        $('#alert-deskripsi').addClass('d-block');
                        $('#alert-deskripsi').html(error.responseJSON.deskripsi[0]);
    
                    }
                    if(error.responseJSON.gambar[0]) {
                        $('#alert-gambar').removeClass('d-none');
                        $('#alert-gambar').addClass('d-block');
                        $('#alert-gambar').html(error.responseJSON.gambar[0]);
    
                    }

                    if(error.responseJSON.harga[0]) {
                        $('#alert-harga').removeClass('d-none');
                        $('#alert-harga').addClass('d-block');
                        $('#alert-harga').html(error.responseJSON.harga[0]);
    
                    }
            }
        });
    });
    </script>