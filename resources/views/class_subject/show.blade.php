@extends('layouts.app')

@section('header-title')
    {{ $data->clas->name }} - {{ $data->subject->name == 'Teknologi Informasi & Komunikasi' ? 'TIK' : $data->subject->name }}
@endsection

@section('content')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h4 class="font-weight-bold">Memulai ujian baru</h4>
            <div class="row d-flex justify-content-center">
                <button href="" class="btn btn-primary py-1 px-2 mt-1" style="width:150px;">Ulangan Harian</button>
                <button href="" class="btn btn-primary py-1 px-2 mt-1 mx-3" style="width:150px;">Ujian Tengah Semester</button>
                <button href="" class="btn btn-primary py-1 px-2 mt-1" style="width:150px;">Ujian Akhir Semester</button>
            </div>
            <h4 class="font-weight-bold">Daftar Ujian</h4>
            <div class="row d-flex justify-content-center">
                <div class="col-12">
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
    </div>
</div>
@endsection