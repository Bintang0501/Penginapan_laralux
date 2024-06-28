@extends('layout.conquer2')

@section("icha", "Tipe Produk")

@section('eleanor')
<a class="btn btn-warning"  href="{{route('tipe.create')}}">Add Tipe</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Create At</th>
            <th>Update At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataku as $d)
            <tr>
                <td>{{ $d->name }}</td>
                <td>{{ $d->created_at }}</td>
                <td>{{ $d->updated_at }}</td>
                <td><a href="{{route ('tipe.edit',$d->id)}}" class="btn btn-success">Edit</a>
                @can('delete-permission',Auth::user())

                <form method="POST" action="{{route('tipe.destroy',$d->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit"
                        onclick="return confirm('Are you want to delete this?')"
                        value="Delete" class="btn btn-danger" />
                </form>
                @endcan

                </td>

            </tr>

        @endforeach
    </tbody>
</table>

@endsection
@section('budi', 'Daftar Tipe')
@section('javascript')
<script>
</script>
@endsection
