<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img class="img-thumbnail mt-3 mx-auto d-block"alt="Preview" id="preview" src="{{ $member->user->foto ? asset('/storage/foto/' . $member->user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 100px;">
                            </div>
                            <div class="col-lg-6">
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
                            <div class="col-lg-3">
                                <div class="mt-3 d-flex justify-content-center" id="qrcode"></div>
                                <span class="card-title d-flex justify-content-center">{{ $member->kode_member }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title">Pilih Buku Untuk Dipinjam <span class="text-danger text-sm">*Maksimal 3 Buku</span></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="formPinjam" action="{{ route('pinjam.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input id="" name="member" type="text" value="{{ $member->id }}" hidden>

                                <div class="row">
                                    <div class="col-md-9 col-12">
                                        <div class="form-group">
                                            <label for="">Buku 1</label>
                                            <select class="select2 form-select" name="buku1">
                                                <option value="" selected hidden>Pilih Buku 1</option>
                                                @foreach ($buku as $data)
                                                    <option value="{{ $data->id }}">[{{ $data->kode_buku }}] -
                                                        {{ Str::title($data->nama_buku) }} - Stok Buku: [Baik: {{ $data->kondisi_buku_baik }}] [Rusak: {{ $data->kondisi_buku_rusak }}]</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">Kondisi Buku</label>
                                            <select class="form-select" id="kondisi_buku1" name="kondisi_buku1">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 col-12">
                                        <div class="form-group">
                                            <label for="">Buku 2</label>
                                            <select class="select2 form-select" name="buku2">
                                                <option value="" selected hidden>Pilih Buku 2</option>
                                                @foreach ($buku as $data)
                                                    <option value="{{ $data->id }}">[{{ $data->kode_buku }}] -
                                                        {{ Str::title($data->nama_buku) }} - Stok Buku: [Baik: {{ $data->kondisi_buku_baik }}] [Rusak: {{ $data->kondisi_buku_rusak }}]</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">Kondisi Buku</label>
                                            <select class="form-select" id="kondisi_buku2" name="kondisi_buku2">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 col-12">
                                        <div class="form-group">
                                            <label for="">Buku 3</label>
                                            <select class="select2 form-select" name="buku3">
                                                <option value="" selected hidden>Pilih Buku 3</option>
                                                @foreach ($buku as $data)
                                                    <option value="{{ $data->id }}">[{{ $data->kode_buku }}] -
                                                        {{ Str::title($data->nama_buku) }} - Stok Buku: [Baik: {{ $data->kondisi_buku_baik }}] [Rusak: {{ $data->kondisi_buku_rusak }}]</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="">Kondisi Buku</label>
                                            <select class="form-select" id="kondisi_buku3" name="kondisi_buku3">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_kembali">Tanggal Pengembalian</label>
                                    <input class="form-control mb-3 flatpickr-no-config" id="tgl_kembali" name="tgl_kembali" type="date" placeholder="Select date.." />
                                </div>
                                <button class="btn btn-success w-100 mt-10" name="submit" type="submit">Proses</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Buku",
            theme: 'bootstrap-5',
            allowClear: true
        });

        // Event listener ketika form disubmit
        $('#formPinjam').on('submit', function(e) {
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
    });

    var qrcode = new QRCode("qrcode", {
        text: "{{ $member->kode_member }}",
        width: 100,
        height: 100,
    });
</script>
