@extends('layouts.master')

@section('title', 'Anggota')

@section('vendor-css')
<link href="{{ asset("metronic/assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet"
    type="text/css" />
@endsection

@section('subheader-main')

<h3 class="kt-subheader__title">
    Anggota
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Rincian Data Anggota </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Nama Lengkap
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->nama }}
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        No. Registrasi Anggota
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->noreg }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Jabatan
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->jabatans->nama }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Alamat
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->alamat }}
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Email
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->email }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Kontak
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->kontak }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Status Surat
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $user->status_surat }}
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Foto Anggota
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="text-center">
                    @if (Storage::exists('public/user/' . $user->foto))
                    <a href="{{ Storage::url('public/user/' . $user->foto) }}" target="_blank">
                        <img class="img-fluid rounded text-center"
                            src="{{ Storage::url('public/user/' . $user->foto) }}" id="photo_preview"
                            style="max-height: 250px;">
                    </a>
                    <br><br>
                    <a class="btn btn-info" href="{{ Storage::url('public/user/' . $user->foto) }}" download>
                        <i class="fa fa-file-download"></i>
                        Unduh Foto
                    </a>
                    @else
                    <img class="img-fluid rounded text-center" src="{{ asset('img/image.png') }}" id="photo_preview"
                        style="max-height: 250px;">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection