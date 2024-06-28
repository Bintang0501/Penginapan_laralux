@extends('layout.conquer2')
@section('eleanor')
<a class="btn btn-warning" data-toggle="modal" href="#disclaimer">Disclaimer</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Karyawan</th>
            <th>Tanggal Pemesanan</th>
            <th>Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $t) 
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->customer->name }}</td>
                <td>{{ $t->user->name }}</td>
                <td>{{ $t->transaction_date }}</td>
                <td><a data-toggle="modal" href="#disclaimer_{{$t->id}}" class="btn btn-danger">Detail</a></td>
                <div class="modal fade" id="disclaimer_{{$t->id}}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">DISCLAIMER</h4>
                            </div>
                            <div class="modal-body">
                                 @foreach ($t->products as $p )
                              
                                     <p>Anda pesan  {{$p->pivot->quantity}} pcs <u>"{{$p->name}}" </u>
                                         dari Hotel <b>{{$p->hotel->name}} </b>
                                         dengan harga {{$p->price}}</p>
                                     <hr>
                                 @endforeach
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                </div>
            </tr>
          
        @endforeach
    </tbody>
</table>


@endsection
@section('budi', 'Daftar Transaksi')
@section('icha', 'Halaman Daftar Transaksi')
@section('javascript')
<script>
</script>
@endsection