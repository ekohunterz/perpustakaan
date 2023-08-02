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
                                        Jumlah Member
                                    </h6>
                                    <h6 class="font-extrabold mb-0">{{ $jml_member }}</h6>
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
                                    <h6 class="text-muted font-semibold">Jumlah Buku</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jml_buku }}</h6>
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
                                    <h6 class="text-muted font-semibold">Jumlah Kelas</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jml_kelas }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengunjung Perpustakaan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Aktivitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latest_pinjam as $pinjam)
                                            <tr>
                                                <td class="col-auto">{{ $pinjam->status == 'Pinjam' ? date('d F Y', strtotime($pinjam->tgl_pinjam)) : date('d F Y', strtotime($pinjam->tgl_kembali)) }}</td>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ $pinjam->member->user->foto ? asset('storage/foto/' . $pinjam->member->user->foto . '') : asset('img/jpg/1.jpg') }}" />
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">{{ $pinjam->member->user->name }}</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class="mb-0">
                                                        {{ $pinjam->status == 'Pinjam' ? 'Meminjam buku ' . $pinjam->buku->nama_buku . '' : 'Mengembalikan buku ' . $pinjam->buku->nama_buku . '' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4>Member Baru</h4>
                </div>
                <div class="card-content pb-4">
                    @foreach ($latest_member as $member)
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="{{ $member->user->foto ? asset('storage/foto/' . $member->user->foto . '') : asset('img/jpg/1.jpg') }}" />
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1 text-capitalize">{{ $member->user->name }}</h5>
                                <h6 class="text-muted mb-0">{{ $member->nis }}</h6>
                            </div>
                        </div>
                    @endforeach
                    @can('read')
                        <div class="px-4">
                            <a class="btn btn-block btn-xl btn-outline-primary font-bold mt-3" href="{{ route('member.index') }}">
                                Lihat Semua Member
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Presentase Pengunjung</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                    <div class="px-4">
                        <a class="btn btn-block btn-outline-primary font-bold mt-3" href="{{ route('member.index') }}">
                            Laporan Pengunjung
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var optionsVisit = {
            annotations: {
                position: "back",
            },
            dataLabels: {
                enabled: false,
            },
            chart: {
                type: "bar",
                height: 300,
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {},
            series: [{
                name: "Pengunjung",
                data: {!! json_encode($bulananValues) !!},
            }, ],
            colors: "#435ebe",
            xaxis: {
                categories: {!! json_encode($bulananLabels) !!},
            },
        }

        let optionsVisitorsProfile = {
            series: [{{ $persentaseBaca }}, {{ $persentasePinjam }}, {{ $persentaseLainnya }}],
            labels: ["Baca Buku", "Pinjam Buku", "Lainnya"],
            colors: ["#435ebe", "#55c6e8", "#55c638"],
            chart: {
                type: "donut",
                width: "100%",
                height: "350px",
            },
            legend: {
                position: "bottom",
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "30%",
                    },
                },
            },
        };

        var chartVisit = new ApexCharts(
            document.querySelector("#chart-visit"),
            optionsVisit
        );

        var chartVisitorsProfile = new ApexCharts(
            document.getElementById("chart-visitors-profile"),
            optionsVisitorsProfile
        );

        chartVisit.render();
        chartVisitorsProfile.render();
    </script>
@endpush
