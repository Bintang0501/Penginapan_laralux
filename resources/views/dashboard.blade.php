@extends('layout.conquer2')
@section('eleanor')

    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Gagal</strong>, {!! session('error') !!}
        </div>
    @endif
    ini page Hotel
    Ada
    {{ Auth::user()->name }}
@endsection
@section('budi', 'Hoi ini judulku....gaess....')
@section('icha', 'Ini halaman coba-coba hotel')
