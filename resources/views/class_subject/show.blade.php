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
{{-- <div class="row match-height">
    <div class="col-12" style="height: 75vh">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center">
                <h1>Belum ada ujian yang dibuat, silahkan buat ujian baru</h1>
            <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('kelas-mapel.create') }}" data-container=".app-modal">Buat Ujian</a>
            </div>
        </div>
    </div>
</div> --}}
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
                                    <tr>
                                        <td><i class="fa fa-tasks" aria-hidden="true" style="color: #339966"></i> Ulangan Harian 1</td>
                                        <td class="text-center">2 Jan</td>
                                        <td class="text-center">zxy62</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-tasks" aria-hidden="true" style="color: #339966"></i> Ulangan Harian 2 (Software Design)</td>
                                        <td class="text-center">29 Jan</td>
                                        <td class="text-center">vgtr2</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-tasks" aria-hidden="true" style="color: #339966"></i> Ulangan Harian 3</td>
                                        <td class="text-center">14 Feb</td>
                                        <td class="text-center">29yh1</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-tasks" aria-hidden="true" style="color: #339966"></i> Ujian Tengah Semester Genap</td>
                                        <td class="text-center">1 Mar</td>
                                        <td class="text-center">6jih9</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <a data-href="{{ route('kelas-mapel.create') }}" data-container=".app-modal" style="float: right;"><i class="fa fa-plus fa-2x"></i></a>
    </div>
</div>
<div class="modal app-modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"></div>
@endsection