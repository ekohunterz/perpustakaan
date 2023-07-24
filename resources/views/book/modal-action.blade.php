<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            {{ $book->id ? 'Edit Buku' : 'Tambah Buku' }}
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
        action="{{ $book->id ? route('buku.update', $book->id) : route('buku.store') }}" method="POST">
        @csrf
        @if ($book->id)
            @method('PUT')
        @endif
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kode-buku">Kode Buku</label>
                        <input class="form-control" id="kode-buku" name="kode_buku" type="text"
                            value="{{ $book->kode_buku }}" placeholder="Kode Buku">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nama-buku">Nama Buku</label>
                        <input class="form-control" id="nama-buku" name="nama_buku" type="text"
                            value="{{ $book->nama_buku }}" placeholder="Nama Buku">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input class="form-control" id="penerbit" name="penerbit" type="text"
                            value="{{ $book->penerbit }}" placeholder="Penerbit">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="th-terbit">Tahun Terbit</label>
                        <input class="form-control" id="th-terbit" name="th_terbit" type="text"
                            value="{{ $book->th_terbit }}" placeholder="Tahun Terbit">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input class="form-control" id="isbn" name="isbn" type="text"
                            value="{{ $book->isbn }}" placeholder="ISBN">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kategori-id">Kategori</label>
                        {{-- <input class="form-control" id="kategori-id" name="kategori_id" type="text"
                            value="{{ $book->kategori_id }}" placeholder="Kategori"> --}}
                        <select class="form-select" id="kategori-id" name="kategori_id">
                            <option value="" selected hidden>--Pilih Kategori--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $book->kategori_id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kondisi-buku-baik">Kondisi Buku Baik</label>
                        <input class="form-control" id="kondisi-buku-baik" name="kondisi_buku_baik" type="text"
                            value="{{ $book->kondisi_buku_baik }}" placeholder="Kondisi Buku Baik">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kondisi-buku-rusak">Kondisi Buku Rusak</label>
                        <input class="form-control" id="kondisi-buku-rusak" name="kondisi_buku_rusak" type="text"
                            value="{{ $book->kondisi_buku_rusak }}" placeholder="Kondisi Buku Rusak">
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="foto-buku">Foto Buku</label>
                        <input class="form-control" id="foto-buku" name="foto_buku" type="file"
                            image-crop-aspect-ratio="1:1" accept="image/*" onchange="previewImage(event)">

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
            <button class="btn btn-primary ms-1" type="submit" type="button">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Simpan</span>
            </button>
        </div>
    </form>
</div>
