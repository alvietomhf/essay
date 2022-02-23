<style>
    input[type="radio"] {
    display: none;
    }
    input[type="radio"]:checked + label.color span {
    transform: scale(1.25);
    }
    input[type="radio"]:checked + label.color .magenta {
    border: 2px solid #eb8ab5;
    }
    input[type="radio"]:checked + label.color .orange {
    border: 2px solid #e28350;
    }
    input[type="radio"]:checked + label.color .yellow {
    border: 2px solid #dbc64c;
    }
    input[type="radio"]:checked + label.color .green {
    border: 2px solid #15966b;
    }
    input[type="radio"]:checked + label.color .cyan {
    border: 2px solid #66afaf;
    }
    input[type="radio"]:checked + label.color .blue {
    border: 2px solid #4876cc;
    }
    label.color {
    display: inline-block;
    width: 25px;
    height: 25px;
    margin-right: 5px;
    cursor: pointer;
    }
    label.color:hover span {
    transform: scale(1.25);
    }
    label.color span {
    display: block;
    width: 100%;
    height: 100%;
    transition: transform 0.2s ease-in-out;
    }
    label.color span.magenta {
    background: #EAC4D5;
    }
    label.color span.orange {
    background: #FFC09F;
    }
    label.color span.yellow {
    background: #FFEE93;
    }
    label.color span.green {
    background: #33CC99;
    }
    label.color span.cyan {
    background: #99CCCC;
    }
    label.color span.blue {
    background: #809BCE;
    }
</style>

<div class="modal-dialog" role="document">
    <form action="{{ route('kelas-mapel.update', [$data->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Edit Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-8 mx-auto text-center">
                        <label for="kelas">Nama Kelas</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%" id="kelas" name="clas_id" required
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')">
                                <option disabled selected></option>
                                @foreach ($clas as $key => $value)
                                    <option {{ $value->id == $data->clas_id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="mapel">Mata Pelajaran</label>
                        <div class="form-group">
                            <select
                            class="form-control select2" style="width: 100%" id="mapel" name="subject_id" required
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')">
                                <option disabled selected></option>
                                @foreach ($subject as $key => $value)
                                    <option {{ $value->id == $data->subject_id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="tapel">Tahun Pelajaran</label>
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%" id="tapel" name="season_id" required
                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                            oninput="this.setCustomValidity('')">
                                <option disabled selected></option>
                                @foreach ($season as $key => $value)
                                    <option {{ $value->id == $data->season_id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="tapel">Warna</label>
                        <div class="form-group">
                            <input type="radio" name="color" id="magenta" value="#EAC4D5" {{ $data->color == '#EAC4D5' ? 'checked' : ''}}/>
                            <label for="magenta" class="color"><span class="magenta"></span></label>
                            <input type="radio" name="color" id="orange" value="#FFC09F" {{ $data->color == '#FFC09F' ? 'checked' : ''}}/>
                            <label for="orange" class="color"><span class="orange"></span></label>
                            <input type="radio" name="color" id="yellow" value="#FFC09F" {{ $data->color == '#FFC09F' ? 'checked' : ''}}/>
                            <label for="yellow" class="color"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="green" value="#33CC99" {{ $data->color == '#33CC99' ? 'checked' : ''}}/>
                            <label for="green" class="color"><span class="green"></span></label>
                            <input type="radio" name="color" id="cyan" value="#99CCCC" {{ $data->color == '#99CCCC' ? 'checked' : ''}}/>
                            <label for="cyan" class="color"><span class="cyan"></span></label>
                            <input type="radio" name="color" id="blue" value="#809BCE" {{ $data->color == '#809BCE' ? 'checked' : ''}}/>
                            <label for="blue" class="color"><span class="blue"></span></label>
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
        $('#tapel').select2({
            placeholder: "Pilih tapel",
        })
        $('.select2-selection__rendered').css('font-weight', 'bold')
    })
</script>