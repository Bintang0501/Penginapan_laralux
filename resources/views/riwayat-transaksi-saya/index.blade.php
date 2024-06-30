@extends('layout.conquer2')

@section('icha', 'Produk')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('datatables/css/datatables.bootstrap.css') }}">
@endsection

@section('eleanor')

    @if (session('success'))
        <div class="alert alert-success">
            <strong>Berhasil,</strong> {!! session('success') !!}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            <strong>Gagal,</strong> {!! session('error') !!}
        </div>
    @endif

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-book" style="margin-right: 5px"></i> Data @yield('icha')
            </div>
        </div>
        <div class="portlet-body">

            <a href="" class="btn btn-danger btn-sm">
                <i class="fa fa-download"></i> Download PDF
            </a>
            <hr>

            <table class="table table-bordered" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama User</th>
                        <th>Email User</th>
                        <th class="text-center">Total Beli</th>
                        <th class="text-center">Pajak</th>
                        <th class="text-center">Total Bayar</th>
                        <th class="text-center">Kembali</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($transaksi as $item)
                        <tr>
                            <td class="text-center">{{ ++$nomer }}.</td>
                            <td>{{ $item->nama_users }}</td>
                            <td>{{ $item->email_users }}</td>
                            <td class="text-center">Rp. {{ number_format($item->total_beli) }} </td>
                            <td class="text-center">Rp. {{ number_format($item->pajak) }} </td>
                            <td class="text-center">Rp. {{ number_format($item->total_bayar) }} </td>
                            <td class="text-center">Rp. {{ number_format($item->kembalian) }} </td>
                            <td class="text-center">
                                -
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tambah Data -->
    {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-plus"></i> Tambah Data
                    </h4>
                </div>
                <form action="{{ url('/produk') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"> Nama </label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Masukkan Name Produk" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="tipe_produk_id"> Tipe Produk </label>
                            <select name="tipe_produk_id" class="form-control" id="tipe_produk_id" required>
                                <option value="">- Pilih -</option>
                                @foreach ($tipeProduk as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga"> Harga Produk </label>
                            <input type="number" class="form-control" name="harga" id="harga"
                                placeholder="Masukkan Harga Produk" min="1000" required value="{{ old('harga') }}">
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
            </div>
        </div>
    </div> --}}
    <!-- End -->

    <!-- Edit -->
    {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-edit"></i> Edit Data
                    </h4>
                </div>
                <div id="modal-content-edit">
                    <!-- Form -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End -->

@endsection

@section('javascript')
    <script src="{{ URL::asset('datatables/javascript/datatables.js') }}"></script>
    <script src="{{ URL::asset('datatables/javascript/datatables.bootstrap.js') }}"></script>
    {{-- <script type="text/javascript">
        new DataTable('#example');

        function editData(idProduk) {
            $.ajax({
                url: "{{ url('/produk') }}" + "/" + idProduk + "/edit",
                type: "GET",
                success: function(response) {
                    $("#modal-content-edit").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script> --}}
@endsection
