@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Pengaturan')
@section('subtitle', '')

@section('breadcrumb')

@endsection

@section('content')
    <section class="section">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Sekolah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" id="formAction" action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama-sekolah">Nama Sekolah</label>
                                            <input class="form-control" id="nama-sekolah" name="nama_sekolah" type="text" value="{{ $setting->nama_sekolah }}" placeholder="Nama Sekolah">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="alamat_sekolah">Alamat Sekolah</label>
                                            <input class="form-control" id="alamat_sekolah" name="alamat_sekolah" type="text" value="{{ $setting->alamat_sekolah }}" placeholder="Alamat Sekolah">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi</label>
                                            <select class="form-select" id="provinsi" name="provinsi" type="text" placeholder="Provinsi">
                                                <option>Pilih Provinsi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="form-group">
                                            <label for="city-column">Kota</label>
                                            <select class="form-select" id="city-column" name="kota" type="text" placeholder="Kota">
                                                <option value="{{ $setting->kota }}">{{ $setting->kota }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telp">Telp.</label>
                                            <input class="form-control" id="telp" name="telp" type="text" value="{{ $setting->telp }}" placeholder="Telp.">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email Sekolah</label>
                                            <input class="form-control" id="email" name="email" type="email" value="{{ $setting->email }}" placeholder="Email Sekolah">
                                        </div>
                                    </div>
                                    <div class="col-md-4  col-sm-12">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <input class="form-control" id="logo" name="logo" type="file" placeholder="Logo" onchange="previewImage(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2  col-sm-12">
                                        <div class="form-group">
                                            <label for="logo"></label>
                                            <div class="form-group">
                                                <img class="img-thumbnail"alt="Preview" id="preview" src="{{ $setting->logo ? asset('/storage/logos/' . $setting->logo . '') : asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 100px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <button class="btn btn-primary me-1 mb-1" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan Denda</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" id="formDenda" action="{{ route('setting.updateDenda') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="denda_terlambat">Denda Terlambat</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input class="form-control" id="denda_terlambat" name="denda_terlambat" type="text" value="{{ $setting->denda_terlambat }}">
                                                <span class="input-group-text">,00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="denda_rusak">Denda Rusak</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input class="form-control" id="denda_rusak" name="denda_rusak" type="text" value="{{ $setting->denda_rusak }}">
                                                <span class="input-group-text">,00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="denda_hilang">Denda Hilang</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp.</span>
                                                <input class="form-control" id="denda_hilang" name="denda_hilang" type="text" value="{{ $setting->denda_hilang }}">
                                                <span class="input-group-text">,00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <button class="btn btn-primary me-1 mb-1" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
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

        function getProvinces() {
            $.ajax({
                url: "http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                method: "GET",
                success: function(response) {
                    // Proses data dan tampilkan daftar provinsi
                    var provinces = response;
                    var options = '<option value="{{ $setting->provinsi }}" selected hidden>{{ $setting->provinsi }}</option>';
                    provinces.forEach(function(province) {
                        options += '<option value="' + province.name + '" data-id="' + province.id + '">' + province.name + '</option>';
                    });
                    $('#provinsi').html(options);
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data provinsi.');
                }
            });
        }

        function getCities(provinceId) {
            $.ajax({
                url: "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + provinceId + ".json",
                method: "GET",
                success: function(response) {
                    // Proses data dan tampilkan daftar kota
                    var cities = response;
                    var options = '';
                    cities.forEach(function(city) {
                        options += '<option value="' + city.name + '" data-id="' + city.id + '">' + city.name + '</option>';
                    });
                    $('#city-column').html(options);
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data kota.');
                }
            });
        }

        $(document).ready(function() {
            getProvinces();

            // Panggil fungsi getCities saat pilihan provinsi berubah
            $('#provinsi').on('change', function() {
                var provinceId = $(this).find('option:selected').data('id');
                getCities(provinceId);
            });
        });

        function update() {
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
                    Swal.fire("Tersimpan!", "Data telah disimpan.", "success");
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
        }

        $(document).ready(function() {
            $("#formAction").on("submit", function(e) {
                e.preventDefault();
                update.call(this, e); // Menggunakan call() untuk memastikan "this" mengacu pada form yang benar
            });

            $("#formDenda").on("submit", function(e) {
                e.preventDefault();
                update.call(this, e); // Menggunakan call() untuk memastikan "this" mengacu pada form yang benar
            });
        });
    </script>
@endpush
