@extends('layouts.app')

@section('header-color')
    {{ $data->clasSubject->color }}
@endsection

@section('header-clas-exam')
<li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg"></i><span class="selected-language"></span></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item btn-modal" href="javascript:void(0);" data-href="{{ route('ujian.edit', [$kelasId, $data->slug]) }}" data-container=".app-modal"><i class="fa fa-edit"></i> Edit Ujian</a>
        <a class="dropdown-item btn-delete" href="javascript:void(0);" data-href="{{ route('ujian.destroy', [$kelasId, $data->slug]) }}"><i class="fa fa-trash"></i> Hapus Ujian</a>
        <a class="dropdown-item btn-change" href="javascript:void(0);" data-href="{{ route('ujian.status', [$kelasId, $data->slug]) }}" data-message="{{ $data->is_active ? 'menonaktifkan form ini!' : 'mengaktifkan form ini!' }}" data-confirm="{{ $data->is_active ? 'Ya, Nonaktifkan!' : 'Ya, Aktifkan!' }}" data-value={{ $data->is_active ? 0 : 1 }}><i class="fa fa-toggle-{{ $data->is_active ? 'on' : 'off' }}"></i> {{ $data->is_active ? 'Aktif' : 'Non-aktif' }}</a>
        <a class="dropdown-item btn-change" href="javascript:void(0);" data-href="{{ route('ujian.mix', [$kelasId, $data->slug]) }}" data-message="{{ $data->mix_question ? 'mengurutkan soal ini!' : 'mengacak soal ini!' }}" data-confirm="{{ $data->mix_question ? 'Ya, Urutkan!' : 'Ya, Acak!' }}" data-value={{ $data->mix_question ? 0 : 1 }}><i class="fa fa-{{ $data->mix_question ? 'random' : 'sort' }}"></i> {{ $data->mix_question ? 'Soal Acak' : 'Soal Urut' }}</a>
    </div>
</li>
@endsection

@section('header-title')
    {{ $data->title }} {{ $data->description ? '('.$data->description.')' : '' }}
@endsection

@section('content')
<style>
.colored-toast .swal2-title {
  color: white;
}

.colored-toast .swal2-close {
  color: white;
}

.colored-toast .swal2-html-container {
  color: white;
}
</style>
<div class="row d-flex justify-content-center">
    <div class="col-10">
        @include('flash::message')
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}" style="color: grey"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="text-center mb-2">
            <h4 class="text-bold-700">{{ $data->clasSubject->clas->name }} - {{ $data->clasSubject->subject->name }}</h4>
            <h4 class="text-bold-700">{{ $data->title }}</h4>
            @if ($data->description)
            <h4 class="text-bold-700">{{ $data->description }}</h4>
            @endif
        </div>
        @if ($data->questions_count == 0)
        {{-- Create --}}
        <form id="create-question" data-action="{{ route('soal.store', [$kelasId, $data->slug]) }}" enctype="multipart/form-data">
            <div id="new-question">
                <div class="card" id="question0">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Pertanyaan" id="title0" name="questions[0][title]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-2">
                                    <label for="image0" style="float:right;"><i class="far fa-image fa-2x"></i></label>
                                    <input type="file" class="form-control" id="image0" name="questions[0][image]" onchange="onChangeFile(this)" data-status="create" hidden>
                                </div>
                            </div>
                            <div class="row" id="rowimage0" style="display: none;">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <small><a id="titleimage0" style="color: blue;text-decoration: underline;" href="javascript:void(0);"></a></small>
                                            <span class="ml-1" id="deleteimage0" onclick="onClickIconDelete(this)" data-status="create" style="display: none;"><i style="color: red;" class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Kunci jawaban" id="answer_key0" name="questions[0][answer_key]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-start">
                    <button class="btn btn-secondary round" style="color: white;" type="submit">Simpan</button>
                </div>
            </div>
        </form>
        @else
        {{-- Edit --}}
        <form id="edit-question" data-action="{{ route('soal.update', [$kelasId, $data->slug]) }}" enctype="multipart/form-data">
            <div id="new-question">
                @foreach ($data->questions as $key => $value)
                <div class="card" id="question{{ $key }}">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input type="hidden" name="questions[{{ $key }}][id]" value="{{ $value->id }}">
                                            <input class="form-control" type="text" placeholder="Pertanyaan" id="title{{ $key }}" name="questions[{{ $key }}][title]" required value="{{ $value->title }}"
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-2">
                                    <label for="image{{ $key }}" style="float:right;"><i class="far fa-image fa-2x"></i></label>
                                    <input type="file" class="form-control" id="image{{ $key }}" name="questions[{{ $key }}][image]" onchange="onChangeFile(this)" data-image="{{ $value->image ? 1 : 0 }}" data-status="edit" hidden>
                                </div>
                            </div>
                            <div class="row" id="rowimage{{ $key }}" style="display: {{ $value->image ? 'block' : 'none' }};">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <small><a id="titleimage{{ $key }}" style="color: blue;text-decoration:underline;" target="_blank" href="{{ $value->image ? asset('storage/images/' . $value->image) : 'javascript:void(0);' }}">{{ $value->image ? 'Gambar' : '' }}</a></small>
                                            <span class="ml-1" id="deleteimage{{ $key }}" onclick="onClickIconDelete(this)" data-image="{{ $value->image ? 1 : 0 }}" data-status="edit" style="display: {{ $value->image ? 'inline' : 'none' }};"><i style="color: red;" class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Kunci jawaban" id="answer_key{{ $key }}" name="questions[{{ $key }}][answer_key]" required value="{{ $value->answer_key }}"
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div>
                                    <a id="deletequestion{{ $key }}" onclick="onClickHide(this)"><i class="far fa-trash-alt fa-2x"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-start">
                    <button class="btn btn-secondary round" style="color: white;" type="submit">Simpan</button>
                </div>
            </div>
        </form>
        @endif
    </div>
    <div class="col-11 mb-2">
        <button id="addquestion" class="btn btn-xl round btn-modal" style="float:right;background-color: gray;color:white;width:50px;height:50px;padding:6px 0px; border-radius:25px;text-align:center;line-height: 1.42857;"><i class="fa fa-plus fa-2x"></i></button>
    </div>
</div>
<div class="modal app-modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"></div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Update Exam
        $(document).on('submit', '#edit-exam', function(e) {
            e.preventDefault()
            const title = $('#title').val()
            const description = $('#description').val()
            $(document).find('small.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'PUT',
                    title,
                    description,
                },
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        window.location.href = res.url
                    }
                },
                error: function (res) {
                    $.each(res.responseJSON.data, function(key, error) {
                        $(document).find(`[name=${key}]`).after(`<small class="text-danger text-error">${error}</small>`)
                    })
                },
            })
        })

        // Add Question
        const mode = @json($data->questions_count) ? 'edit' : 'create'
        let counter = @json($data->questions_count) ? @json($data->questions_count) - 1 : 0

        $('#addquestion').click(function(e) {
            e.preventDefault()
            counter++
            const elementWhenCreate = `
                <div class="card" id="question${counter}">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Pertanyaan" id="title${counter}" name="questions[${counter}][title]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-2">
                                    <label for="image${counter}" style="float:right;"><i class="far fa-image fa-2x"></i></label>
                                    <input type="file" class="form-control" id="image${counter}" name="questions[${counter}][image]" onchange="onChangeFile(this)" data-status="create" hidden>
                                </div>
                            </div>
                            <div class="row" id="rowimage${counter}" style="display: none;">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <small><a id="titleimage${counter}" style="color: blue;text-decoration: underline;" href="javascript:void(0);"></a></small>
                                            <span class="ml-1" id="deleteimage${counter}" onclick="onClickIconDelete(this)" data-status="create" style="display: none;"><i style="color: red;" class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Kunci jawaban" id="answer_key${counter}" name="questions[${counter}][answer_key]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div>
                                    <a id="deletequestion${counter}" onclick="onClickDelete(this)"><i class="far fa-trash-alt fa-2x"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `
            const elementWhenEdit = `
                <div class="card" id="question${counter}">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input type="hidden" name="questions[${counter}][id]" value="-1">
                                            <input class="form-control" type="text" placeholder="Pertanyaan" id="title${counter}" name="questions[${counter}][title]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-2">
                                    <label for="image${counter}" style="float:right;"><i class="far fa-image fa-2x"></i></label>
                                    <input type="file" class="form-control" id="image${counter}" name="questions[${counter}][image]" onchange="onChangeFile(this)" data-status="create" hidden>
                                </div>
                            </div>
                            <div class="row" id="rowimage${counter}" style="display: none;">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <small><a id="titleimage${counter}" style="color: blue;text-decoration: underline;" href="javascript:void(0);"></a></small>
                                            <span class="ml-1" id="deleteimage${counter}" onclick="onClickIconDelete(this)" data-status="create" style="display: none;"><i style="color: red;" class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-11 col-10">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Kunci jawaban" id="answer_key${counter}" name="questions[${counter}][answer_key]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div>
                                    <a id="deletequestion${counter}" onclick="onClickDelete(this)"><i class="far fa-trash-alt fa-2x"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `

            if (mode == 'create') {
                $('#new-question').append(elementWhenCreate)
            } else {
                $('#new-question').append(elementWhenEdit)
            }
        })

        // Store Question
        $(document).on('submit', '#create-question', function(e) {
            e.preventDefault()
            const data = new FormData(this)
            $(document).find('small.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                contentType: false,
                processData: false,
                cache : false,
                success: function (res) {
                    if (res.status) {
                        window.location.href = res.url
                    }
                },
                error: function (res) {
                    $.each(res.responseJSON.data, function(key, error) {
                        const arrKey = key.split('.')
                        const newKey = `${arrKey[0]}[${arrKey[1]}][${arrKey[2]}]`
                        if (arrKey[2] == 'image') {
                            $(document).find(`[name="${arrKey[0]}[${arrKey[1]}][answer_key]"]`).before(`<small class="text-danger text-error">${error[0]}</small>`)
                        } else {
                            $(document).find(`[name="${newKey}"]`).after(`<small class="text-danger text-error">${error[0]}</small>`)
                        }
                    })
                },
            })
        })

        // Update Question
        $(document).on('submit', '#edit-question', function(e) {
            e.preventDefault()
            const data = new FormData(this)
            data.append('_method', 'PUT');
            $(document).find('small.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                contentType: false,
                processData: false,
                cache : false,
                success: function (res) {
                    if (res.status) {
                        window.location.href = res.url
                    }
                },
                error: function (res) {
                    $.each(res.responseJSON.data, function(key, error) {
                        const arrKey = key.split('.')
                        const newKey = `${arrKey[0]}[${arrKey[1]}][${arrKey[2]}]`
                        if (arrKey[2] == 'image') {
                            $(document).find(`[name="${arrKey[0]}[${arrKey[1]}][answer_key]"]`).before(`<small class="text-danger text-error">${error[0]}</small>`)
                        } else {
                            $(document).find(`[name="${newKey}"]`).after(`<small class="text-danger text-error">${error[0]}</small>`)
                        }
                    })
                },
            })
        })
    })
</script>
@endsection