@php
    $setting = DB::table('settings')->first();
@endphp
@extends('home.master')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4 mt-5">
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="{{ $setting->logo ? asset('storage/logos/' . $setting->logo) : asset('assets/static/images/logo/logo.svg') }}" style="max-width: 100px">
                            <h5 class="mt-3">Selamat Datang di Perpustakaan {{ $setting->nama_sekolah }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input class="form-control form-control-xl" name="email" type="email" value="{{ old('email') }}" placeholder="Email" />
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input class="form-control form-control-xl" name="password" type="password" required autocomplete="current-password" placeholder="Password" />
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-check form-check-lg d-flex align-items-end">
                                <input class="form-check-input me-2" id="flexCheckDefault" name="remember" type="checkbox" value="" />
                                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" type="submit">Login</button>
                            <div class="text-center mt-3 text-sm ">
                                <p class="text-muted">
                                    Tidak punya akun?
                                    <a class="font-bold" href="{{ route('register') }}">Daftar</a>.
                                </p>
                                @if (Route::has('password.request'))
                                    <p>
                                        <a class="font-bold" href="{{ route('password.request') }}">Lupa Password?</a>.
                                    </p>
                                @endif
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
