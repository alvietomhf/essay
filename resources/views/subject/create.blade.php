<div class="modal-dialog" role="document">
    <form action="{{ route('admin.mapel.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Tambah Mapel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Mapel</label>
                    <input 
                    oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                    oninput="this.setCustomValidity('')"
                    type="text" id="name" class="form-control" placeholder="TIK" name="name" required autocomplete="name" autofocus>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>