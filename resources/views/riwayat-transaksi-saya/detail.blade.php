@extends('layout.conquer2')

@section('icha', 'Detail Transaksi')

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
                {{-- <tbody>
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
                                <a href="{{ url('/riwayat-transaksi-saya/' . $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>
@endsection
