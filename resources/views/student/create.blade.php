<div class="modal-dialog" role="document">
    <form id="create-student" data-action="{{ route('admin.kelas-siswa.store', [$kelasId]) }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Tambah Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="number">Nomor Ujian</label>
                    <input 
                    oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                    oninput="this.setCustomValidity('')"
                    type="text" id="number" class="form-control" placeholder="0001" name="number" required>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input 
                    oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                    oninput="this.setCustomValidity('')"
                    type="text" id="name" class="form-control" placeholder="Dimas" name="name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>