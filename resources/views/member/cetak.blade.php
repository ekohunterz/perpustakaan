<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>SI - Perpustakaan</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link href="favicon.ico" rel="shortcut icon">
    <link type="image/x-icon" href="/perpus/logo.png" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card text-white border-primary">
                    <div class="card-header bg-primary">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ $setting->logo ? asset('storage/logos/' . $setting->logo) : asset('/assets/compiled/jpg/img01.jpg') }}" alt="" style="max-height: 90px">
                            </div>
                            <div class="col-10">
                                <h5 class="text-center">Kartu Anggota Perpustakaan</h5>
                                <h5 class="text-center mt-3">{{ $setting->nama_sekolah }}</h5>
                                <p class="text-center mt-3">{{ $setting->alamat_sekolah }}, {{ $setting->kota }}, {{ $setting->provinsi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{ $member->user->foto ? asset('storage/foto/' . $member->user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" alt="" height="100" width="100">
                            </div>
                            <div class="col-6">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><b>Nama Lengkap</b></td>
                                            <td>: {{ Str::upper($member->user->name) }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>NIS</b></td>
                                            <td>: {{ Str::upper($member->nis) }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Kelas</b></td>
                                            <td>: {{ Str::upper($member->kelas->nama_kelas) }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Jenis Kelamin</b></td>
                                            <td>: {{ $member->jk }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3">
                                <div id="qrcode"></div>
                                <p class="card-title text-center">{{ $member->kode_member }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/extensions/davidshimjs-qrcodejs/qrcode.min.js') }}"></script>
    <script type="text/javascript">
        var qrcode = new QRCode("qrcode", {
            text: "{{ $member->kode_member }}",
            width: 90,
            height: 90,
        });

        // Agar tidak tercetak background dan warna teks secara default
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>

</html>
