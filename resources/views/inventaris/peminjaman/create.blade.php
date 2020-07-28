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
        Tambah Data Peminjaman Barang </span>
</div>

@endsection

@section('content')

<form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tambah Data Peminjaman Barang
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label>Nama Barang</label><span class="text-danger">*</span></label>
                        <select class="form-control select2 @error('barang') is-invalid @enderror" id="barang"
                            name="barang" required>
                            <option value="" disabled selected>-- Daftar Barang --</option>
                            @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" data-tersedia="{{ $barang->tersedia }}">
                                {{ $barang->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang Tersedia<span class="text-danger">*</span></label>
                        <input class="form-control @error('tersedia') is-invalid @enderror" type="text" name="tersedia"
                            id="tersedia" hidden>
                        <input class="form-control @error('stok') is-invalid @enderror" type="text" name="stok"
                            id="stok" disabled>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang Dipinjam<span class="text-danger">*</span></label>
                        <input class="form-control @error('jumlah') is-invalid @enderror" type="number" name="jumlah"
                            id="jumlah" value="{{ old('jumlah') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Peminjam<span class="text-danger">*</span></label>
                        <input class="form-control @error('peminjam') is-invalid @enderror" type="text" name="peminjam"
                        id="peminjam" value="{{ old('peminjam') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Peminjaman<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" 
                            value="{{ old('tanggal') }}" placeholder="Pilih tanggal peminjaman barang" required readonly> 
                    </div>

                    <div class="form-group">
                        <label>Keterangan<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="keterangan" rows="2" placeholder="Keterangan barang yang dipinjam"
                            required>{{ old('keterangan') }}</textarea>
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
    $('#tanggal').datepicker({
        format: 'dd-mm-yyyy'
    });
  });

  $('#barang').on('change',function(){
    var tersedia = $(this).children('option:selected').data('tersedia');
    $('#tersedia').val(tersedia);
    $('#stok').val(tersedia);
  });
</script>

@endsection