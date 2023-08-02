<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">
            {{ $member->id ? 'Edit Member' : 'Tambah Member' }}
        </h5>
        <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
            <svg class="feather feather-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <form class="form" id="formAction" action="{{ $member->id ? route('member.update', $member->id) : route('member.store') }}" method="POST">
        @csrf
        @if ($member->id)
            @method('PUT')
        @endif
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name">Nama Member</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $member->user->name }}" placeholder="Nama Member">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kode-member">Kode Member</label>
                        <input class="form-control" id="kode-member" name="kode_member" type="text" value="{{ $member->kode_member }}" style="background-color:#e9ecef" placeholder="Kode Member" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input class="form-control" id="nis" name="nis" type="text" value="{{ $member->nis }}" placeholder="NIS">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{ $member->user->email }}" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="kelas-id">Kelas</label>
                        <select class="form-select" id="kelas-id" name="kelas_id">
                            <option value="" selected hidden>--Pilih kelas--</option>
                            @foreach ($kelas as $class)
                                <option value="{{ $class->id }}" {{ $class->id == $member->kelas_id ? 'selected' : '' }}>
                                    {{ $class->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk">
                            <option value="Laki-Laki" {{ $member->jk == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>
                            <option value="Perempuan" {{ $member->jk == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tempat-lahir">Tempat Lahir</label>
                        <input class="form-control" id="tempat-lahir" name="tempat_lahir" type="text" value="{{ $member->tempat_lahir }}" placeholder="Tempat Lahir">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tanggal-lahir">Tanggal Lahir</label>
                        <input class="form-control mb-3 flatpickr-no-config" id="tanggal-lahir" name="tanggal_lahir" type="date" value="{{ $member->tanggal_lahir }}" placeholder="Select date.." />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" name="alamat" type="text" value="{{ $member->alamat }}" placeholder="Alamat">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="hp">Nomor HP</label>
                        <input class="form-control" id="hp" name="hp" type="text" value="{{ $member->hp }}" placeholder="Nomor HP">
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="foto">Foto Member</label>
                        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" onchange="previewImage(event)">

                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <img class="img-thumbnail mt-3 mx-auto d-block"alt="Preview" id="preview" src="{{ $member->user->foto ? asset('/storage/foto/' . $member->user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" style="max-width: 100%; height: 200px;">
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

    //membuat kode_member otomatis

    let kodeMemberInput = $('#kode-member');

    if (!kodeMemberInput.val()) {
        generateKodeMember();
    }

    function generateKodeMember() {
        $.ajax({
            url: '/generate-kode-member',
            dataType: 'json',
            success: function(data) {
                kodeMemberInput.val(data.kode_member);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
</script>
