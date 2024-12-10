<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH BARANG MASUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post" action="">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label>
                        <select name="id_barangs" id="id_barangs" class="form-select" required>
                           @foreach($barangs as $barang)
                            <option selected="selected"  value="{{$barang->id}}">{{$barang->nama}}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div id="detail_barang"></div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Masuk</label>
                        <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_masuk"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Masuk</label>
                        <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jumlah_masuk"></div>
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
        data.append("tgl_masuk",$('#tgl_masuk').val());
        data.append("jumlah_masuk", $('#jumlah_masuk').val());
        data.append("total_harga",$('#total_harga').val());
        
        //ajax
        $.ajax({
            url: '{{url('api/brg_masuks')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('jumlah_masuk') },
            
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
                console.log(response)
                let brg_masuks = `
                    <tr id="brg_masuk_${response.data.id}">
                        <td>${response.data.id_barangs}</td>
                        <td>${response.data.tgl_masuk}</td>
                        <td>${response.data.jumlah_masuk}</td>
                        <td>${response.data.total_harga}</td>
                        

                    </tr>
                `;
                //append to table
                $('#table-brg_masuks').prepend(brg_masuks);
                //clear form
                $('#jumlah_masuk').val('');
                $('#total_harga').val('');
                $('#tgl_masuk').val('');
                $('#id_barangs').val('');
                //close modal
                $('#modal-create').modal('hide');
            },
            
            
        });
    });
    </script>