@extends('layouts.master')

@section('title', 'Presensi')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Administrasi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('presensi.index') }}" class="kt-subheader__breadcrumbs-link">
        Presensi </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Ubah Data Presensi </span>
</div>

@endsection

@section('content')

<form action="{{ route('presensi.update', $presensi->id) }}" method="POST" enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Ubah Data Presensi
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route('presensi.index') }}" class="btn btn-clean">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class=" form-group">
                        <input type="text" class="form-control" name="old_agenda" id="old_agenda"
                            value="{{ $presensi->agenda }}" required hidden>
                    </div>

                    <div class="form-group">
                        <label>Agenda</label>
                        <select class="form-control select2 @error('agenda') is-invalid @enderror" id="agenda"
                            name="agenda" required>
                            @foreach ($agendas as $agenda)
                            <option value="{{ $agenda->id }}"
                                {{ ($agenda->id == $selectedAgenda->agenda) ? 'selected' : '' }}>
                                {{ $agenda->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="alamat"
                            rows="6" " required>{{ $presensi->catatan }}</textarea>
                    </div>

                    <div class=" form-group">
                        <label>Tanggal Agenda<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                            value="{{ date('d-m-Y', strtotime($presensi->created_at)) }}" required disabled readonly>
                    </div>
                </div>

                <div class=" kt-portlet__foot">
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
        $('.select2').select2();
        $('#tanggal').datepicker({
            format: 'dd-mm-yyyy'
        });
    });
</script>

@endsection