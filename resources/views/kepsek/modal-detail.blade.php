<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            Detail Kepala Sekolah
        </h5>
        <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
            <svg class="feather feather-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="form-group">
                    <label for="user-id">Nama Kepala Sekolah</label>
                    <input class="form-control" id="user-id" name="user_id" type="text" value="{{ $kepsek->user->name }}" placeholder="Nama kepsek" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input class="form-control" id="nip" name="nip" type="text" value="{{ $kepsek->nip }}" placeholder="nip" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="text" value="{{ $kepsek->user->email }}" placeholder="Email" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="status">Status</label>
                    <input class="form-control" id="status" name="status" type="text" value="{{ $kepsek->status }}" placeholder="Kelas" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <input class="form-control" id="jk" name="jk" type="text" value="{{ $kepsek->jk }}" placeholder="Jenis Kelamin" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="tempat-lahir">Tempat Lahir</label>
                    <input class="form-control" id="tempat-lahir" name="tempat_lahir" type="text" value="{{ $kepsek->tempat_lahir }}" placeholder="Tempat Lahir" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="tanggal-lahir">Tanggal Lahir</label>
                    <input class="form-control" id="tanggal-lahir" name="tanggal_lahir" type="text" value="{{ $kepsek->tanggal_lahir }}" placeholder="Tanggal Lahir" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input class="form-control" id="alamat" name="alamat" type="text" value="{{ $kepsek->alamat }}" placeholder="Alamat" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="hp">Nomor HP</label>
                    <input class="form-control" id="hp" name="hp" type="text" value="{{ $kepsek->hp }}" placeholder="Nomor HP" disabled>
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
    </div>
</div>
