<form action="{{ url('/rekomendasi-hotel/pembayaran') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="total-yang-harus-dibayar"> Total Yang Harus Dibayar </label>
            <input type="text" class="form-control" name="total-yang-harus-dibayar" id="total-yang-harus-dibayar"
                placeholder="Masukkan Total Yang Harus Dibayar" required value="Rp. {{ number_format($totalBayar->total) }}" readonly>
        </div>
        <div class="form-group">
            <label for="bayar"> Bayar </label>
            <input type="number" class="form-control" name="bayar" id="bayar"
                placeholder="0" required min="1">
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-times" style="margin-right: 5px"></i> Batal
        </button>
        <button onclick="return confirm('Yakin ? Apakah Anda Ingin Menyelesaikan Pembayaran Ini ?')" type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-save" style="margin-right: 5px;"></i> Simpan
        </button>
    </div>
</form>
