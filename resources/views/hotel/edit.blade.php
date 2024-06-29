<form action="{{ url('/hotel/' . $edit['id']) }}" method="POST">
  @csrf
  @method("PUT")
  <div class="modal-body">
    <div class="form-group">
        <label for="name"> Tipe Hotel </label>
        <select class="form-control" name="tipe_hotel_id" id="tipe_hotel_id" required value="{{ old('tipe_hotel_id') }}">
            <option selected>~~ PILIH TIPE HOTEL ~~</option>
            @foreach ($tipe_hotel as $tipe)
            <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name"> Nama Hotel </label>
        <input type="text" class="form-control" name="nama" id="nama"
            placeholder="Masukkan Nama Hotel" required value="{{ old('nama') }}">
    </div>
    <div class="form-group">
        <label for="alamat"> Alamat </label>
        <textarea class="form-control" name="alamat" placeholder="Masukkan alamat hotel" id="alamat" required value="{{ old('nama') }}">

        </textarea>
    </div>
    <div class="form-group">
        <label for="nomor_telepon"> Nomor Telepon </label>
        <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon"
            placeholder="Masukkan nomor telepon" required value="{{ old('nomor_telepon') }}">
    </div>
    <div class="form-group">
        <label for="email"> Email </label>
        <input type="email" class="form-control" name="email" id="email"
            placeholder="Masukkan email" required value="{{ old('email') }}">
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
