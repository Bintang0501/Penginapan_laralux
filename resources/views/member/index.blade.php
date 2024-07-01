@extends('layout.conquer2')

@section('icha', 'Member')

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
                <i class="fa fa-user" style="margin-right: 5px"></i> Data @yield('icha')
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
                        <th style="text-align: center">No. KTP</th>
                        <th style="text-align: left">Nama</th>
                        <th style="text-align: left">Email</th>
                        <th style="text-align: center">Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($member as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td style="text-align: center">{{ $item->no_ktp }}</td>
                            <td>{{ $item->users->name }}</td>
                            <td>{{ $item->users->email }}</td>
                            <td style="text-align: center">
                                @if ($item->jenis_kelamin == "Laki - Laki")
                                    Laki - Laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td style="text-align: center">
                                <button onclick="editData(`{{ $item['id'] }}`)" type="button"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                    <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                </button>
                                @if (Auth::user()->role == "STAFF")

                                @else
                                <form action="{{ url('/member/' . $item['id']) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Apakah Anda Yakin? Ingin Menghapus Data Ini?')"
                                        type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o" style="margin-right: 5px;"></i> Hapus
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
                <form action="{{ url('/member') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_ktp" class="form-label"> No. KTP </label>
                            <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan Nomer KTP">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label"> Nama </label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" required value="{{ old('nama') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label"> Jenis Kelamin </label>
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                        <option value="">- Pilih -</option>
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label"> Email </label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-label"> Alamat </label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="5" required placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
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

        function editData(idtipeHotel) {
            $.ajax({
                url: "{{ url('/member') }}" + "/" + idtipeHotel + "/edit",
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
