@extends('layout.conquer2')

@section('icha', 'Produk')

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
    @elseif($errors->has('error_input'))
        <div class="alert alert-danger">
            <strong>Gagal,</strong> {{ $errors->first('error_input') }}
        </div>
    @endif

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-book" style="margin-right: 5px"></i> Data @yield('icha')
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
                        <th>Name</th>
                        <th>Hotel</th>
                        <th style="text-align: center">Tipe Produk</th>
                        <th style="text-align: center">Harga</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomer = 0;
                    @endphp
                    @foreach ($produk as $item)
                        <tr>
                            <td style="text-align: center">{{ ++$nomer }}.</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->hotel->nama }}</td>
                            <td style="text-align: center">{{ $item->tipe_produk->nama }}</td>
                            <td style="text-align: center">Rp. {{ number_format($item->harga) }} </td>
                            <td style="text-align: center">
                                <button onclick="editData(`{{ $item['id'] }}`)" type="button"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
                                    <i class="fa fa-edit" style="margin-right: 5px;"></i> Edit
                                </button>
                                @if (Auth::user()->role == "STAFF")
                                    
                                @else
                                <form action="{{ url('/produk/' . $item['id']) }}" method="POST" style="display: inline">
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
                <form action="{{ url('/produk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"> Nama Produk </label>
                            <input type="text" class="form-control" name="nama" id="name"
                                placeholder="Masukkan Name Produk" required value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="hotel_id"> Nama Hotel </label>
                            <select name="hotel_id" class="form-control" id="hotel_id" required>
                                <option value="">- Pilih -</option>
                                @foreach ($hotel as $item)
                                    <option value="{{ $item->id }}" {{ old('hotel_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipe_produk_id"> Tipe Produk </label>
                            <select name="tipe_produk_id" class="form-control" id="tipe_produk_id" required>
                                <option value="">- Pilih -</option>
                                @foreach ($tipeProduk as $item)
                                    <option value="{{ $item->id }}" {{ old('tipe_produk_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipe_produk_id'))
                                <span class="text-danger">{{ $errors->first('tipe_produk_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="harga"> Harga Produk </label>
                            <input type="number" class="form-control" name="harga" id="harga"
                                placeholder="Masukkan Harga Produk" min="1000" required value="{{ old('harga') }}">
                        </div>
                        <div class="form-group">
                            <label for="gambar"> Gambar </label>
                            <input type="file" class="form-control" name="gambar" id="gambar" required value="{{ old('gambar') }}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi"> Deskripsi </label>
                            <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi Produk" id="deskripsi" required value="{{ old('deskripsi') }}">

                            </textarea>
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

        function editData(idProduk) {
            $.ajax({
                url: "{{ url('/produk') }}" + "/" + idProduk + "/edit",
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
