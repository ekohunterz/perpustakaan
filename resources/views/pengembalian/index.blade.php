@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Pengembalian Buku')
@section('subtitle', '')

@section('breadcrumb')

@endsection

@section('content')
    <section class="section">
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

        <div class="card" id="list-pinjam">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Buku Sedang Dipinjam</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive pe-4">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAction" aria-labelledby="modalAction" aria-hidden="true" tabindex="-1" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">

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
    <script src="{{ asset('assets/extensions/davidshimjs-qrcodejs/qrcode.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    {{ $dataTable->scripts() }}

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
                        url: '/get-pengembalian',
                        type: 'GET',
                        data: {
                            kode_member: kodeMember
                        },
                        success: function(res) {
                            // Menampilkan data member di halaman
                            $("#member-container").html(res);
                            $("#list-pinjam").hide();
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
