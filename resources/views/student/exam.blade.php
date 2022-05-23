@extends('layouts.exam')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-10">
        <div class="text-center mb-2">
            <h4 class="text-bold-700">{{ $data->clasSubject->clas->name }} - {{ $data->clasSubject->subject->name }}</h4>
            <h4 class="text-bold-700">{{ $data->title }}</h4>
            @if ($data->description)
            <h4 class="text-bold-700">{{ $data->description }}</h4>
            @endif
        </div>
        <div class="d-flex flex-row">
            <h4 class="font-italic">No. Ujian: <h4 class="text-bold-700 ml-1">{{ $student->number ?? '' }}</h4></h4>
        </div>
        <div class="d-flex flex-row">
            <h4 class="font-italic">Nama: <h4 class="text-bold-700 ml-1">{{ $student->name ?? '' }}</h4></h4>
        </div>
        <form id="submit-exam" data-action="{{ route('student.exam.store', [$kelasId, $data->slug, $student->id]) }}" class="mt-2">
            @foreach ($data->questions as $key => $value)
            <div class="card" id="question{{ $key }}">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-body">
                                    <div class="form-group">
                                        <input type="hidden" name="questions[{{ $key }}][id]" value="{{ $value->id }}">
                                        <h4 style="font-weight: 500; white-space: pre-wrap;">{{ $value->title ?? '' }}</h4>
                                    </div>
                                </div>
                            </div>
                            <figure style="display: {{ $value->image ? 'block' : 'none' }};" class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                <a href="javascript:void(0);" itemprop="contentUrl" data-size="480x360">
                                    <img class="img-thumbnail img-fluid" src="{{ $value->image ? asset('storage/images/' . $value->image) : '' }}" itemprop="thumbnail" alt="Image description" style="border-style: none; padding: 0"/>
                                </a>
                            </figure>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-body">
                                    <div class="form-group">
                                        {{-- <input class="form-control" type="text" placeholder="Jawaban Anda" id="answer{{ $key }}" name="questions[{{ $key }}][answer]" required
                                        oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                        oninput="this.setCustomValidity('')"> --}}
                                        <textarea class="form-control" name="questions[{{ $key }}][answer]" id="answer{{ $key }}" cols="30" rows="3" placeholder="Jawaban Anda" required
                                        oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                        oninput="this.setCustomValidity('')"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row mb-1">
                <div class="col-12 d-flex justify-content-start">
                    <button class="btn btn-primary square px-2" style="color: white;" type="submit">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Store
        $(document).on('submit', '#submit-exam', function(e) {
            e.preventDefault()
            const data = $(this).serialize()

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            Swal.fire({
                title: 'Anda yakin?',
                text: `Anda akan mengirim ujian`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: $(this).data('action'),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        dataType: 'json',
                        success: function (res) {
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
                        },
                    })
                }
            })
        })
    })
</script>
@endsection