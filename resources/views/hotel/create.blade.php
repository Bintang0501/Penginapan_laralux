@extends('layout.conquer2')
@section('eleanor')
<form method="POST" action="{{ route('hotel.store') }}">
  @csrf
    <div class="form-group">
      <label for="tipeInput">Nama Hotel</label>
      <input name="namaHotel" type="text" class="form-control" id="inputHotel" aria-describedby="tipelHelp" placeholder="Enter Nama Hotel">
      
    </div>
    <div class="form-group">
      <label for="tipeInput">Address Hotel</label>
      <input name="address" type="text" class="form-control" id="inputHotel" aria-describedby="tipelHelp" placeholder="Enter Alamat Hotel">
      
    </div>

    <div class="form-group">
      <label for="tipeInput">City Hotel</label>
      <input name="city" type="text" class="form-control" id="inputHotel" aria-describedby="tipelHelp" placeholder="Enter Kota Hotel">
      
    </div>


    <div class="form-group">
      <label class="col-md-3 control-label">Dropdown</label>
      <div class="col-md-9">
        <select class="form-control" name="type">
          @foreach ($tipes as $t)
            <option value="{{$t->id}}">{{ $t->name}} </option>  
          @endforeach
          
         
        </select>
      </div>
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection