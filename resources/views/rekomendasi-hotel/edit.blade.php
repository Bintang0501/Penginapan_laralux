<form action="{{ url('/rekomendasi-hotel/update-reservasi/' . $keranjangDetail->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="qty"> Quantity </label>
            <input type="number" class="form-control" name="qty" id="qty"
                placeholder="0" required value="{{ old('qty', $keranjangDetail->qty) }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-times" style="margin-right: 5px"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-save" style="margin-right: 5px;"></i> Simpan
        </button>
    </div>
</form>
