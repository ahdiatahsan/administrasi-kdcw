@extends('layouts.master')

@section('title', 'Relasi')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Relasi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Ubah Data Relasi </span>
</div>

@endsection

@section('content')

<form action="{{ route('relasi.update', $relasi->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Ubah Data Relasi
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route('relasi.index') }}" class="btn btn-clean">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Instansi<span class="text-danger">*</span></label>
                        <input type="hidden" name="old_nama" value="{{ $relasi->nama }}">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                            id="nama" value="{{ $relasi->nama }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Alamat<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                            rows="2" required>{{ $relasi->alamat }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Email<span class="text-danger">*</span></label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                            id="email" value="{{ $relasi->email }}" required>
                    </div>

                    <div class="form-group">
                        <label>Kontak <span class="text-danger">*</span></label>
                        <input class="form-control @error('kontak') is-invalid @enderror" type="tel" name="kontak"
                            id="kontak" value="{{ $relasi->kontak }}" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="keterangan" rows="2" placeholder="Keterangan"
                            required>{{ $relasi->keterangan }}</textarea>
                    </div>

                    <div class="form-group form-group-last">
                        <label>Logo Instansi</label><span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                            id="photo">
                        <small class="text-danger">Format logo yang diterima adalah jpeg, jpg, png, webp dengan ukuran
                            maksimal 1 MB.</small>
                        <br><br><br>
                        <div class="text-center">
                            @if (Storage::exists('public/relasi/' . $relasi->logo))
                            <img class="img-fluid rounded text-center"
                                src="{{ Storage::url('public/relasi/' . $relasi->logo) }}" id="photo_preview"
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