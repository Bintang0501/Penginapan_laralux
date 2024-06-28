@extends('layout.conquer2')
@section('eleanor')

<a class="btn btn-danger"  href="{{route('hotel.create')}}">Add Hotel</a>
<a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer</a>

@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Tipe</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataku as $hotel)
            <tr>
                <td>{{ $hotel->name }}</td>
                <td>{{ $hotel->address }}</td>
                <td>{{ $hotel->city }}</td>
                <td>{{ $hotel->type }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route ('hotel.edit',$hotel->id)}}">Edit</a>

                    <form method="POST" action="{{route('hotel.destroy',$hotel->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit"
                            onclick="return confirm('Are you want to delete this?')"
                            value="Delete" class="btn btn-danger" />
                    </form>


                    <a class="btn btn-success" data-toggle="modal" href="#lihat-{{ $hotel->id }}">Lihat</a>
                    <div class="modal fade" id="lihat-{{ $hotel->id }}" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Lihat Hotel</h4>
                                </div>
                                <div class="modal-body">
                                <img src="{{ asset(env('PATH_GAMBAR_HOTEL').$hotel->id.'.jpg') }}" style="width: 500px"/>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="coba">
                        keluar loading animasi
                    </div>
                    <a class="btn btn-success tombol-produk" data-toggle="modal" href="#" data-id="{{ $hotel->id }}">Produk</a>
                </td>
            </tr>
            {{-- @if ($hotel->products)
                @foreach($hotel->products as $product)
                    <tr>
                        <td colspan="3">{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                @endforeach
            @endif --}}
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">DISCLAIMER</h4>
            </div>
            <div class="modal-body">
            Pictures shown are for illustration purpose only. Actual product may vary due to product enhancement.
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
</div>

<div class="modal fade" id="lihat-produk" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Lihat Produk</h4>
            </div>
            <div class="modal-body" id="data-produk">
            <!-- ini nanti berisi datanya yg dinamis -->
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
</div>
@endsection
@section('budi', 'Daftar Hotel')
@section('icha', 'Halaman Daftar Hotel')
@section('javascript')
<script>
$('.tombol-produk').click(function() {
    var idHotel = $(this).attr('data-id');
    //tampilkan gambar gif animated di elementnya misal coba
    //alert('masuk gaes, id hotel = ' + idHotel);
    $.ajax({
        type:'GET',
        url:'{{ url('/tampil-produk/') }}/'+idHotel,
        success: function(data){

            $('.coba').html(data.msg);
        }
    });

})
</script>
@endsection
