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
    <style type="text/css">
        body h5 h4 h6 {
            font-family: system-ui;
        }

        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <table border="0" width="100%">
        <tr>
            {{-- <td width="10%" align="center"> <img src="https://i.ibb.co/604tH6z/logo-muhammdiyah.jpg" alt="" width="80" height="80"></td> --}}
            <td width="100%" align="center">
                <h5>DINAS PENDIDIKAN PEMERINTAH KOTA XXX</h5>
                <h5>SMK NEGERI 1 KOTA XXX</h5>
                <h6>Alamat : Jalan XXXX KM. XX Telp XXXX XXXX XXXXX</h6>
            </td>
        </tr>
    </table>
    <hr>
    <center>
        <h5>LAPORAN PEMINJAMAN SELURUH SISWA SMK NEGERI XXXXX</h5>
    </center>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>ID Buku</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi Buku Saat Dikembalikan</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($riwayat as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td><b>{{ $data->member->nis }}</b></td>
                    <td>{{ Str::title($data->member->user->name) }}</td>
                    <td>{{ Str::upper($data->member->kelas->nama_kelas) }}</td>
                    <td>{{ $data->buku->kode_buku }}</td>
                    <td>{{ Str::title($data->buku->nama_buku) }}</td>
                    <td>
                        {{ date('d-F-Y', strtotime($data->tgl_pinjam)) }}
                    </td>
                    <td>
                        {{ $data->tgl_kembali ? date('d-F-Y', strtotime($data->tgl_kembali)) : '-' }}
                    </td>
                    <td>{{ $data->kondisi_buku_saat_dikembalikan }}</td>
                    <td>Rp.{{ $data->denda }}</td>
                </tr>
            @endforeach
        </tbody>
    </table><br><br>
    @php
        $kepsek = DB::Table('users')
            ->where('role', 'kepsek')
            ->get();
    @endphp
    <!-- Tanda tangan Kepala Sekolah dan Staff -->
    <table class="w-100">
        <tbody>
            <tr>
                <td style="width: 70%">
                    Kepala Sekolah<br><br><br><br>
                    @forelse ($kepsek as $kepsek)
                        {{ Str::title($kepsek->name) }} <br>
                        <b><u>NIP : -</u></b>
                    @empty
                        Nama Kepala Sekolah Kosong
                    @endforelse
                </td>
                <td></td> <!-- Sel kosong sebagai pemisah -->
                <td style="width: 30%">
                    Staff Perpustakaan<br><br><br><br>
                    {{ Str::title(Auth::user()->name) }} <br>
                    <b><u>NIP : {{ Auth::user()->staff->nip }}</u></b>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
