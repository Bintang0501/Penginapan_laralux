@extends('layout.conquer2')

@section('icha', 'Users')

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
                <i class="fa fa-users" style="margin-right: 5px"></i> Data @yield("icha")
            </div>
        </div>
        <div class="portlet-body">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus" style="margin-right: 5px;"></i> Tambah Data
            </button>

            <hr>

            <table class="table table-bordered" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="text-align: center">Akses</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($users as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td style="text-align: center">
                                @if ($item->role == 'OWNER')
                                    OWNER
                                @elseif($item->role == 'STAFF')
                                    STAFF
                                @elseif($item->role == 'PEMBELI')
                                    PEMBELI
                                @endif
                            </td>
                            <td style="text-align: center">
                                <button onclick="editData(`{{ $item['id'] }}`)" type="button"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                    <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                </button>
                                @if ($item->role == "PEMBELI")
                                <form action="{{ url('/users/' . $item['id']) }}" method="POST" style="display: inline">
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
                <form action="{{ url('/users') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"> Nama </label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Masukkan Nama Users" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Masukkan Email Users" required value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="role"> Akses </label>
                            <select name="role" class="form-control" id="role">
                                <option value="">- Pilih -</option>
                                <option value="OWNER">OWNER</option>
                                <option value="STAFF">STAFF</option>
                            </select>
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

        function editData(idUsers) {
            $.ajax({
                url: "{{ url('/users') }}" + "/" + idUsers + "/edit",
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
