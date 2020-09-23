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
        Ubah Data Peminjaman Barang </span>
</div>

@endsection

@section('content')

<form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Ubah Data Peminjaman Barang
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
                        <input type="hidden" name="old_nama" value="{{ $barang->nama }}">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                            id="nama" value="{{ $barang->nama }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Batas Ubah Jumlah Barang<span class="text-danger">*</span></label>
                        <input class="form-control @error('batas') is-invalid @enderror" type="text" name="batas"
                            id="batas" value="{{ $batas }}" hidden>
                        <input class="form-control @error('batas_show') is-invalid @enderror" type="text" name="batas_show"
                            id="batas_show" value="{{ $batas }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang Dipinjam<span class="text-danger">*</span></label>
                        <input class="form-control @error('jumlah') is-invalid @enderror" type="number" name="old_jumlah"
                            id="old_jumlah" value="{{ $peminjaman->jumlah }}" hidden>
                        <input class="form-control @error('jumlah') is-invalid @enderror" type="number" name="jumlah"
                            id="jumlah" value="{{ $peminjaman->jumlah }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Peminjam<span class="text-danger">*</span></label>
                        <input class="form-control @error('peminjam') is-invalid @enderror" type="text" name="peminjam"
                        id="peminjam" value="{{ $peminjaman->peminjam }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Peminjaman<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal"
                            value="{{ date('d-m-Y', strtotime($peminjaman->tanggal_pinjam)) }}" required readonly>
                    </div>

                    <div class="form-group">
                        <label>Keterangan<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="keterangan" rows="2" placeholder="Keterangan"
                            required>{{ $peminjaman->keterangan }}</textarea>
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
</script>

@endsection