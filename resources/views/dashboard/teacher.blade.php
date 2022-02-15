@extends('layouts.app')

@section('content')
@include('flash::message')
<div class="row match-height">
    @if ($kelasMapelCount == 0)
    <div class="col-12" style="height: 75vh">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center">
                <h1>Silahkan tambahkan kelas untuk memulai</h1>
            <a class="btn btn-primary btn-modal" href="javascript:void(0);" data-href="{{ route('kelas-mapel.create') }}" data-container=".app-modal">Buat Kelas</a>
            </div>
        </div>
    </div>
    @else
    @foreach ($kelasMapel as $key => $value)
    <div class="col-xl-3 col-md-6 col-sm-12">
        <a class="card stretched-link" href="{{ route('kelas-mapel.show', [$value->id]) }}">
            <div class="card-header" style="padding-bottom: 100px; background-color: {{ $value->color ?? '#666ee8' }}"></div>
            <div class="card-content text-center" style="padding-top: 9px">
                <p class="h3 text-dark font-weight-bold">{{ $value->clas->name }}</p>
                <p class="h4 text-dark">{{ $value->subject->name }}</p>
            </div>
        </a>
    </div>
    @endforeach
    @endif
</div>
<div class="modal app-modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"></div>
@endsection
