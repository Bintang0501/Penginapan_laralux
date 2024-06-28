<form action="{{ url('/fasilitas/' . $edit->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="nama_fasilitas"> Nama Fasilitas </label>
            <input type="text" class="form-control" name="nama_fasilitas" id="nama_fasilitas"
                placeholder="Masukkan Nama Fasilitas" required value="{{ old('nama_fasilitas', $edit->nama_fasilitas) }}">
        </div>
        <div class="form-group">
            <label for="produk_id"> Nama Produk </label>
            <select name="produk_id" class="form-control" id="produk_id" required>
                <option value="">- Pilih -</option>
                @foreach ($produk as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $edit->produk_id ? 'selected' : '' }} >
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi"> Deskripsi </label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="5" placeholder="Masukkan Deskripsi" required>{{ old('deskripsi', $edit->deskripsi) }}</textarea>
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
