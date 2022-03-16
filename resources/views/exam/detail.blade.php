<style>
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 250px;
    overflow-y: auto;
}
@media (min-height: 500px) {
    .modal-body { height: 400px; }
}
@media (min-height: 800px) {
    .modal-body { height: 600px; }
}
</style>
<div class="modal-lg modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Detail Jawaban</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach ($result->details as $key => $value)
                <div class="col-12">
                    <h5 style="font-weight: 500;">{{ $loop->iteration }}. {{ $value->question->title ?? '' }}</h5>
                    <h5 style="font-weight: 500;">- {{ $value->answer ?? '' }}</h5>
                    <hr>
                </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button data-href="{{ route('result.destroy', [$kelasId, $exam->slug, $result->id]) }}" class="btn btn-outline-danger btn-destroy">Hapus</button>
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
<script>
$('.btn-destroy').on('click', function(e) {
    var btn = $(this);
    e.stopPropagation();
    Swal.fire({
        title: 'Anda yakin?',
        text: 'Anda akan menghapus data ini!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: btn.data('href'),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(res) {
                    if(res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message
                        }).then((result) => {
                            window.location.href = res.url
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message
                        })
                    }
                }
            })
        }
    })
})
</script>