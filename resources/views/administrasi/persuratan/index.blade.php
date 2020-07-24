@extends('layouts.master')

@section('title', 'Persuratan')

@section('vendor-css')
<link href="{{ asset("metronic/assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet"
    type="text/css" />
@endsection

@section('subheader-main')

<h3 class="kt-subheader__title">
    Administrasi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Persuratan </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Tabel Data Persuratan </span>
</div>

@endsection

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fa fa-envelope"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Tabel Data Persuratan
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    &nbsp;
                    <a href="{{ route("persuratan.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-success" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#suratMasuk" role="tab">Surat Masuk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#suratKeluar" role="tab">Surat Keluar</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="suratMasuk" role="tabpanel">
                <div class="table-responsive">
                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover suratMasuk no-footer dtr-inline" id="table"
                    role="grid" aria-describedby="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Surat</th>
                            <th>Judul</th>
                            <th>Dari</th>
                            <th>Tanggal</th>
                            <th>Created_By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                </div>
                <!--end: Datatable -->
            </div>
            <div class="tab-pane" id="suratKeluar" role="tabpanel">
                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover suratKeluar no-footer dtr-inline" id="table"
                    role="grid" aria-describedby="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Surat</th>
                            <th>Judul</th>
                            <th>Kepada</th>
                            <th>Tanggal</th>
                            <th>Created_By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('vendor-js')
<script src="{{ asset("metronic/assets/plugins/custom/datatables/datatables.bundle.js") }}" type="text/javascript">
</script>
@endsection

@section('js')
<script>
    $(document).ready(function () {
      $('.suratMasuk').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('surat_masuk') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'no_surat', name: 'no_surat'},
          {data: 'judul', name: 'judul'},
          {data: 'dari_kepada', name: 'dari_kepada'},
          {data: 'tanggal', name: 'tanggal'},
          {data: 'user.nama', name: 'user.nama'},
          {data: 'action', name: 'action'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0,6],
          },
        ],
        pagingType: "full_numbers"
      });
      $('.suratKeluar').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('surat_keluar') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'no_surat', name: 'no_surat'},
          {data: 'judul', name: 'judul'},
          {data: 'dari_kepada', name: 'dari_kepada'},
          {data: 'tanggal', name: 'tanggal'},
          {data: 'user.nama', name: 'user.nama'},
          {data: 'action', name: 'action'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0,6],
          },
        ],
        pagingType: "full_numbers"
      });
    });
</script>
@endsection