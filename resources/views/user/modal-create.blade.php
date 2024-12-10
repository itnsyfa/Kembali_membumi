<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_user"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_kelamin"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-username"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password"></div>
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
        data.append("nama_user", $('#nama_user').val());
        data.append("jenis_kelamin",$('#jenis_kelamin').val());
        data.append("alamat",$('#alamat').val());
        data.append("username", $('#username').val());
        data.append("password", $('#password').val());
        
        
        //ajax
        $.ajax({
            url: '{{url('api/users')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama_user') },
            
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
                let user = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_user}</td>
                        <td>${response.data.jenis_kelamin}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.username}</td>
                        <td>${response.data.password}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                        </td>
                    </tr>
                `;
                //append to table
                $('#table-users').prepend(user);
                //clear form
                $('#nama_user').val('');
                $('#jenis_kelamin').val('');
                $('#alamat').val('');
                $('#username').val('');
                $('#password').val('');
                //close modal
                $('#modal-create').modal('hide');
            },
            
            error:function(error){
                for (const value of data.values()) {
                        console.log(value);
                    }
                    if(error.responseJSON.nama_user[0]) {
                        $('#alert-nama').removeClass('d-none');
                        $('#alert-nama').addClass('d-block');
                        $('#alert-nama').html(error.responseJSON.nama[0]);
    
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
                    if(error.responseJSON.harga[0]) {
                        $('#alert-harga').removeClass('d-none');
                        $('#alert-harga').addClass('d-block');
                        $('#alert-harga').html(error.responseJSON.harga[0]);
    
                    }
            }
        });
    });
    </script>