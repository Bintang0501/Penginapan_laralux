@extends('layout.conquer2')

@section('icha', 'Produk')

@section("breadcrumb")

<ul class="page-breadcrumb">
    <li>
        <a href="{{ url('/dashboard') }}">
            <i class="icon-home"></i> Dashboard
        </a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{ url('/rekomendasi-hotel') }}">
            Daftar Hotel
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

    @if (!empty($keranjang))
    <div class="alert alert-success">
        Anda Memiliki <strong>{{ $count }}</strong> Keranjang Belanja. Lihat <a href="{{ url('/rekomendasi-hotel/' . $keranjang["id"] . '/data/lihat-keranjang') }}" style="font-weight: bold">Detail Keranjang Anda.</a>
    </div>
    @endif

    <div class="row">
        @foreach ($produk as $item)
            <div class="col-md-4">
                <div class="portlet">
                    <div class="portlet-body" style="height: 70vh">
                        @if (empty($item->gambar))
                        <img src="{{ URL::asset('images/hotel-img.jpeg') }}" alt="Image Hotel"
                            style="display: block; margin: 0 auto;">
                        @else
                        <img src="{{ url('/storage/' . $item->gambar) }}" alt="Image Hotel"
                            style="display: block; margin: 0 auto;">
                        @endif
                        <p style="margin-top: 10px">
                        <h4>
                            <strong>
                                {{ $item->nama }}
                            </strong>
                        </h4>
                        Rp. {{ number_format($item->harga) }}
                        <br>
                        {{ $item->deskripsi }}
                        <br>
                        Tipe : {{ $item->tipe_produk->nama }}
                        <br>
                        Fasilitas :
                        <br>
                        @foreach ($item->fasilitas as $fasilitas)
                        <span class="badge bg-danger" style="font-weight: bold">
                            {{ $fasilitas->nama_fasilitas }}
                        </span>
                        @endforeach
                        </p>
                        <hr>
                        <button onclick="reservasi(`{{ $item->id }}`)" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus" style="margin-right: 5px;"></i> Reservasi
                        </button>
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
                        <i class="fa fa-plus"></i> Buat Reservasi
                    </h4>
                </div>
                <div id="modal-content-data">
                    <!-- Form -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section("javascript")

    <script type="text/javascript">
        function reservasi(id)
        {
            $.ajax({
                url: "{{ url('/rekomendasi-hotel') }}" + "/" + id + "/create-reservasi",
                method: "GET",
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
