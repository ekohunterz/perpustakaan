<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            Detail Buku
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
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="kode-buku">Kode Buku</label>
                    <input class="form-control" id="kode-buku" name="kode_buku" type="text"
                        value="{{ $book->kode_buku }}" placeholder="Kode Buku" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="nama-buku">Nama Buku</label>
                    <input class="form-control" id="nama-buku" name="nama_buku" type="text"
                        value="{{ $book->nama_buku }}" placeholder="Nama Buku" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input class="form-control" id="penerbit" name="penerbit" type="text"
                        value="{{ $book->penerbit }}" placeholder="Penerbit" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="th-terbit">Tahun Terbit</label>
                    <input class="form-control" id="th-terbit" name="th_terbit" type="text"
                        value="{{ $book->th_terbit }}" placeholder="Tahun Terbit" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input class="form-control" id="isbn" name="isbn" type="text" value="{{ $book->isbn }}"
                        placeholder="ISBN" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="kategori-id">Kategori ID</label>
                    <input class="form-control" id="kategori-id" name="kategori_id" type="text"
                        value="{{ $book->kategori->nama_kategori }}" placeholder="Kategori" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="kondisi-buku-baik">Kondisi Buku Baik</label>
                    <input class="form-control" id="kondisi-buku-baik" name="kondisi_buku_baik" type="text"
                        value="{{ $book->kondisi_buku_baik }}" placeholder="Kondisi Buku Baik" disabled>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="kondisi-buku-rusak">Kondisi Buku Rusak</label>
                    <input class="form-control" id="kondisi-buku-rusak" name="kondisi_buku_rusak" type="text"
                        value="{{ $book->kondisi_buku_rusak }}" placeholder="Kondisi Buku Rusak" disabled>
                </div>
            </div>
            <div class="col-md-12 col-12">
                <div class="form-group">
                    <label for="stok-buku">Stok Buku</label>
                    <input class="form-control" id="stok-buku" name="stok_buku" type="text"
                        value="{{ $book->stok_buku }}" placeholder="Stok Buku" disabled>
                </div>
            </div>
            <div class="col-md-12 col-12">
                <div class="form-group">
                    <img class="img-thumbnail mx-auto d-block"alt="Preview" id="preview"
                        src="{{ $book->foto_buku ? asset('/storage/books/' . $book->foto_buku) : asset('/assets/compiled/jpg/img01.jpg') }}"
                        style="max-width: 100%; height: 200px;">
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
