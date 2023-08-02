@extends('layouts.master')

@push('css')
@endpush

@section('title', 'About')
@section('subtitle', 'Tentang Aplikasi Perpustakaan')

@section('breadcrumb')
    <li class="breadcrumb-item">About</li>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tentang Aplikasi</h4>
            </div>
            <div class="card-body">
                <p>
                    Aplikasi ini merupakan sebuah sistem perpustakaan yang dibangun untuk memudahkan pengelolaan dan
                    pelayanan di perpustakaan. Dengan aplikasi ini, Anda dapat melakukan berbagai kegiatan seperti
                    meminjam dan mengembalikan buku, melihat riwayat peminjaman, dan lain sebagainya.
                </p>
                <p>
                    Aplikasi ini juga dilengkapi dengan fitur untuk mengelola data buku, data anggota, serta data kategori
                    buku. Selain itu, Anda dapat melihat laporan-laporan terkait aktivitas di perpustakaan melalui dashboard
                    yang disediakan.
                </p>
                <p>
                    Kami berharap aplikasi ini dapat memberikan manfaat dan kemudahan bagi pengguna dalam mengelola perpustakaan
                    secara efisien dan efektif. Terima kasih telah menggunakan aplikasi perpustakaan ini.
                </p>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
@endpush
