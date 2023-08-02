@php
    $setting = DB::table('settings')->first();
    $kelas = DB::table('kelas')->get();
@endphp
@extends('home.master')

@push('css')
    <link href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mt-5">
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="{{ $setting->logo ? asset('storage/logos/' . $setting->logo) : asset('assets/static/images/logo/logo.svg') }}" style="max-width: 100px">
                            <h5 class="mt-3">Selamat Datang di Perpustakaan {{ $setting->nama_sekolah }}</h5>
                            <p class="text-muted">Registrasi Member</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="formAction" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input class="form-control" id="kode-member" name="kode_member" type="text" value="" style="background-color:#e9ecef" placeholder="Kode Member" readonly hidden>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Nama Member</label>
                                        <input class="form-control" id="name" name="name" type="text" value="" placeholder="Nama Member" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nis">NIS</label>
                                        <input class="form-control" id="nis" name="nis" type="text" value="" placeholder="NIS" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" id="password" name="password" type="password" value="" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="" required autocomplete="new-password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email" value="" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="kelas-id">Kelas</label>
                                        <select class="form-select" id="kelas-id" name="kelas_id" required>
                                            <option value="" selected hidden>--Pilih kelas--</option>
                                            @foreach ($kelas as $class)
                                                <option value="{{ $class->id }}">
                                                    {{ $class->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select class="form-select" id="jk" name="jk" required>
                                            <option value="Laki-Laki">
                                                Laki-Laki
                                            </option>
                                            <option value="Perempuan">
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tempat-lahir">Tempat Lahir</label>
                                        <input class="form-control" id="tempat-lahir" name="tempat_lahir" type="text" value="" placeholder="Tempat Lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tanggal-lahir">Tanggal Lahir</label>
                                        <input class="form-control mb-3 flatpickr-no-config" id="tanggal-lahir" name="tanggal_lahir" type="date" value="" placeholder="Select date.." required />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input class="form-control" id="alamat" name="alamat" type="text" value="" placeholder="Alamat" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="hp">Nomor HP</label>
                                        <input class="form-control" id="hp" name="hp" type="text" value="" placeholder="Nomor HP" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="foto">Foto Member</label>
                                        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" onchange="previewImage(event)">

                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <img class="img-thumbnail mt-3 mx-auto d-block"alt="Preview" id="preview" src="{{ asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 100px;">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Register</button>
                            <button class="btn btn-danger mt-3" type="reset">Reset</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        flatpickr('.flatpickr-no-config', {
            enableTime: false,
            dateFormat: "Y-m-d",
        })

        let kodeMemberInput = $('#kode-member');

        if (!kodeMemberInput.val()) {
            generateKodeMember();
        }

        function generateKodeMember() {
            $.ajax({
                url: '/generate-kode-member',
                dataType: 'json',
                success: function(data) {
                    kodeMemberInput.val(data.kode_member);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        $("#formAction").on("submit", function(e) {
            e.preventDefault();
            const _form = this;
            const formData = new FormData(_form);

            const url = this.getAttribute("action");

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
                    Swal.fire("Berhasil!", "Registrasi Member Sukses.", "success");
                    window.location.href = '{{ route('dashboard') }}';
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
    </script>
@endpush
