<div class="modal-dialog" role="document">
    <form action="{{ route('kelas-mapel.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-8 mx-auto text-center">
                        <label for="kelas">Nama Kelas</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%" id="kelas" name="clas_id">
                                <option></option>
                                @foreach ($clas as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="mapel">Mata Pelajaran</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%" id="mapel" name="subject_id">
                                <option></option>
                                @foreach ($subject as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
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
        $('#kelas').select2({
            placeholder: "Pilih kelas",
        })
        $('#mapel').select2({
            placeholder: "Pilih mapel",
        })
        $('.select2-selection__rendered').css('font-weight', 'bold')
    })
</script>