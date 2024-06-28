@extends('layout.conquer2')
@section('eleanor')
<form method="POST" action="{{ route('tipe.store') }}">
  @csrf
    <div class="form-group">
      <label for="tipeInput">Nama Tipe</label>
      <input name="namaTipe" type="text" class="form-control" id="inputTipe" aria-describedby="tipelHelp" placeholder="Enter tipe">
      <small id="tipeHelp" class="form-text text-muted">We'll never share your tipe with anyone else.</small>
    </div>
    
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection