@extends('layouts.app')

@section('header-href')
    {{ route('kelas-mapel.show', [$data->clasSubject->id]) }}
@endsection

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
<div class="row d-flex justify-content-center">
    <div class="col-10">
        @include('flash::message')
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('ujian.show', [$kelasId, $data->slug]) }}" style="color: grey"><i class="fa fa-arrow-left"></i> Kembali</a>
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Jawaban Soal Uraian</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered scroll-vertical">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama</th>
                                    <th colspan="{{ $data->questions_count }}">Nilai Similiarity</th>
                                    <th rowspan="2">Nilai Akhir</th>
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= $data->questions_count; $i++)
                                    <th>{{ $i < 10 ? '0' . $i : $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $value)
                                <tr>
                                    <td>{{ $value->number ?? '' }}</td>
                                    <td>
                                        <a href="javascript:void(0);" @if($value->results_count != 0) class="btn-modal" data-href="{{ route('result.show', [$kelasId, $data->slug, $value->id, $value->results[0]->id]) }}" data-container=".app-modal" @endif style="color: blue; text-decoration:underline;">
                                            {{ $value->name ?? '' }}
                                        </a>
                                    </td>
                                    @if ($value->results_count != 0)
                                    @foreach ($value->results as $key => $result)
                                    @foreach ($result->details as $key => $detail)
                                    <td>{{ $detail->similiarity_score ?? '' }}</td>
                                    @endforeach
                                    <td>{{ $result->score ?? '' }}</td>
                                    @endforeach
                                    @else
                                    @for ($i = 1; $i <= $data->questions_count; $i++)
                                    <td></td>
                                    @endfor
                                    <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal app-modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"></div>
@endsection

@section('js')
<script>
    $('.btn-change').on('click', function(e) {
        var btn = $(this);
        const message = btn.data('message')
        const confirm = btn.data('confirm')
        const value = btn.data('value')
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
        })
        e.stopPropagation();
        Swal.fire({
            title: 'Anda yakin?',
            text: `Anda akan ${message}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: btn.data('href'),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'PUT',
                        value,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if(res.status) {
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            }).then((result) => {
                                window.location.href = res.url
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: res.message
                            })
                        }
                    }
                })
            }
        })
    })

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
</script>
@endsection