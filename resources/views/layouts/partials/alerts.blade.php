@if ($message = session()->get('success'))
<div class="alert alert-success fade show" role="alert">
    <div class="alert-icon"><i class="fa flaticon2-check-mark"></i></div>
    <div class="alert-text">
        {{ $message }}
    </div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = session()->get('not_match'))
<div class="row justify-content-center">
    <div class="col-12">
        <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-5 kt-margin-b-25" role="alert">
            <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
            <div class="alert-text">
                <h4 class="alert-heading">Terjadi kesalahan !</h4>
                <p class="mb-0">
                    Password lama Anda tidak sesuai dengan yang Anda masukkan.
                </p>
            </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif


@if (request()->routeIs('profil*'))

@if ($errors->any())
<div class="row justify-content-center">
    <div class="col-12">
        <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-5 kt-margin-b-25" role="alert">
            <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
            <div class="alert-text">
                <h4 class="alert-heading">Terjadi kesalahan !</h4>
                @foreach ($errors->all() as $error)
                &#8226;&nbsp;{{ $error }}
                <br>
                @endforeach
                <hr>
                <p class="mb-0">
                    Mohon periksa kembali data yang Anda masukkan.
                </p>
            </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@else

@if ($errors->any())
<div class="row justify-content-center">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-5 kt-margin-b-25" role="alert">
            <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
            <div class="alert-text">
                <h4 class="alert-heading">Terjadi kesalahan !</h4>
                @foreach ($errors->all() as $error)
                &#8226;&nbsp;{{ $error }}
                <br>
                @endforeach
                <hr>
                <p class="mb-0">
                    Mohon periksa kembali data yang Anda masukkan.
                </p>
            </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@endif


