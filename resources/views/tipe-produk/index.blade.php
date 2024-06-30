@extends('layout.conquer2')

@section('icha', 'Tipe Produk')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('datatables/css/datatables.bootstrap.css') }}">
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
                        <th>Nama</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($tipeProduk as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->nama }}</td>
                            <td style="text-align: center">
                                <button onclick="editData(`{{ $item['id'] }}`)" type="button"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                    <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                </button>
                                @if (Auth::user()->role == "STAFF")
                                    
                                @else
                                <form action="{{ url('/tipe-produk/' . $item['id']) }}" method="POST"
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
                <form action="{{ url('/tipe-produk') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama"> Tipe Produk </label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Masukkan Tipe Produk" required value="{{ old('nama') }}">
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

        function editData(idTipeProduk) {
            $.ajax({
                url: "{{ url('/tipe-produk') }}" + "/" + idTipeProduk + "/edit",
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
