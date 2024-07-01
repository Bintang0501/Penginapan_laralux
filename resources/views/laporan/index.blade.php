@extends('layout.conquer2')

@section('icha', 'Laporan Transaksi')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('datatables/css/datatables.bootstrap.css') }}">

    <style>
        .hidden {
            visibility: hidden;
            height: 0;
            overflow: hidden;
        }
        .visible {
            visibility: visible;
            height: auto;
        }
    </style>
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
    @elseif($errors->has('error_input'))
        <div class="alert alert-danger">
            <strong>Gagal,</strong> {{ $errors->first('error_input') }}
        </div>
    @endif

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                @if (session("filter") == "pelangganMembershipTerbanyak")
                    <i class="fa fa-book" style="margin-right: 5px"></i>
                    Data Membership Pelanggan Terbanyak
                @endif
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <form action="{{ url('/laporan/filter') }}" method="POST">
                <div class="col-md-6">
                        @csrf
                        <div class="form-group">
                            <label for="filter" class="form-label"> Filter </label>
                            <select name="filter" class="form-control" id="filter">
                                <option value="">- Pilih -</option>
                                <option value="keseluruhan" {{ session('filter') == "keseluruhan" ? 'selected' : '' }} >Semua Transaksi</option>
                                <option value="hotelReservasi" {{ session("filter") == "hotelReservasi" ? 'selected' : '' }} >3 Produk Hotel Yang Paling Banyak Direservasi</option>
                                <option value="pelangganPembelianTerbanyak" {{ session("filter") == "pelangganPembelianTerbanyak" ? 'selected' : '' }} >Pelanggan Dengan Total Pembelian Terbanyak</option>
                                <option value="pelangganMembershipTerbanyak" {{ session("filter") == "pelangganMembershipTerbanyak" ? 'selected' : '' }} >Pelanggan Dengan Point Membership Terbanyak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top: 25px">
                        @if (!empty(session("filter")))
                        <a href="{{ url('/laporan/hapus-filter') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-times"></i> Hapus Filter
                        </a>
                        @endif
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-search"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Keseluruhan Transaksi -->
            @if (session("filter") == "keseluruhan" || empty(session("filter")) )
            <table class="table table-bordered {{ session('filter') == 'keseluruhan' || empty(session('filter')) ? 'visible' : 'hidden' }}" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="text-align: center">Total Beli</th>
                        <th style="text-align: center">Pajak</th>
                        <th style="text-align: center">Total Bayar</th>
                        <th style="text-align: center">Tanggal</th>
                        <th style="text-align: center">Gunakan Reedem?</th>
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
                            <td>{{ $item->email_users }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item->total_beli) }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item->pajak) }} </td>
                            <td style="text-align: center">Rp. {{ number_format($item->total_bayar) }} </td>
                            <td style="text-align: center">{{ $item->tanggal }}</td>
                            <td style="text-align: center">
                                @if ($item->use_reedem == "1")
                                    <span class="badge badge-success">
                                        Ya
                                    </span>
                                @elseif($item->use_reedem == "0")
                                <span class="badge badge-danger">
                                    Tidak
                                </span>
                                @endif
                            </td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa fa-search"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <!-- END -->

            <!-- Hotel Reservasi -->
            @if (session("filter") == "hotelReservasi")
            <table class="table table-bordered {{ session('filter') == 'hotelReservasi' ? 'visible' : 'hidden' }}" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th style="text-align: center">Nomor Telepon</th>
                        <th>Email</th>
                        <th style="text-align: center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach (session("data") as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td style="text-align: center">{{ $item->nomor_telepon }}</td>
                            <td>{{ $item->email }}</td>
                            <td style="text-align: center">{{ $item->transaksi_detail_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <!-- End -->

            <!-- Pelanggan Dengan Total Pembelian Terbanyak -->
            @if (session("filter") == "pelangganPembelianTerbanyak")
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="text-align: center">Total Beli</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach (session("data") as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item['nama_users'] }}</td>
                            <td>{{ $item['email_users'] }}</td>
                            <td class="text-center">Rp. {{ number_format($item->total_beli) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <!-- End -->

            <!-- Membership Terbanyak -->
            @if (session("filter") == "pelangganMembershipTerbanyak")
            <table style="width: 100%;" class="table table-bordered {{ session('filter') == 'pelangganMembershipTerbanyak' ? 'visible' : 'hidden' }}" id="example-membership">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="text-align: center">Jumlah Point</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach (session("data") as $item)
                    <tr>
                        <td style="text-align: center">{{ ++$nomer }}.</td>
                        <td style="text-align: center">{{ $item['users']['name'] }}</td>
                        <td>{{ $item['users']['email'] }}</td>
                        <td style="text-align: center">{{ $item["point"] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <!-- End -->
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ URL::asset('datatables/javascript/datatables.js') }}"></script>
    <script src="{{ URL::asset('datatables/javascript/datatables.bootstrap.js') }}"></script>
    <script type="text/javascript">


        let filter = "{{ session('filter') }}"

        if (filter == "pelangganMembershipTerbanyak") {
            new DataTable('#example-membership');
        } else {
            new DataTable('#example');
        }
        // new DataTable('#example-hotel');
    </script>
@endsection
