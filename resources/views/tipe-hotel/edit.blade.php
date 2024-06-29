<form action="{{ url('/tipe-hotel/' . $edit['id']) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="name"> Tipe Hotel </label>
            <input type="text" class="form-control" name="nama" id="name" placeholder="Masukkan Tipe Hotel" required value="{{ old('name', $edit['name']) }}">
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
