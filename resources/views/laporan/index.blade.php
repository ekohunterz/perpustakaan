@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Laporan')
@section('subtitle', 'Laporan Transaksi Peminjaman dan Pengembalian Buku')

@section('breadcrumb')

@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="col-md-6 mb-1">
                    <form id="cari" action="{{ route('laporan.cetak') }}">
                        <div class="input-group">
                            <input class="form-control flatpickr-range" id="date-range" name="date_range" type="date" aria-describedby="button-addon2" placeholder="Pilih Tanggal / Kosongkan jika ingin cetak semua data" />
                            <button class="btn btn-outline-secondary" id="button-addon2" type="submit">
                                Cetak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Riwayat Peminjaman Buku</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive pe-4">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal" aria-labelledby="modal" aria-hidden="true" tabindex="-1" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">

            </div>
        </div>

    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/davidshimjs-qrcodejs/qrcode.min.js') }}"></script>
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {

            flatpickr('.flatpickr-range', {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                mode: 'range'
            })

            const modal = new bootstrap.Modal($("#modal"));

            $("#table").on("click", ".action", function() {
                let data = $(this).data();
                let id = data.id;

                $.ajax({
                    method: "get",
                    url: `/laporan/detail/${id}`,
                    success: function(res) {
                        $("#modal").find(".modal-dialog").html(res);
                        modal.show();
                    },
                });
            });
        });
    </script>
@endpush
