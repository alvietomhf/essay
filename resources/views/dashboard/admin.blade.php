@extends('layouts.app')

@section('content')
<div class="row match-height justify-content-center">
    <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body d-flex justify-content-center">
                    <a href="{{ route('admin.kelas.index')  }}" class="btn btn-outline-primary">Kelas</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body d-flex justify-content-center">
                    <a href="{{ route('admin.mapel.index')  }}" class="btn btn-outline-primary">Mata Pelajaran</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body d-flex justify-content-center">
                    <a href="{{ route('admin.tapel.index')  }}" class="btn btn-outline-primary">Tahun Pelajaran</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body d-flex justify-content-center">
                    <a href="{{ route('admin.guru.index')  }}" class="btn btn-outline-primary">Guru</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
