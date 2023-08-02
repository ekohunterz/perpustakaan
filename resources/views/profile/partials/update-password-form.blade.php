<div class="card">
    <div class="card-header">
        <h4 class="card-title">Ubah Password</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal" id="formPassword" method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="current_password">Password Lama</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input class="form-control" id="current_password" name="current_password" type="password" autocomplete="current-password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password">Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input class="form-control" id="password" name="password" type="password" autocomplete="new-password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password_confirmation">Konfirmasi Password</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                </div>
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
