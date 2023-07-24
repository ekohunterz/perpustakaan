<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img class="img-thumbnail mt-3 mx-auto d-block"alt="Preview" id="preview" src="{{ $member->user->foto ? asset('/storage/foto/' . $member->user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 100px;">
                            </div>
                            <div class="col-6">
                                <table class="border-0">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 3px"><b>Nama Lengkap</b></td>
                                            <td><b>&nbsp;: </b></td>
                                            <td> &nbsp;{{ $member->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 3px"><b>NIS</b></td>
                                            <td><b>&nbsp;: </b></td>
                                            <td>&nbsp;{{ $member->nis }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 3px"><b>Kelas</b></td>
                                            <td><b>&nbsp;: </b></td>
                                            <td>&nbsp;{{ $member->kelas->nama_kelas }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 3px"><b>Jenis Kelamin</b></td>
                                            <td><b>&nbsp;: </b></td>
                                            <td>&nbsp;{{ $member->jk }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3">
                                <div class="mt-3 d-flex justify-content-center" id="qrcode"></div>
                                <span class="card-title d-flex justify-content-center">{{ $member->kode_member }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Buku Yang Sedang Dipinjam Oleh: <span class="text-success">{{ $member->user->name }}</span></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="member-pinjam">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama Buku</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Batas Tanggal Pengembalian</th>
                                            <th class="text-center">Kondisi Buku Saat Dipinjam</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pinjam as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->buku->nama_buku }}</td>
                                                <td>{{ $data->tgl_pinjam }}</td>
                                                <td>{{ $data->tgl_kembali }}</td>
                                                <td class="text-center">
                                                    @if ($data->kondisi_buku == 'Baik')
                                                        <span class="badge bg-success">{{ $data->kondisi_buku }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $data->kondisi_buku }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-primary action" data-id="{{ $data->id }}" type="button">Proses</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        const modal = new bootstrap.Modal($("#modalAction"));
        $('.select2').select2({
            placeholder: "Pilih Buku",
            theme: 'bootstrap-5',
            allowClear: true
        });

        $('#formPinjam').on('submit', function(e) {
            e.preventDefault(); // Mencegah form melakukan submit biasa

            // Mendapatkan data dari form
            var formData = new FormData(this);

            // Mengirim data menggunakan Ajax
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(res) {
                    if (res.status === 'success') {
                        Swal.fire("Sukses!", "Berhasil Melakukan Peminjaman.", "success");
                        window.location.href = '{{ route('pinjam.index') }}';
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

        $("#member-pinjam").on("click", ".action", function() {
            let data = $(this).data();
            let id = data.id;

            $.ajax({
                method: "get",
                url: `/pengembalian-proses/${id}`,
                success: function(res) {
                    $("#modalAction").find(".modal-dialog").html(res);
                    modal.show();
                },
            });
        });
        var qrcode = new QRCode("qrcode", {
            text: "{{ $member->kode_member }}",
            width: 100,
            height: 100,
        });
    });
</script>
