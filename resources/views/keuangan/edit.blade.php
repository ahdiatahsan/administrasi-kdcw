@extends('layouts.master')

@section('title', 'Keuangan')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Keuangan
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Ubah Data Keuangan </span>
</div>

@endsection

@section('content')

<form action="{{ route('keuangan.update', $keuangan->id) }}" method="POST" enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Ubah Data Keuangan
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Keterangan Dana<span class="text-danger">*</span></label>
                        <input type="hidden" name="old_keterangan" value="{{ $keuangan->keterangan }}">
                        <input class="form-control @error('keterangan') is-invalid @enderror" type="text"
                            name="keterangan" id="keterangan" value="{{ $keuangan->keterangan }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Nominal (Rp.)<span class="text-danger">*</span></label>
                        <input class="form-control @error('nominal') is-invalid @enderror" type="numeric" name="nominal"
                            id="nominal" value="{{ $keuangan->nominal }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Dana</label><span class="text-danger">*</span></label>
                        <select class="form-control @error('jenis_dana') is-invalid @enderror" 
                            id="jenis_dana" name="jenis_dana" required>
                            <option value="Dana Masuk" {{ ($keuangan->jenis_dana == 'Dana Masuk') ? 'selected' : '' }}>
                                Dana Masuk
                            </option>
                            <option value="Dana Keluar" {{ ($keuangan->jenis_dana == 'Dana Keluar') ? 'selected' : '' }}>
                                Dana Keluar
                            </option>
                        </select>
                    </div>

                    <div class="form-group form-group-last">
                        <label>Foto Nota</label><span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                            id="photo">
                        <small class="text-danger">Format nota yang diterima adalah jpeg, jpg, png, webp dengan ukuran
                            maksimal 2 MB.</small>
                        <br><br><br>
                        <div class="text-center">
                            @if (Storage::exists('public/keuangan/' . $keuangan->nota))
                            <img class="img-fluid rounded text-center"
                                src="{{ Storage::url('public/keuangan/' . $keuangan->nota) }}" id="photo_preview"
                                style="max-height: 250px;">
                            @else
                            <img class="img-fluid rounded text-center" src="{{ asset('img/image.png') }}"
                                id="photo_preview" style="max-height: 250px;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-12 kt-align-center">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                                Ubah Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')

<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#photo_preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photo").change(function () {
    readURL(this);
  });
</script>

@endsection