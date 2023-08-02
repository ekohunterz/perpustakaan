<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            {{ $kepsek->id ? 'Edit Kepala Sekolah' : 'Tambah Kepala Sekolah' }}
        </h5>
        <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
            <svg class="feather feather-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <form class="form" id="formAction" action="{{ $kepsek->id ? route('kepsek.update', $kepsek->id) : route('kepsek.store') }}" method="POST">
        @csrf
        @if ($kepsek->id)
            @method('PUT')
        @endif
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name">Nama Kepala Sekolah</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $kepsek->user->name }}" placeholder="Nama kepsek">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input class="form-control" id="nip" name="nip" type="text" value="{{ $kepsek->nip }}" placeholder="NIP">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ $kepsek->user->email }}" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk">
                            <option value="Laki-Laki" {{ $kepsek->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>
                            <option value="Perempuan" {{ $kepsek->jk == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tempat-lahir">Tempat Lahir</label>
                        <input class="form-control" id="tempat-lahir" name="tempat_lahir" type="text" value="{{ $kepsek->tempat_lahir }}" placeholder="Tempat Lahir">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tanggal-lahir">Tanggal Lahir</label>
                        <input class="form-control mb-3 flatpickr-no-config" id="tanggal-lahir" name="tanggal_lahir" type="date" value="{{ $kepsek->tanggal_lahir }}" placeholder="Select date.." />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" name="alamat" type="text" value="{{ $kepsek->alamat }}" placeholder="Alamat">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="hp">Nomor HP</label>
                        <input class="form-control" id="hp" name="hp" type="text" value="{{ $kepsek->hp }}" placeholder="Nomor HP">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="PNS" {{ $kepsek->status == 'PNS' ? 'selected' : '' }}>
                                PNS
                            </option>
                            <option value="Honorer" {{ $kepsek->status == 'Honorer' ? 'selected' : '' }}>
                                Honorer
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input class="form-control" id="foto" name="foto" type="file" image-crop-aspect-ratio="1:1" accept="image/*" onchange="previewImage(event)">

                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <img class="img-thumbnail mt-3 mx-auto d-block"alt="Preview" id="preview" src="{{ $kepsek->user->foto ? asset('/storage/foto/' . $kepsek->user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 200px;">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-light-secondary" data-bs-dismiss="modal" type="button">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>
            <button class="btn btn-primary ms-1" type="submit" type="button">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Simpan</span>
            </button>
        </div>
    </form>
</div>

<script>
    flatpickr('.flatpickr-no-config', {
        enableTime: false,
        dateFormat: "Y-m-d",
    })
</script>
