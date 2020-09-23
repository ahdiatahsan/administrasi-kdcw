@extends('layouts.master')

@section('title', 'Dashboard')

@section('subheader-main')

<h3 class="kt-subheader__title">
    Dashboard
</h3>

@endsection

@section('content')

<div class="row">
  <div class="col-sm">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon"><i class="fa fa-file-alt"></i></span>
          <h3 class="kt-portlet__head-title">Administrasi</h3>
        </div>
      </div>
      <div>
        <div class="kt-widget1">
          <div class="kt-widget1__item">
            <div class="kt-widget1__info">
              <a href="{{ route('persuratan.index') }}" class="text-dark">
                <h5>Persuratan</h5>
              </a>
            </div>
            <span class="kt-widget1__number kt-font-info">{{ $persuratan }}</span>
          </div>

          <div class="kt-widget1__item">
            <div class="kt-widget1__info">
              <a href="{{ route('anggota.index') }}" class="text-dark">
                <h5>Data Anggota</h5>
              </a>
            </div>
            <span class="kt-widget1__number kt-font-info">{{ $anggota }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon"><i class="fa fa-boxes"></i></span>
          <h3 class="kt-portlet__head-title">Inventaris</h3>
        </div>
      </div>
      <div>
        <div class="kt-widget1">
          <div class="kt-widget1__item">
            <div class="kt-widget1__info">
              <a href="{{ route('barang.index') }}" class="text-dark">
                <h5>Data Barang</h5>
              </a>
            </div>
            <span class="kt-widget1__number kt-font-info">{{ $barang }}</span>
          </div>

          <div class="kt-widget1__item">
            <div class="kt-widget1__info">
              <a href="{{ route('peminjaman.index') }}" class="text-dark">
                <h5>Peminjaman</h5>
              </a>
            </div>
            <span class="kt-widget1__number kt-font-info">{{ $peminjaman }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon"><i class="fa fa-code-branch"></i></span>
          <a href="{{ route('relasi.index') }}" class="text-dark">
            <h3 class="kt-portlet__head-title">Relasi</h3>
          </a>
        </div>
      </div>
      <div>
        <div class="kt-widget1">
          <div class="kt-widget1__item justify-content-center">
            <span class="kt-widget1__number kt-font-info">{{ $relasi }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon"><i class="fa fa-dollar-sign"></i></span>
          <a href="{{ route('keuangan.index') }}" class="text-dark">
            <h3 class="kt-portlet__head-title">Saldo Keuangan</h3>
          </a>
        </div>
      </div>
      <div>
        <div class="kt-widget1">
          <div class="kt-widget1__item justify-content-center">
            <span class="kt-widget1__number kt-font-info">Rp. {{ $saldo }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
