@extends('layout.conquer2')

@section('icha', 'Daftar Hotel')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('datatables/css/datatables.bootstrap.css') }}">
@endsection

@section("breadcrumb")

<ul class="page-breadcrumb">
    <li>
        <a href="{{ url('/dashboard') }}">
            <i class="icon-home"></i> Dashboard
        </a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">
            @yield("icha")
        </a>
    </li>
</ul>

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

    <div class="row">
        @foreach ($listRekomendasi as $item)
            <div class="col-md-4">
                <div class="portlet">
                    <div class="portlet-body">
                        <img src="{{ URL::asset('images/hotel-img.jpeg') }}" alt="Image Hotel"
                            style="display: block; margin: 0 auto;">
                        <p style="margin-top: 10px">
                        <h4>
                            <strong>
                                Hotel {{ $item->nama }}
                            </strong>
                        </h4>
                        {{ $item->alamat }}
                        <br>
                        {{ $item->nomor_telepon }}
                        <br>
                        {{ $item->email }}
                        </p>
                        <a href="{{ url('/rekomendasi-hotel/' . $item->id . '/show-produk') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus" style="margin-right: 5px;"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <div id="modal-content-data">

                </div>
            </div>
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
    <script type="text/javascript">
        new DataTable('#example');

        function tambahProduk(idProduk) {
            $.ajax({
                url: "{{ url('/rekomendasi-hotel') }}" + "/" + idProduk + "/produk",
                type: "GET",
                success: function(response) {
                    $("#modal-content-data").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
