@php
    $setting = DB::table('settings')->first();
@endphp
@extends('home.master')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">

            <div class="col-6 mt-5">
                <div class="text-center"><img src="{{ $setting->logo ? asset('storage/logos/' . $setting->logo) : asset('assets/static/images/logo/logo.svg') }}" style="max-width: 300px"></div>
                <h1 class="text-center mt-3">Selamat Datang di Perpustakaan {{ $setting->nama_sekolah }}</h1>
                <div class="col text-center mt-3">
                    <a class="btn btn-primary" href="{{ route('pengunjung.index') }}">Isi Data Pengunjung</a>
                    @guest
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
