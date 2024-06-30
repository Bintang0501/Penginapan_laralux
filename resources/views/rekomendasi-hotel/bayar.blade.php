<form action="{{ url('/rekomendasi-hotel/pembayaran') }}" method="POST">
    @csrf
    <input type="hidden" name="pajak" value="{{ $pajak }}">
    <div class="modal-body">
        <div class="form-group">
            <label for="total-yang-harus-dibayar"> Total Yang Harus Dibayar </label>
            <input type="text" class="form-control" name="total-yang-harus-dibayar" id="total-yang-harus-dibayar"
                placeholder="Masukkan Total Yang Harus Dibayar" required value="Rp. {{ number_format($pajak) }}" readonly>
                <small style="font-weight: bold">
                    Harga Sudah Termasuk Pajak 11%
                </small>
        </div>
        @if (!empty($point))
        <div class="form-group">
            <label for="reedemPoint">
                Gunakan Reedem Point? Point Anda Sekarang : <strong>{{ $point->point }}</strong>
            </label>
            <select name="reedemPoint" class="form-control" id="reedemPoint">
                <option value="">- Pilih -</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>
        <div class="form-group" id="viewpoint" style="display: none">
            <label for="point"> Masukkan Point Yang Ingin Digunakan </label>
            <input type="number" min="1" max="{{ $point->point }}" class="form-control" name="point" id="point" placeholder="Masukkan Point Yang Ingin Digunakan">
            <small class="text-danger">
                <strong>Catatan:</strong> 1 Point = Rp. 100.000
            </small>
        </div>
        @endif
        <div class="form-group" id="viewbayar">
            <label for="bayar"> Bayar </label>
            <input type="number" class="form-control" name="bayar" id="bayar"
                placeholder="0" min="1">
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
