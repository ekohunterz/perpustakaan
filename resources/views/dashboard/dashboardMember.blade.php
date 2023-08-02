TES
@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/compiled/css/iconly.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Dashboard')
@section('subtitle', 'Selamat Datang, ' . Auth::user()->name)

@section('breadcrumb')

@endsection

@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">
                                        Kode Member
                                    </h6>
                                    <h6 class="font-extrabold mb-0">{{ Auth::user()->member->kode_member }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldTicket"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Buku Dipinjam</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jml_pinjam }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldDocument"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Pinjam</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_pinjam }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldHome"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Kunjungan</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jml_kunjungan }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Buku Sedang Dipinjam</h4>
                        </div>
                        <div class="card-body">
                            @if ($latest_pinjam->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Buku</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Batas Tanggal Kembali</th>
                                                <th>Kondisi Buku</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latest_pinjam as $pinjam)
                                                <tr>
                                                    <td class="col-auto">{{ $loop->iteration }}</td>
                                                    <td class="col-auto">{{ $pinjam->buku->nama_buku }}</td>
                                                    <td class="col-3">{{ date('d F Y', strtotime($pinjam->tgl_pinjam)) }}</td>
                                                    <td class="col-auto">{{ date('d F Y', strtotime($pinjam->tgl_kembali)) }}</td>
                                                    <td class="col-auto">{{ $pinjam->kondisi_buku }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center text-muted">Tidak Ada Buku Yang Sedang Dipinjam</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4>Riwayat Kunjungan</h4>
                </div>
                <div class="card-body">
                    @if (count($riwayat_kunjungan) > 0)
                        @foreach ($riwayat_kunjungan as $kunjungan)
                            <div class="recent-message d-flex px-4 py-1">
                                <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                    <span class="text-light font-bold   ">{{ $loop->iteration }}</span>
                                </div>
                                <div class="name ms-4">
                                    <h6 class="mb-1">{{ date('d F Y', strtotime($kunjungan->created_at)) }}</h6>
                                    <p class="text-muted mb-0">{{ $kunjungan->keperluan }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <p>Tidak ada riwayat kunjungan.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
