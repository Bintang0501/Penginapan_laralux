<form action="{{ url('/member/' . $edit->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="no_ktp" class="form-label"> No. KTP </label>
            <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan Nomer KTP" value="{{ $edit->no_ktp }}">
        </div>
        <div class="form-group">
            <label for="nama" class="form-label"> Nama </label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required value="{{ old('nama', $edit->users->name) }}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenis_kelamin" class="form-label"> Jenis Kelamin </label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                        <option value="">- Pilih -</option>
                        <option {{ $edit->jenis_kelamin == "Laki - Laki" ? 'selected' : '' }} value="Laki - Laki">Laki - Laki</option>
                        <option {{ $edit->jenis_kelamin == "Perempuan" ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label"> Email </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required value="{{ old('email', $edit->users->email) }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="alamat" class="form-label"> Alamat </label>
            <textarea name="alamat" class="form-control" id="alamat" rows="5" required placeholder="Masukkan Alamat">{{ old('alamat', $edit->alamat) }}</textarea>
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
