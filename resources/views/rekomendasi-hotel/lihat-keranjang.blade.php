@extends('layout.conquer2')

@section('icha', 'Keranjang Saya')

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
        <a href="{{ url('/rekomendasi-hotel') }}">
            Daftar Hotel
        </a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{ url('/dashboard') }}">
            Produk
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
        <div class="col-md-6">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        Data Keranjang
                    </div>
                </div>
                <div class="portlet-body">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%">Total Reservasi</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    Rp. {{ number_format($keranjang['total']) }} <strong>(Belum Pajak)</strong>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Status</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    {{ $keranjang['status'] == '1' ? 'PENDING' : 'SELESAI' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit" style="margin-right: 5px"></i> Detail Produk
            </div>
        </div>
        <div class="portlet-body">
            <table class="table table-bordered" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Produk</th>
                        <th style="text-align: center">QTY</th>
                        <th style="text-align: center">Tipe</th>
                        <th style="text-align: center">Harga</th>
                        <th style="text-align: center">Total</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($keranjangDetail as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->produk->nama }}</td>
                            <td style="text-align: center">{{ $item->qty }}</td>
                            <td style="text-align: center">{{ $item->produk->tipe_produk->nama }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item['harga']) }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item->qty * $item->harga) }}</td>
                            <td style="text-align: center">
                                <button onclick="editData(`{{ $item['id'] }}`)" type="button"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                </button>
                                <form style="display: inline"
                                    action="{{ url('/rekomendasi-hotel/' . $item->id . '/hapus-keranjang-detail') }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Apakah Anda Yakin ? Untuk Menghapus Data Ini ?')"
                                        type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <button onclick="bayarSekarang()" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
        data-target="#bayarSekarang">
        <i class="fa fa-money"></i> Bayar Sekarang
    </button>

    <div class="modal fade" id="bayarSekarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-money"></i> Bayar
                    </h4>
                </div>
                <div id="modal-data-bayar"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    </div>

@endsection

@section('javascript')

    <script src="{{ URL::asset('datatables/javascript/datatables.js') }}"></script>
    <script src="{{ URL::asset('datatables/javascript/datatables.bootstrap.js') }}"></script>
    <script type="text/javascript">
        new DataTable('#example');
        function editData(idKeranjangDetail) {
            $.ajax({
                url: "{{ url('/rekomendasi-hotel') }}" + "/" + idKeranjangDetail + "/edit-data",
                type: "GET",
                success: function(response) {
                    $("#modal-content-edit").html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        function bayarSekarang() {
            $.ajax({
                url: "{{ url('/rekomendasi-hotel/bayar-sekarang') }}",
                type: "GET",
                success: function(response) {
                    $("#modal-data-bayar").html(response);

                    document.getElementById("reedemPoint").addEventListener("change", function() {
                        let pointDiv = document.getElementById("viewpoint");
                        let bayarDiv = document.getElementById("viewbayar");

                        if (this.value === "ya") {
                            pointDiv.style.display = "block";
                            bayarDiv.style.display = "none";
                        } else {
                            pointDiv.style.display = "none";
                            bayarDiv.style.display = "block";
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
    </script>
@endsection
