@extends('layouts.app')

@section('header-color')
    {{ $data->color }}
@endsection

@section('header-clas')
<li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg"></i><span class="selected-language"></span></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item btn-modal" href="javascript:void(0);" data-href="{{ route('kelas-mapel.edit', [$data->id]) }}" data-container=".app-modal"><i class="fa fa-edit"></i> Edit Kelas</a>
        <a class="dropdown-item btn-delete" href="javascript:void(0);" data-href="{{ route('kelas-mapel.destroy', [$data->id]) }}"><i class="fa fa-trash"></i> Hapus Kelas</a>
    </div>
</li>
@endsection

@section('header-title')
    {{ $data->clas->name }} - {{ $data->subject->name == 'Teknologi Informasi & Komunikasi' ? 'TIK' : $data->subject->name }}
@endsection

@section('content')
@if ($examsCount == 0)
<div class="row match-height">
    <div class="col-12" style="height: 75vh">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center">
                <h1>Belum ada ujian yang dibuat, silahkan buat ujian baru</h1>
            <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('ujian.create', [$data->id]) }}" data-container=".app-modal">Buat Ujian</a>
            </div>
        </div>
    </div>
</div>
@else
<div class="row d-flex justify-content-center">
    <div class="col-10">
        @include('flash::message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="font-weight-bold">Daftar Ujian</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="border: none;"></th>
                                        <th style="border: none;" class="text-center">Terakhir diubah</th>
                                        <th style="border: none;" class="text-center">Kode ujian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $key => $value)
                                    <tr>
                                        <td><i class="fa fa-tasks" aria-hidden="true" style="color: #339966"></i><a href="{{ route('ujian.show', [$data->id, $value->slug]) }}" style="color: grey;"> {{ $value->title }} {{ $value->description ? '('.$value->description.')' : '' }}</a></td>
                                        <td class="text-center">{{ $value->updated_at ?? '' }}</td>
                                        <td class="text-center">{{ $value->code }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <a class="btn-modal" data-href="{{ route('ujian.create', [$data->id]) }}" data-container=".app-modal" style="float: right;"><i class="fa fa-plus fa-2x"></i></a>
    </div>
</div>
@endif
<div class="modal app-modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"></div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Store
        $(document).on('submit', '#create-exam', function(e) {
            e.preventDefault()
            const data = $(this).serialize()
            $(document).find('small.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
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
    })
</script>
@endsection