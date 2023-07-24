<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            {{ $kategori->id ? 'Edit Kategori' : 'Tambah Kategori' }}
        </h5>
        <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
            <svg class="feather feather-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <form class="form" id="formAction"
        action="{{ $kategori->id ? route('kategori.update', $kategori->id) : route('kategori.store') }}" method="POST">
        @csrf
        @if ($kategori->id)
            @method('PUT')
        @endif
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nama-kategori">Nama Kategori</label>
                        <input class="form-control" id="nama-kategori" name="nama_kategori" type="text"
                            value="{{ $kategori->nama_kategori }}" placeholder="Nama Kategori">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input class="form-control" id="deskripsi" name="deskripsi" type="text"
                            value="{{ $kategori->deskripsi }}" placeholder="Deskripsi">
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
