@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
        <strong>{{ Session::get('success')??'Berhasil' }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{Session::get('warning')??'Gagal'}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
