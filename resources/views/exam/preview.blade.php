@extends('layouts.exam')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-10">
        @include('flash::message')
        <div class="text-center mb-2">
            <h4 class="text-bold-700">{{ $data->clasSubject->clas->name }} - {{ $data->clasSubject->subject->name }}</h4>
            <h4 class="text-bold-700">{{ $data->title }}</h4>
            @if ($data->description)
            <h4 class="text-bold-700">{{ $data->description }}</h4>
            @endif
        </div>
        <div class="d-flex flex-row">
            <h4 class="font-italic">No. Ujian: <h4 class="text-bold-700 ml-1">0001</h4></h4>
        </div>
        <div class="d-flex flex-row">
            <h4 class="font-italic">Nama: <h4 class="text-bold-700 ml-1">Ahmad Fulan</h4></h4>
        </div>
        <form class="mt-2" onsubmit="return false;">
            <div id="new-question">
                @foreach ($data->questions as $key => $value)
                <div class="card" id="question{{ $key }}">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input type="hidden" name="questions[{{ $key }}][id]" value="{{ $value->id }}">
                                            <h4 style="font-weight: 500;">{{ $value->title ?? '' }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <figure style="display: {{ $value->image ? 'block' : 'none' }};" class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                    <a href="javascript:void(0);" itemprop="contentUrl" data-size="480x360">
                                        <img class="img-thumbnail img-fluid" src="{{ asset('storage/images/' . $value->image) }}" itemprop="thumbnail" alt="Image description" />
                                    </a>
                                </figure>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Jawaban Anda" id="answer{{ $key }}" name="questions[{{ $key }}][answer]" required
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mb-1">
                <div class="col-12 d-flex justify-content-start">
                    <button class="btn btn-primary square px-2" style="color: white;" type="submit">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection