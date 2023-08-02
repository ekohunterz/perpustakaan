@extends('home.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/compiled/css/auth.css') }}" rel="stylesheet" />
@endpush

@php
    $setting = DB::table('settings')->first();
    $kelas = DB::table('kelas')->get();
@endphp

@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo" style="margin-bottom: 30px;">
                    <a href="index.html"><img src="./assets/compiled/svg/logo.svg" alt="Logo" /></a>
                </div>
                <h3>Perpustakaan {{ $setting->nama_sekolah }}</h3>
                <p class="text-muted">
                    Silakan isi data pengunjung.
                </p>
                <form id="formAction" action="{{ route('pengunjung.store') }}" method="POST">
                    @csrf
                    <div class="row mb-2 form-group px-3">
                        <div class="form-check col-6">
                            <input class="form-check-input" id="nonMember" name="flexRadioDefault" type="radio" value="non-member" checked>
                            <label class="form-check-label" for="nonMember">
                                Non-member
                            </label>
                        </div>
                        <div class="form-check col-6">
                            <input class="form-check-input" id="member" name="flexRadioDefault" type="radio" value="member">
                            <label class="form-check-label" for="member">
                                Member
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="nama" type="text" placeholder="Nama" />
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" name="kelas">
                            <option value="" hidden>--Pilih Kelas--</option>
                            @foreach ($kelas as $kelas)
                                <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="nis" type="text" placeholder="NIS" />
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" name="keperluan">
                            <option value="" hidden>--Pilih Keperluan--</option>
                            <option value="Baca Buku">Baca Buku</option>
                            <option value="Pinjam Buku">Pinjam Buku</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                        Simpan
                    </button>
                </form>
                <div class="text-center mt-5 text-sm">
                    <p class="text-gray-600">
                        Ingin mendaftar member?
                        <a class="font-bold" href="{{ route('register') }}">Daftar Member</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-lg-block">
            <div class="p-5" id="auth-right">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pengunjung</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pe-4">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/horizontal-layout.js') }}"></script>
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            // Sembunyikan form Nama dan Kelas saat halaman dimuat
            hideNamaKelas();

            // Tambahkan event listener untuk radio button
            $('input[type="radio"][name="flexRadioDefault"]').on('change', function() {
                hideNamaKelas();
            });

            // Fungsi untuk menyembunyikan atau menampilkan form Nama dan Kelas berdasarkan pilihan radio button
            function hideNamaKelas() {
                const memberSelected = $('input[type="radio"][name="flexRadioDefault"]:checked').val() === 'member';

                if (memberSelected) {
                    // Jika pilihan Member dipilih, sembunyikan form Nama dan Kelas
                    $('[name="nama"]').hide();
                    $('[name="kelas"]').hide();
                } else {
                    // Jika pilihan Non-member dipilih, tampilkan kembali form Nama dan Kelas
                    $('[name="nama"]').show();
                    $('[name="kelas"]').show();
                }
            }

            // Fungsi untuk meng-handle submit form dengan AJAX
            $("#formAction").on("submit", function(e) {
                e.preventDefault();
                const _form = this;
                const formData = new FormData(_form);

                const url = _form.getAttribute("action");

                $.ajax({
                    method: "POST",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire("Sukses!", "Data Berhasil Disimpan.", "success");
                            window.LaravelDataTables["table"].ajax.reload();
                        } else {
                            Swal.fire("Error!", res.message, "error");
                        }
                    },
                    error: function(res) {
                        let errors = res.responseJSON?.errors;
                        $(".invalid-feedback").remove();
                        $(".is-invalid").removeClass("is-invalid");

                        if (errors) {
                            for (const [key, value] of Object.entries(errors)) {
                                $(`[name='${key}']`)
                                    .parent()
                                    .append(
                                        `<span class="invalid-feedback">${value}</span>`
                                    );
                                $(`[name='${key}']`).addClass("is-invalid");
                            }
                        }
                    },
                });
            });
        });
    </script>
@endpush
