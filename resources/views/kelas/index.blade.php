@extends('layouts.master')

@push('css')
    <link href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Data Kelas')
@section('subtitle', '')

@section('breadcrumb')

@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Kelas</h4>
                @can('manage')
                    <button class="btn btn-primary me-4 btn-add" data-url="{{ route('kelas.create') }}" type="button">Tambah
                        Data</button>
                @endcan

            </div>
            <div class="card-body">
                <div class="table-responsive pe-4">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAction" aria-labelledby="modalAction" aria-hidden="true" tabindex="-1" style="display: none;">
            <div class="modal-dialog" role="document">

            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script> --}}
    {{ $dataTable->scripts() }}
    @vite(['resources/js/crud.js'])
@endpush
