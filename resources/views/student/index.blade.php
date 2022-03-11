@extends('layouts.app')

@section('content')
<section id="configuration">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.kelas.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </li>
                    </ol>
                </div>
            </div>
            @include('flash::message')
            <div class="card mt-1">
                <div class="card-header">
                    <h4 class="card-title">Data Siswa {{ $clas->name }}</h4>
                    <div class="card-subtitle float-right">
                        <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('admin.kelas-siswa.create', [$clas->id]) }}" data-container=".app-modal"><i class="ft-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Ujian</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->number ?? '' }}</td>
                                        <td>{{ $value->name ?? '' }}</td>
                                        <td>
                                            <button data-href="{{ route('admin.kelas-siswa.edit', [$clas->id, $value->id]) }}" data-container=".app-modal" class="btn btn-warning btn-sm btn-modal"><i class="ft-edit-2"></i> Edit</button>
                                            <button data-href="{{ route('admin.kelas-siswa.destroy', [$clas->id, $value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="ft-trash-2"></i> Hapus</button> 
                                        </td>
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
</section>
<div class="modal app-modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"></div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Store
        $(document).on('submit', '#create-student', function(e) {
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

        // Update
        $(document).on('submit', '#edit-student', function(e) {
            e.preventDefault()
            const number = $('#number').val()
            const name = $('#name').val()
            $(document).find('small.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'PUT',
                    number,
                    name,
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
    })
</script>
@endsection