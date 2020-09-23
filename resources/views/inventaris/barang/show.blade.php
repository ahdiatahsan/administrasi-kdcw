@extends('layouts.master')

@section('title', 'Inventaris (Barang)')

@section('vendor-css')
<link href="{{ asset("metronic/assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet"
    type="text/css" />
@endsection

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
        Rincian Data Barang </span>
</div>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Nama Barang
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $barang->nama }}
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
                        kondisi Barang
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $barang->kondisi }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Jumlah Tersedia
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $barang->tersedia }}
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Total Jumlah Barang
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $total }}
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Jumlah Dipinjam
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $barang->dipinjam }}
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
                        Foto Barang
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="text-center">
                    @if (Storage::exists('public/inventaris/' . $barang->foto))
                    <a href="{{ Storage::url('public/inventaris/' . $barang->foto) }}" target="_blank">
                        <img class="img-fluid rounded text-center"
                            src="{{ Storage::url('public/inventaris/' . $barang->foto) }}" id="photo_preview"
                            style="max-height: 250px;">
                    </a>
                    <br><br>
                    <a class="btn btn-info" href="{{ Storage::url('public/inventaris/' . $barang->foto) }}" download>
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