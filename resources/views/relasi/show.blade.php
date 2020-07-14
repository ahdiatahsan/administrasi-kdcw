@extends('layouts.master')

@section('title', 'Relasi')

@section('vendor-css')
<link href="{{ asset("metronic/assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet"
    type="text/css" />
@endsection

@section('subheader-main')

<h3 class="kt-subheader__title">
    Relasi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Rincian Data Relasi </a>
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
                        Nama Instansi
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $relasi->nama }}
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
                        Email
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $relasi->email }}
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
                {{ $relasi->alamat }}
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Nomor Telepon
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $relasi->kontak }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Keterangan
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $relasi->keterangan }}
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
                        Logo Instansi
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="text-center">
                    @if (Storage::exists('public/relasi/' . $relasi->logo))
                    <a href="{{ Storage::url('public/relasi/' . $relasi->logo) }}" target="_blank">
                        <img class="img-fluid rounded text-center"
                            src="{{ Storage::url('public/relasi/' . $relasi->logo) }}" id="photo_preview"
                            style="max-height: 250px;">
                    </a>
                    <br><br>
                    <a class="btn btn-info" href="{{ Storage::url('public/relasi/' . $relasi->logo) }}" download>
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