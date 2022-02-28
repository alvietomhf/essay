<div class="modal-dialog" role="document">
    <form id="edit-exam" data-action="{{ route('ujian.update', [$kelasId, $exam->slug]) }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Edit Ujian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-8 mx-auto text-center">
                        <label for="title">Judul Ujian</label>
                        <div class="form-group">
                            <input 
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')"
                            type="text" id="title" class="form-control" value="{{ $exam->title ?? '' }}" style="text-align: center;" placeholder="Ulangan Harian 1" name="title" required>
                        </div>
                        <label for="description">Keterangan</label>
                        <div class="form-group">
                            <input type="text" id="description" class="form-control" value="{{ $exam->description ?? '' }}" style="text-align: center;" placeholder="(opsional)" name="description">
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