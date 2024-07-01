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
                                <td style="width: 50%">Total Bayar</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    Rp. {{ number_format($detail['total_bayar']) }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Kembali</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    Rp. {{ number_format($detail['kembalian']) }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Tanggal</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detail->tanggal)->translatedFormat('d F Y - H:i:s'); }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Gunakan Point?</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    {{ $detail->use_reedem == "0" ? "TIDAK" : "YA" }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Point</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    {{ $detail->point }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Pajak</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    Rp. {{ number_format($detail['pajak']) }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 50%">Status</td>
                                <td style="width: 10%">:</td>
                                <td>
                                    SELESAI
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
                        <th>Hotel</th>
                        <th>Produk</th>
                        <th style="text-align: center">Tipe</th>
                        <th style="text-align: center">QTY</th>
                        <th style="text-align: center">Harga</th>
                        <th style="text-align: center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($detailTransaksi as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->produks->hotel->nama }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td style="text-align: center">{{ $item->tipe_produk }}</td>
                            <td style="text-align: center">{{ $item->qty }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item['harga']) }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item->qty * $item->harga) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ url('/riwayat-transaksi-saya/' . $detail->id . '/pdf') }}" class="btn btn-danger btn-sm btn-block" style="font-weight: bold; text-transform: uppercase">
        Download Nota Pembelian
    </a>
@endsection

@section('javascript')

    <script src="{{ URL::asset('datatables/javascript/datatables.js') }}"></script>
    <script src="{{ URL::asset('datatables/javascript/datatables.bootstrap.js') }}"></script>
    <script type="text/javascript">
        new DataTable('#example');
    </script>

@endsection
