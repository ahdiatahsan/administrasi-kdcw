@extends('layouts.master')

@section('title', 'Inventaris (Barang)')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Inventaris
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('barang.index') }}" class="kt-subheader__breadcrumbs-link">
        Barang </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Tambah Data Barang </span>
</div>

@endsection

@section('content')

<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tambah Data Barang
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route('barang.index') }}" class="btn btn-clean">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Barang<span class="text-danger">*</span></label>
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                            id="nama" placeholder="Papan Tulis" value="{{ old('nama') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Kondisi Barang</label><span class="text-danger">*</span></label>
                        <select class="form-control @error('kondisi') is-invalid @enderror" id="kondisi" 
                            name="kondisi" required>
                            <option value="Layak Pakai">Layak Pakai</option>
                            <option value="Tidak Layak Pakau">Tidak Layak Pakai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang<span class="text-danger">*</span></label>
                        <input class="form-control @error('jumlah') is-invalid @enderror" type="number" name="jumlah"
                            id="jumlah" value="{{ old('jumlah') }}" required>
                    </div>

                    <div class="form-group form-group-last">
                        <label>Foto</label><span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                            id="photo" required>
                        <small class="text-danger">Format foto yang diterima adalah jpeg, jpg, png, webp dengan ukuran
                            maksimal 1 MB.</small>
                        <br><br><br>
                        <div class="text-center">
                            <img class="img-fluid rounded text-center" src="{{ asset('img/image.png') }}"
                                id="photo_preview" style="max-height: 250px;">
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-12 kt-align-center">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-plus"></i>
                                Tambah Data
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