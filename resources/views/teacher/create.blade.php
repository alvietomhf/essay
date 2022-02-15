<div class="modal-dialog" role="document">
    <form id="create-teacher" data-action="{{ route('admin.guru.store') }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Tambah Guru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="text" id="name" class="form-control" placeholder="Dimas Tifli" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="text" id="username" class="form-control" placeholder="dimas123" name="username" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="email" id="email" class="form-control" placeholder="dimas@gmail.com" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Nomor HP</label>
                            <input
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="text" id="phone" class="form-control" placeholder="082234897777" name="phone" required">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="password">Password</label>
                        <div class="form-group position-relative has-icon-right">
                            <input
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                            <div class="form-control-position">
                                <i  toggle="#password-field" class="ft-eye font-medium-5 line-height-1 text-muted icon-align toggle-password"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="form-group position-relative has-icon-right">
                            <input
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="password" id="password_confirmation" class="form-control" placeholder="Password" name="password_confirmation" required>
                            <div class="form-control-position">
                                <i toggle="#password-field" class="ft-eye font-medium-5 line-height-1 text-muted icon-align toggle-confirm-password"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>