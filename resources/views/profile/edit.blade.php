{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Profile')
@section('subtitle', '')

@section('breadcrumb')

@endsection

@section('content')
    <section class="section">
        <div class="row">
            @hasanyrole(['siswa', 'staff', 'kepsek'])
                <div class="col-lg-6">
                    <div class="alert alert-success alert-dismissible show fade d-none" id="alert-profil">
                        Profil berhasil diubah.
                        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            @endhasanyrole
            <div class="col-lg-6">
                <div class="alert alert-success alert-dismissible show fade d-none" id="alert-password">
                    Password berhasil diubah.
                    <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                </div>
                @include('profile.partials.update-password-form')
            </div>

        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
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

        $(document).ready(function() {
            $("#formAction, #formPassword").on("submit", function(e) {
                e.preventDefault();
                const _form = this;
                const formData = new FormData(_form);
                const url = _form.getAttribute("action");
                const isUpdateProfile = _form.id === 'formAction';
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
                        if (isUpdateProfile) {
                            Swal.fire("Tersimpan!", "Profil berhasil disimpan.", "success");
                            $("#alert-profil").removeClass("d-none");
                            $(".invalid-feedback").remove();
                            $(".is-invalid").removeClass("is-invalid");
                        } else {
                            Swal.fire("Tersimpan!", "Password berhasil diupdate.", "success");
                            _form.reset()
                            $("#alert-password").removeClass("d-none");
                            $(".invalid-feedback").remove();
                            $(".is-invalid").removeClass("is-invalid");
                        }
                        $('html, body').animate({
                            scrollTop: '0px'
                        }, 1000);
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
                                        ` <span class="invalid-feedback">${value}</span> `
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
