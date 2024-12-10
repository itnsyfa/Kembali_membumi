<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH CUSTOMER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Customer</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_customer"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option selected="selected">Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
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
        data.append("nama_customer", $('#nama_customer').val());
        data.append("jenis_kelamin",$('#jenis_kelamin').val());
        data.append("alamat",$('#alamat').val());
        data.append("email", $('#email').val());
        data.append("password", $('#password').val());
        
        
        //ajax
        $.ajax({
            url: '{{url('api/customers')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama_customer') },
            
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
                        <td>${response.data.nama_customer}</td>
                        <td>${response.data.jenis_kelamin}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.password}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                        </td>
                    </tr>
                `;
                //append to table
                $('#table-customers').prepend(user);
                //clear form
                $('#nama_customer').val('');
                $('#jenis_kelamin').val('');
                $('#alamat').val('');
                $('#email').val('');
                $('#password').val('');
                //close modal
                $('#modal-create').modal('hide');
            },
            
            error:function(error){
                for (const value of data.values()) {
                        console.log(value);
                    }
                    if(error.responseJSON.nama_customer[0]) {
                        $('#alert-nama_customer').removeClass('d-none');
                        $('#alert-nama_customer').addClass('d-block');
                        $('#alert-nama_customer').html(error.responseJSON.nama[0]);
    
                    }
                    if(error.responseJSON.jenis_kelamin[0]) {
                        $('#alert-jenis_kelamin').removeClass('d-none');
                        $('#alert-jenis_kelamin').addClass('d-block');
                        $('#alert-jenis_kelamin').html(error.responseJSON.jenis_kelamin[0]);
    
                    }
                    if(error.responseJSON.alamat[0]) {
                        $('#alert-alamat').removeClass('d-none');
                        $('#alert-alamat').addClass('d-block');
                        $('#alert-alamat').html(error.responseJSON.alamat[0]);
    
                    }
                    
                    if(error.responseJSON.email[0]) {
                        $('#alert-email').removeClass('d-none');
                        $('#alert-email').addClass('d-block');
                        $('#alert-email').html(error.responseJSON.email[0]);
    
                    }
                    if(error.responseJSON.password[0]) {
                        $('#alert-password').removeClass('d-none');
                        $('#alert-password').addClass('d-block');
                        $('#alert-password').html(error.responseJSON.password[0]);
    
                    }
            }
        });
    });
    </script>