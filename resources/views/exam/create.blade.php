<div class="modal-dialog" role="document">
    <form id="create-exam" data-action="{{ route('ujian.store', [$kelasId]) }}">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Buat Ujian</h4>
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
                            type="text" id="title" class="form-control" style="text-align: center;" placeholder="Ulangan Harian 1" name="title" required>
                        </div>
                        <label for="description">Keterangan</label>
                        <div class="form-group">
                            <input type="text" id="description" class="form-control" style="text-align: center;" placeholder="(opsional)" name="description">
                        </div>
                        <label for="code">Kode Ujian</label>
                        <div class="form-group">
                            <input type="text" id="code" class="form-control" style="text-align: center;" name="code" readonly>
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
<script>
    $(document).ready(function() {
        function makeid(length) {
            let result = ''
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
            const charactersLength = characters.length
            for ( let i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength))
            }
            return result
        }
        $('#code').val(makeid(5));
    })
</script>