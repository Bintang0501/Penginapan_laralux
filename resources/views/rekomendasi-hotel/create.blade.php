<form action="{{ url('/produk') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="produk_id"> Produk </label>
            <select name="produk_id" class="form-control" id="">
                <option value="">- Pilih -</option>
                @foreach ($produk as $item)
                    <option value="">
                        {{ $item->nama }} - Tipe Produk : {{ $item->tipe_produk->nama }}
                    </option>
                @endforeach
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
