@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Peminjaman Buku')
@section('subtitle', '')

@section('breadcrumb')

@endsection

@section('content')
    @php
        $setting = DB::table('settings')->first();
    @endphp
    <section class="section">
        <div class="alert alert-success alert-dismissible fade show">
            <h4 class="alert-heading">Catatan Perihal Peminjaman Buku</h4>
            <p>Beberapa hal yang dapat di sampaikan kepada siswa mengenai peraturan dalam peminjaman buku
                di perpustakaan {{ $setting->nama_sekolah }}.</p>
            <hr>
            <ul class="list">
                <li><span>Siswa Di Wajibkan Mendaftarkan diri sebagai Anggota Perpustakaan Untuk Bisa
                        Melaukan Peminjaman Buku</span></li>
                <li><span>Tarif Denda Jika Terlambat Mengembalikan Buku Yaitu Rp.{{ $setting->denda_terlambat }} / Hari</span></li>
                <li><span>Apabila Buku Rusak Maka Siswa Diberlakukan denda Rp.{{ $setting->denda_rusak }} / Buku</span></li>
                <li><span>Apabila Buku Hilang Maka Siswa Diberlakukan denda Rp.{{ $setting->denda_hilang }} / Buku</span></li>
            </ul>
            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col-md-6 mb-1">
                    <form id="cari" action="">
                        <div class="input-group">
                            <input class="form-control" id="kode_member" name="kode_member" type="text" aria-label="Scan QR Code/Masukan Kode Member" aria-describedby="button-addon2" placeholder="Scan QR Code/Masukan Kode Member" />
                            <button class="btn btn-outline-secondary" id="button-addon2" type="submit">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="member-container">
        </div>

    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/davidshimjs-qrcodejs/qrcode.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#cari").on("submit", function(e) {
                e.preventDefault();
                $("#member-container").hide();

                // Mendapatkan nilai kode member dari input field
                const kodeMember = $('#kode_member').val();

                // Mengecek apakah kode member tidak kosong
                if (kodeMember !== '') {
                    // Mengirim permintaan Ajax ke endpoint server untuk mendapatkan data member
                    $.ajax({
                        url: '/get-member',
                        type: 'GET',
                        data: {
                            kode_member: kodeMember
                        },
                        success: function(res) {
                            // Menampilkan data member di halaman
                            $("#member-container").html(res);
                            $("#member-container").show();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Data Member Tidak Ditemukan", "error");
                        }
                    });
                }
            });
        });
    </script>
@endpush
