@extends('layouts.master')

@section('title', 'Persuratan')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Administrasi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('persuratan.index') }}" class="kt-subheader__breadcrumbs-link">
        Persuratan </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Ubah Data Persuratan </span>
</div>

@endsection

@section('content')

<form action="{{ route('persuratan.update', $persuratan->id) }}" method="POST" enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Ubah Data Persuratan
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nomor Surat<span class="text-danger">*</span></label>
                        <input type="hidden" name="old_no_surat" value="{{ $persuratan->no_surat }}">
                        <input class="form-control @error('no_surat') is-invalid @enderror" type="text" name="no_surat"
                            id="no_surat" value="{{ $persuratan->no_surat }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Judul Surat<span class="text-danger">*</span></label>
                        <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul"
                            id="judul" value="{{ $persuratan->judul }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Surat</label><span class="text-danger">*</span></label>
                        <select class="form-control @error('jenis_surat') is-invalid @enderror" id="jenis_surat"
                            name="jenis_surat" required>
                            <option value="Surat Masuk" {{ ($persuratan->jenis_surat == 'Surat Masuk') ? 'selected' : '' }}>
                                Surat Masuk</option>
                            <option value="Surat Keluar" {{ ($persuratan->jenis_surat == 'Surat Keluar') ? 'selected' : '' }}>
                                Surat Keluar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dari / Kepada<span class="text-danger">*</span></label>
                        <input class="form-control @error('dari_kepada') is-invalid @enderror" type="text"
                            name="dari_kepada" id="dari_kepada" value="{{ $persuratan->dari_kepada }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Surat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                            value="{{ date('d-m-Y', strtotime($persuratan->tanggal)) }}" required readonly>
                    </div>

                    <div class="form-group form-group-last">
                        <label>Foto Surat</label><span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                            id="photo">
                        <small class="text-danger">Format foto yang diterima adalah jpeg, jpg, png, webp dengan ukuran
                            maksimal 1 MB.</small>
                        <br><br><br>
                        <div class="text-center">
                            @if (Storage::exists('public/administrasi/' . $persuratan->foto))
                            <img class="img-fluid rounded text-center"
                                src="{{ Storage::url('public/administrasi/' . $persuratan->foto) }}" id="photo_preview"
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
  $(document).ready(function () {
    $('#tanggal').datepicker({
        format: 'dd-mm-yyyy'
    });
  });

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