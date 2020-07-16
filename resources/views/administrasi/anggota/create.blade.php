@extends('layouts.master')

@section('title', 'Anggota')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Anggota
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tambah Data Anggota </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tambah Data Anggota
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Lengkap<span class="text-danger">*</span></label>
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                            id="nama" placeholder="Taylor Otwell" value="{{ old('nama') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Email<span class="text-danger">*</span></label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                            id="email" placeholder="taylorotwell@kedai.or.id" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Password<span class="text-danger">*</span></label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                            name="password" id="password" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password<span class="text-danger">*</span></label>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                            name="password_confirmation" id="password-confirm" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label>No. Registrasi Anggota<span class="text-danger">*</span></label>
                        <input class="form-control @error('noreg') is-invalid @enderror" type="text" name="noreg"
                            id="noreg" placeholder="851.KD.XVIII.19" value="{{ old('noreg') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control select2 @error('jabatan') is-invalid @enderror" id="jabatan"
                            name="jabatan" required>
                            @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">
                                {{ $jabatan->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kontak <span class="text-danger">*</span></label>
                        <input class="form-control @error('kontak') is-invalid @enderror" type="tel" name="kontak"
                            id="kontak" placeholder="+62 00011112222" value="{{ old('kontak') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                            rows="2" placeholder="BTP Blok.M No.541" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Status Surat</label><span class="text-danger">*</span></label>
                        <select class="form-control @error('surat') is-invalid @enderror" id="surat" name="surat"
                            required>
                            <option value="Kosong" selected>Kosong</option>
                            <option value="SP 1">Surat Peringatan 1</option>
                            <option value="SP 2">Surat Peringatan 2</option>
                            <option value="SP 3">Surat Peringatan 3</option>
                        </select>
                    </div>

                    <div class="form-group form-group-last">
                        <label>Foto</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                            id="photo" required>
                        <small class="text-danger">Format foto yang diterima adalah jpeg, jpg, png, webp dengan ukuran
                            maksimal 500
                            KB.</small>
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
    $(document).ready(function () {
        $('.select2').select2();
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