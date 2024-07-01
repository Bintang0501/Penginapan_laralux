@extends('layout.conquer2')

@section('icha', 'Dashboard')

@section("breadcrumb")

<ul class="page-breadcrumb">
    <li>
        <a href="#">
            <i class="icon-home"></i> Dashboard
        </a>
    </li>
</ul>

@endsection

@section('eleanor')

    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Gagal</strong>, {!! session('error') !!}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            <strong>Berhasil</strong>, {!! session('success') !!}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-body">
                    <strong>Selamat Datang</strong>,
                    di Website Nginep. Silahkan Pilih Menu Untuk Memulai Program.
                </div>
            </div>
        </div>
    </div>

@endsection
