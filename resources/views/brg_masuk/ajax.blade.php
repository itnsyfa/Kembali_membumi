@foreach($ajax_barangs as $barang)
                    <div class="form-group">
                        <label class="control-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="{{ $barang->harga}}" readonly required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga"></div>
                    </div>
@endforeach