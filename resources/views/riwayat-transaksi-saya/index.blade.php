@extends('layout.conquer2')

@section('icha', 'Riwayat Transaksi Saya')

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

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-book" style="margin-right: 5px"></i> Data @yield('icha')
            </div>
        </div>
        <div class="portlet-body">

            <table class="table table-bordered" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama User</th>
                        <th style="text-align: center">Total Beli</th>
                        <th style="text-align: center">Pajak</th>
                        <th style="text-align: center">Total Bayar</th>
                        <th style="text-align: center">Kembali</th>
                        <th style="text-align: center">Gunakan Reedem</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($transaksi as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->nama_users }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item->total_beli) }} </td>
                            <td style="text-align: center">Rp. {{ number_format($item->pajak) }} </td>
                            <td style="text-align: center">Rp. {{ number_format($item->total_bayar) }} </td>
                            <td style="text-align: center">Rp. {{ number_format($item->kembalian) }} </td>
                            <td style="text-align: center">
                                @if ($item->use_reedem == "1")
                                    <span class="badge badge-success">
                                        Ya
                                    </span>
                                    -
                                    <strong>
                                        {{ $item->point }} Point
                                    </strong>
                                @else
                                <span class="badge badge-danger">
                                    Tidak
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/riwayat-transaksi-saya/' . $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i> Detail
                                </a>
                                <a href="{{ url('/riwayat-transaksi-saya/'. $item->id . "/pdf" ) }}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fa fa-file-pdf-o"></i> Download PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{ URL::asset('datatables/javascript/datatables.js') }}"></script>
    <script src="{{ URL::asset('datatables/javascript/datatables.bootstrap.js') }}"></script>
    <script type="text/javascript">
        new DataTable('#example');
    </script>
@endsection
