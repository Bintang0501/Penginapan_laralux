<form action="{{ url('/produk/' . $edit->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="name"> Nama </label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Masukkan Name Produk" required value="{{ old('name', $edit->name) }}">
        </div>
        <div class="form-group">
            <label for="tipe_produk_id"> Tipe Produk </label>
            <select name="tipe_produk_id" class="form-control" id="tipe_produk_id" required>
                <option value="">- Pilih -</option>
                @foreach ($tipeProduk as $item)
                    <option value="{{ $item->id }}" {{ $edit->tipe_produk_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="harga"> Harga Produk </label>
            <input type="number" class="form-control" name="harga" id="harga"
                placeholder="Masukkan Harga Produk" min="1000" required value="{{ old('harga', $edit->harga) }}">
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
