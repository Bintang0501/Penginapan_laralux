@extends('layout.conquer2')

@section('icha', 'Hotel')

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
                <i class="fa fa-bars" style="margin-right: 5px"></i> Data @yield('icha')
            </div>
        </div>
        <div class="portlet-body">
            @if (Auth::user()->role == "STAFF")

            @else
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus" style="margin-right: 5px;"></i> Tambah Data
            </button>
            <hr>
            @endif

            <table class="table table-bordered" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Tipe Hotel</th>
                        <th>Nama Hotel</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($hotel as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->tipe_hotel->nama }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>{{ $item->email }}</td>
                            <td style="text-align: center">
                                <button onclick="editData(`{{ $item['id'] }}`)" type="button"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                    <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                </button>
                                @if (Auth::user()->role == "STAFF")

                                @else
                                <form action="{{ url('/hotel/' . $item['id']) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Apakah Anda Yakin? Ingin Menghapus Data Ini?')"
                                        type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times" style="margin-right: 5px;"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tambah Data -->
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
                <form action="{{ url('/hotel') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"> Tipe Hotel </label>
                            <select class="form-control" name="tipe_hotel_id" id="tipe_hotel_id" required value="{{ old('tipe_hotel_id') }}">
                                <option selected>~~ PILIH TIPE HOTEL ~~</option>
                                @foreach ($tipe_hotel as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name"> Nama Hotel </label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Masukkan Nama Hotel" required value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat"> Alamat </label>
                            <textarea class="form-control" name="alamat" placeholder="Masukkan alamat hotel" id="alamat" required value="{{ old('nama') }}">

                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon"> Nomor Telepon </label>
                            <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon"
                                placeholder="Masukkan nomor telepon" required value="{{ old('nomor_telepon') }}">
                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Masukkan email" required value="{{ old('email') }}">
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
    </div>
    <!-- End -->

    <!-- Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    <!-- End -->

@endsection

@section('javascript')

    <script src="{{ URL::asset('datatables/javascript/datatables.js') }}"></script>
    <script src="{{ URL::asset('datatables/javascript/datatables.bootstrap.js') }}"></script>
    <script type="text/javascript">
        new DataTable('#example');

        function editData(idHotel) {
            $.ajax({
                url: "{{ url('/hotel') }}" + "/" + idHotel + "/edit",
                type: "GET",
                success: function(response) {
                    $("#modal-content-edit").html(response)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
