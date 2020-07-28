@extends('layouts.master')

@section('title', 'Inventaris (Peminjaman)')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Inventaris
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('peminjaman.index') }}" class="kt-subheader__breadcrumbs-link">
        Peminjaman </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Pengembalian Barang Yang Dipinjam</span>
</div>

@endsection

@section('content')

<form action="{{ route('kembalikan.store', $peminjaman->id) }}" method="POST" enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Pengembalian Barang Yang Dipinjam
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-clean">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Kembali</span>
                        </a>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Barang<span class="text-danger">*</span></label>
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                        <input type="hidden" name="nama" value="{{ $barang->nama }}">
                        <input class="form-control" type="text" value="{{ $barang->nama }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang Dipinjam<span class="text-danger">*</span></label>
                        <input type="hidden" name="jumlah" value="{{ $peminjaman->jumlah }}">
                        <input class="form-control" type="number" value="{{ $peminjaman->jumlah }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Nama Peminjam<span class="text-danger">*</span></label>
                        <input type="hidden" name="peminjam" value="{{ $peminjaman->peminjam }}">
                        <input class="form-control" type="text" value="{{ $peminjaman->peminjam }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Peminjaman - Tanggal Pengembalian<span class="text-danger">*</span></label>
                        <input type="hidden" name="tanggal_pinjam"
                            value="{{ $peminjaman->tanggal_pinjam }}" hidden>
                        <div class="input-daterange input-group">
                            <input type="text" class="form-control" id="tanggal_pinjam" placeholder="Tanggal Peminjaman Barang"
                                value="{{ date('d-m-Y', strtotime($peminjaman->tanggal_pinjam)) }}" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text"> - </span>
                            </div>
                            <input class="form-control" type="text" name="tanggal_kembali" id="tanggal_kembali"
                                placeholder="Tanggal Pengembalian Barang" value="{{ old('tanggal') }}" required readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan Barang Setelah Pengembalian<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="keterangan" rows="2" required>{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                <div class="kt-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-12 kt-align-center">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-reply"></i>
                                Kembalikan Barang
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
    
    var date = document.getElementById('tanggal_pinjam').value

    $('#tanggal_kembali').datepicker({
        format: 'dd-mm-yyyy',
        orientation: "auto",
        startDate: date
    });

  });
</script>

@endsection