<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Profile</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
            <form class="form form-horizontal" id="formAction" enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="form-body">
                    <div class="row">
                        @hasanyrole(['staff', 'kepsek'])
                            <div class="col-md-4">
                                <label for="nip">NIP</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input class="form-control" id="nip" name="nip" type="number" value="{{ old('nip', $user->staff->nip) }}" placeholder="Nip" disabled>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-vcard"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4">
                                <label for="nis">NIS</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input class="form-control" id="nis" name="nis" type="number" value="{{ old('nis', $user->member->nis) }}" placeholder="Nip" disabled>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-vcard"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endhasanyrole

                        <div class="col-md-4">
                            <label for="name">Nama</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input class="form-control" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="Email">
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </div>
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-muted">
                                        {{ __('Your email address is unverified.') }}

                                        <button class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" form="send-verification">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-success">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="hp">No. HP</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    @hasanyrole(['admin', 'staff', 'kepsek'])
                                        <input class="form-control" id="hp" name="hp" type="number" value="{{ old('hp', $user->staff->hp) }}" placeholder="No.HP">
                                    @else
                                        <input class="form-control" id="hp" name="hp" type="number" value="{{ old('hp', $user->member->hp) }}" placeholder="No.HP">
                                    @endhasanyrole
                                    <div class="form-control-icon">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="jk">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <select class="form-control" id="jk" name="jk">
                                        @hasanyrole(['admin', 'staff', 'kepsek'])
                                            <option value="Laki-Laki" {{ $user->staff->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $user->staff->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        @else
                                            <option value="Laki-Laki" {{ $user->member->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $user->member->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        @endhasanyrole
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-gender-male"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="tempat_lahir">Tempat Lahir</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    @hasanyrole(['admin', 'staff', 'kepsek'])
                                        <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" value="{{ old('tempat_lahir', $user->staff->tempat_lahir) }}" placeholder="Tempat Lahir">
                                    @else
                                        <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" value="{{ old('tempat_lahir', $user->member->tempat_lahir) }}" placeholder="Tempat Lahir">
                                    @endhasanyrole
                                    <div class="form-control-icon">
                                        <i class="bi bi-geo"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    @hasanyrole(['admin', 'staff', 'kepsek'])
                                        <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir', $user->staff->tanggal_lahir) }}" placeholder="Tanggal Lahir">
                                    @else
                                        <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir', $user->member->tanggal_lahir) }}" placeholder="Tanggal Lahir">
                                    @endhasanyrole
                                    <div class="form-control-icon">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    @hasanyrole(['admin', 'staff', 'kepsek'])
                                        <input class="form-control" id="alamat" name="alamat" type="text" value="{{ old('alamat', $user->staff->alamat) }}" placeholder="Alamat">
                                    @else
                                        <input class="form-control" id="alamat" name="alamat" type="text" value="{{ old('alamat', $user->member->alamat) }}" placeholder="Alamat">
                                    @endhasanyrole
                                    <div class="form-control-icon">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @hasanyrole(['admin', 'staff', 'kepsek'])
                            <div class="col-md-4">
                                <label for="status">Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select class="form-control" id="status" name="status">
                                            <option value="PNS" {{ $user->staff->status == 'PNS' ? 'selected' : '' }}>PNS</option>
                                            <option value="Honorer" {{ $user->staff->status == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endhasanyrole
                        @hasanyrole(['siswa'])
                            @php $kelas = DB::table('kelas')->get() @endphp
                            <div class="col-md-4">
                                <label for="kelas_id">Kelas</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select class="form-control" id="kelas_id" name="kelas_id">
                                            @foreach ($kelas as $kelas)
                                                <option value="{{ $kelas->id }}" {{ $user->member->kelas_id == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endhasanyrole
                        <div class="col-md-4">
                            <label for="foto">Foto</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="position-relative">
                                    <input class="form-control" id="foto" name="foto" type="file" onchange="previewImage(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <img class="img-thumbnail rounded-circle mt-1"alt="Preview" id="preview" src="{{ $user->foto ? asset('/storage/foto/' . $user->foto) : asset('/assets/compiled/jpg/img01.jpg') }}" style="width: 150px; height: 150px; object-fit:cover">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary me-1 mb-1" type="submit">
                                Submit
                            </button>
                            <button class="btn btn-light-secondary me-1 mb-1" type="reset">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
