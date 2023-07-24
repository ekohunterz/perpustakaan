@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            Detail Peminjaman
        </h5>
        <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
            <svg class="feather feather-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama Member</th>
                    <td>{{ $pinjam->member->user->name }}</td>
                    <th>NIS</th>
                    <td>{{ $pinjam->member->nis }}</td>
                </tr>
                <tr>
                    <th>Nama Buku</th>
                    <td>{{ $pinjam->buku->nama_buku }}</td>
                    <th>Kode Buku</th>
                    <td>{{ $pinjam->buku->kode_buku }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td>{{ Carbon::parse($pinjam->tgl_pinjam)->isoFormat('D MMMM Y') }}</td>
                    <th>Batas Tanggal Kembali</th>
                    <td>{{ Carbon::parse($pinjam->batas_tgl_kembali)->isoFormat('D MMMM Y') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                    <td>{{ Carbon::parse($pinjam->tgl_kembali)->isoFormat('D MMMM Y') }}</td>
                    <th>Keterlambatan</th>
                    @php
                        $tglKembali = Carbon::parse($pinjam->tgl_kembali);
                        $batasKembali = Carbon::parse($pinjam->batas_tgl_kembali);
                        $keterlambatan = $batasKembali->diffInDays($tglKembali);
                    @endphp
                    <td>
                        @if ($tglKembali > $batasKembali)
                            <span class="badge bg-danger">{{ $keterlambatan }} Hari</span>
                        @else
                            <span class="badge bg-success">Tidak Terlambat</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Kondisi Buku Saat Dipinjam</th>
                    <td>
                        @if ($pinjam->kondisi_buku_saat_dipinjam == 'Baik')
                            <span class="badge bg-success">{{ $pinjam->kondisi_buku_saat_dipinjam }}</span>
                        @elseif ($pinjam->kondisi_buku_saat_dipinjam == 'Rusak')
                            <span class="badge bg-warning">{{ $pinjam->kondisi_buku_saat_dipinjam }}</span>
                        @endif
                    </td>
                    <th>Kondisi Buku Saat Dikembalikan</th>
                    <td>
                        @if ($pinjam->kondisi_buku_saat_dikembalikan == 'Baik')
                            <span class="badge bg-success">{{ $pinjam->kondisi_buku_saat_dikembalikan }}</span>
                        @elseif ($pinjam->kondisi_buku_saat_dikembalikan == 'Rusak')
                            <span class="badge bg-warning">{{ $pinjam->kondisi_buku_saat_dikembalikan }}</span>
                        @else
                            <span class="badge bg-danger">{{ $pinjam->kondisi_buku_saat_dikembalikan }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Denda</th>
                    <td class="fw-bold" colspan="3">Rp.{{ $pinjam->denda }},00</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td colspan="3">
                        @if ($pinjam->status == 'Selesai')
                            <span class="badge bg-success">{{ $pinjam->status }}</span>
                        @else
                            <span class="badge bg-warning">{{ $pinjam->status }}</span>
                        @endif

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn btn-light-secondary" data-bs-dismiss="modal" type="button">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>
    </div>
</div>
