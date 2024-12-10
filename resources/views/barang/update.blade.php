<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formData _edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama-edit" name="nama-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Kategori</label>
                        <select name="kategori-edit" id="kategori-edit" class="form-select" required>
                            <option selected="selected"></option>
                            <option value="indoor">Indoor</option>
                            <option value="outdoor">Outdoor</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Stok</label>
                        <input type="number" class="form-control" id="stok-edit" name="stok-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi-edit" name="deskripsi-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-deskripsi-edit"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Harga</label>
                        <input type="number" class="form-control" id="harga-edit" name="harga-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga-edit"></div>
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
        url: '{{url('api/barangs')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#nama-edit').val(response.data.nama);
            $('#kategori-edit').val(response.data.kategori);
            $('#stok-edit').val(response.data.stok);
            $('#deskripsi-edit').val(response.data.deskripsi);
            $('#harga-edit').val(response.data.harga);
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
    form.append("nama",$('#nama-edit').val());
    form.append("kategori",$('#kategori-edit').val());
    form.append("stok",$('#stok-edit').val());
    form.append("deskripsi",$('#deskripsi-edit').val());
    form.append("harga",$('#harga-edit').val());
    form.append("_method", "PUT");
    
    //ajax
    $.ajax({
        url: '{{url('api/barangs')}}/'+post_id,
        type: "POST",
        data: form,
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
            let post = `
            <tr id="index_${response.data.id}">
                <td style="padding-left:10px">${response.data.nama}</td>
                <td>${response.data.kategori}</td>
                <td>${response.data.stok}</td>
                <td>${response.data.deskripsi}</td>
                <td>
                    <img src="{{ url('storage/storage/gambar/')}}${"/"+response.data.gambar}" width=100 height=100>
                </td>
                <td>${response.data.harga}</td>
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
       
    });
});
</script>