<form action="{{ url('/users/' . $edit->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="name"> Nama </label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Masukkan Nama Users" required value="{{ old('name', $edit->name) }}">
        </div>
        <div class="form-group">
            <label for="email"> Email </label>
            <input type="email" class="form-control" name="email" id="email"
                placeholder="Masukkan Email Users" required value="{{ old('email', $edit->email) }}">
        </div>
        <div class="form-group">
            <label for="role"> Akses </label>
            <select name="role" class="form-control" id="role">
                <option value="">- Pilih -</option>
                <option value="OWNER" {{ $edit->role == "OWNER" ? 'selected' : '' }} >OWNER</option>
                <option value="STAFF" {{ $edit->role == "STAFF" ? 'selected' : '' }} >STAFF</option>
            </select>
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
