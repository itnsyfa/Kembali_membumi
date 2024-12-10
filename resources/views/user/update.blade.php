<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama User</label>
                        <input type="text" class="form-control" id="nama_user-edit" name="nama_user">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_user-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin-edit" name="jenis_kelamin">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_kelamin-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat-edit" name="alamat">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Username</label>
                        <input type="text" class="form-control" id="username-edit" name="username">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-usernam-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Password</label>
                        <input type="text" class="form-control" id="password-edit" name="password">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password-edit"></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="update">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

//button create post event
$('body').on('click', '#btn-edit-post', function () {
    let post_id = $(this).data('id');

    //fetch detail post with ajax
    $.ajax({
        url: '{{url('api/users')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama_user-edit').val(response.data.nama_user);
            $('#jenis_kelamin-edit').val(response.data.jenis_kelamin);
            $('#alamat-edit').val(response.data.alamat);
            $('#username-edit').val(response.data.username);
            $('#password-edit').val(response.data.password);
        //open modal
        $('#modal-edit').modal('show');
    }
});
});
//action update post
$('#update').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let post_id=$('#post_id').val()
    var form = new FormData();
    form.append("nama_user",$('#nama_user-edit').val());
    form.append("jenis_kelamin",$('#jenis_kelamin-edit').val());
    form.append("alamat",$('#alamat-edit').val());
    form.append("username",$('#username-edit').val());
    form.append("password",$('#password-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/users')}}/'+post_id,
        type: "POST",
        data: form,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout: 0,
        mimeType: "multipart/form-data",
        
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
            let post = `
            <tr id="index_${response.data.id}">
                <td>${response.data.nama_user}</td>
                <td>${response.data.jenis_kelamin}</td>
                <td>${response.data.alamat}</td>
                <td>${response.data.username}</td>
                <td>${response.data.password}</td>
                <td class="text-left">
                <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                </td>
            </tr>
            `;
            
            //append to post data
            $(`#index_${response.data.id}`).replaceWith(post);
            
            //close modal
            $('#modal-edit').modal('hide');
        },
        error:function(error){
            console.log(error)
            if(error.responseJSON.nama_user[0]) {
                
                //show alert
                $('#alert-nama_user-edit').removeClass('d-none');
                $('#alert-nama_user-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-nama_user-edit').html(error.responseJSON.nama_user[0]);
            }
            if(error.responseJSON.jenis_kelamin[0]) {
                
                //show alert
                $('#alert-jenis_kelamin-edit').removeClass('d-none');
                $('#alert-jenis_kelamin-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-jenis_kelamin-edit').html(error.responseJSON.jenis_kelamin[0]);
            }
            if(error.responseJSON.alamat[0]) {
                
                //show alert
                $('#alert-alamat-edit').removeClass('d-none');
                $('#alert-alamat-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-alamat-edit').html(error.responseJSON.alamat[0]);
            }
            if(error.responseJSON.username[0]) {
                
                //show alert
                $('#alert-username-edit').removeClass('d-none');
                $('#alert-username-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-username-edit').html(error.responseJSON.username[0]);
            }
            if(error.responseJSON.password[0]) {
                
                //show alert
                $('#alert-password-edit').removeClass('d-none');
                $('#alert-password-edit').addClass('d-block');
                
                //add message to alert
                $('#alert-password-edit').html(error.responseJSON.password[0]);
            }
        }
    });
});
</script>