@extends('layouts.app')

@section('content')
<section id="configuration">
    <div class="row justify-content-center">
        <div class="col-8">
            @include('flash::message')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Guru</h4>
                    <div class="card-subtitle float-right">
                        <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('admin.guru.create') }}" data-container=".app-modal"><i class="ft-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Nomor HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->name ?? '' }}</td>
                                        <td>{{ $value->username ?? '' }}</td>
                                        <td>{{ $value->email ?? '' }}</td>
                                        <td>{{ $value->phone ?? '' }}</td>
                                        <td>
                                            <button data-href="{{ route('admin.guru.edit', [$value->id]) }}" data-container=".app-modal" class="btn btn-warning btn-sm btn-modal"><i class="ft-edit-2"></i> Edit</button>
                                            <button data-href="{{ route('admin.guru.destroy', [$value->id]) }}" class="btn btn-danger btn-sm btn-delete"><i class="ft-trash-2"></i> Hapus</button> 
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
        // Datatable
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
            ]
        })
        $(".buttons-copy, .buttons-print, .buttons-excel").removeClass("btn-secondary").addClass("btn btn-primary mr-1")

        // Toogle Password
        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass('ft-eye-off')
            const input = $('#password')
            input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
        })
        $(document).on('click', '.toggle-confirm-password', function() {
            $(this).toggleClass('ft-eye-off')
            const input2 = $('#password_confirmation')
            input2.attr('type') === 'password' ? input2.attr('type','text') : input2.attr('type','password')
        })

        // Store
        $(document).on('submit', '#create-teacher', function(e) {
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
        $(document).on('submit', '#edit-teacher', function(e) {
            e.preventDefault()
            const name = $('#name').val()
            const username = $('#username').val()
            const email = $('#email').val()
            const phone = $('#phone').val()
            const password = $('#password').val()
            const password_confirmation = $('#password_confirmation').val()
            $(document).find('small.text-error').remove()

            $.ajax({
                url: $(this).data('action'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'PUT',
                    name,
                    username,
                    email,
                    phone,
                    password,
                    password_confirmation,
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