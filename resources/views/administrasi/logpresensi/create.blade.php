@extends('layouts.master')

@section('title', 'Log Presensi')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Administrasi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('presensi.index') }}" class="kt-subheader__breadcrumbs-link">
        Log Presensi </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Tambah Data Log Presensi </span>
</div>

@endsection

@section('content')

<form action="{{ route('logpresensi.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tambah Data Log Presensi
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ url()->previous() }}" class="btn btn-clean">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Agenda</label>
                        <input class="form-control @error('agenda') is-invalid @enderror" type="text" name="agenda"
                            id="agenda" value="{{ $agendas->nama }}" readonly required>
                        <input type="text" name="presensi" id="presensi" value="{{ $presensis->id }}" hidden required>

                    </div>

                    <div class="form-group">
                        <label>Tanggal Agenda</label>
                        <input class="form-control @error('tanggal') is-invalid @enderror" type="text" name="tanggal"
                            id="tanggal" value="{{ $tanggal }}" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Registrasi Anggota<span class="text-danger">*</span></label>
                        <input class="form-control @error('noreg') is-invalid @enderror" type="text" name="noreg"
                            id="noreg" value="{{ old('noreg') }}" required autofocus>
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
</script>

@endsection