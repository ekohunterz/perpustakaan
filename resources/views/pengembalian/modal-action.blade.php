<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            Konfirmasi Proses Pengembalian
        </h5>
        <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
            <svg class="feather feather-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <form class="form" id="formAction" action="/pengembalian-proses/{{ $pinjam->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nama_buku">Nama Buku</label>
                        <input class="form-control" id="nama_buku" name="nama_buku" type="text" value="{{ $pinjam->buku->nama_buku }}" placeholder="Nama Buku" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input class="form-control" id="tgl_pinjam" name="tgl_pinjam" type="text" value="{{ $pinjam->tgl_pinjam }}" placeholder="tgl_pinjam" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="batas_tgl_kembali">Batas Tanggal Kembali</label>
                        <input class="form-control" id="batas_tgl_kembali" name="batas_tgl_kembali" type="text" value="{{ $pinjam->tgl_kembali }}" placeholder="Batas Tanggal Kembali" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input class="form-control" id="tgl_kembali" name="tgl_kembali" type="text" value="{{ date('Y-m-d') }}" placeholder="tgl_kembali" readonly>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kondisi_buku_saat_dipinjam">Kondisi Buku Saat Dipinjam</label>
                        <input class="form-control" id="kondisi_buku_saat_dipinjam" name="kondisi_buku_saat_dipinjam" type="text" value="{{ $pinjam->kondisi_buku }}" placeholder="kondisi_buku_saat_dipinjam" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kondisi_buku_saat_dikembalikan">Kondisi Buku Saat Dikembalikan</label>
                        <select class="form-select" id="kondisi_buku_saat_dikembalikan" name="kondisi_buku_saat_dikembalikan">
                            <option value="Baik" {{ $pinjam->kondisi_buku == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak" {{ $pinjam->kondisi_buku == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="denda">Denda</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input class="form-control" id="denda" name="denda" type="text" value="" placeholder="Denda" readonly>
                            <span class="input-group-text">,00</span>
                        </div>

                    </div>
                </div>
                {{-- <div class="col-md-12 col-12">
                    <div class="form-group">
                        <img class="img-thumbnail mt-3 mx-auto d-block"alt="Preview" id="preview" src="{{ $member->user->foto ? asset('/storage/foto/' . $member->user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 200px;">
                    </div>
                </div> --}}
            </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-light-secondary" data-bs-dismiss="modal" type="button">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>
            <button class="btn btn-primary ms-1" type="submit" type="button">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Proses</span>
            </button>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk menghitung jumlah denda
    function hitungDenda() {
        var kondisiBukuDipinjam = "{{ $pinjam->kondisi_buku }}"; // Ambil kondisi buku saat dipinjam dari PHP

        var tanggalPinjam = new Date("{{ $pinjam->tgl_pinjam }}"); // Ambil tanggal pinjam dari PHP
        var batasTglKembali = new Date("{{ $pinjam->tgl_kembali }}"); // Ambil batas tanggal kembali dari PHP
        var tanggalKembali = new Date($("#tgl_kembali").val()); // Ambil tanggal kembali dari form

        var denda = 0;

        // Perhitungan denda jika terlambat mengembalikan
        if (tanggalKembali > batasTglKembali) {
            var selisihHari = Math.ceil((tanggalKembali - batasTglKembali) / (1000 * 3600 * 24));
            denda += selisihHari * 1000; // Denda 1000 per hari terlambat
        }

        // Perhitungan denda jika kondisi buku saat dikembalikan rusak
        if (kondisiBukuDipinjam === "Baik" && $("#kondisi_buku_saat_dikembalikan").val() === "Rusak") {
            denda += 20000; // Denda jika kondisi buku rusak
        }

        // Perhitungan denda jika kondisi buku saat dikembalikan hilang
        if ($("#kondisi_buku_saat_dikembalikan").val() === "Hilang") {
            denda += 50000; // Denda jika buku hilang
        }

        // Tampilkan hasil perhitungan denda di form
        $("#denda").val(denda);
    }

    // Panggil fungsi hitungDenda saat form diubah
    $("#kondisi_buku_saat_dikembalikan, #tgl_kembali").on("change", function() {
        hitungDenda();
    });

    // Panggil fungsi hitungDenda saat halaman dimuat untuk mengisi nilai awal denda
    hitungDenda();

    // Event listener ketika form disubmit
    $('#formAction').on('submit', function(e) {
        e.preventDefault(); // Mencegah form melakukan submit biasa

        // Mendapatkan data dari form
        var formData = new FormData(this);

        // Mengirim data menggunakan Ajax
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(res) {
                if (res.status === 'success') {
                    Swal.fire("Sukses!", "Buku Berhasil Dikembalikan.", "success");
                    window.location.href = '{{ route('pengembalian.index') }}';
                } else {
                    Swal.fire("Gagal!", res.message, "error");
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
            }
        });
    });
</script>
