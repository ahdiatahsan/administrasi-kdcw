@extends('layouts.master')

@section('title', 'Jabatan')

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
    <a href="{{ route('jabatan.index') }}" class="kt-subheader__breadcrumbs-link">
        Jabatan </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Tabel Data Jabatan </span>
</div>

@endsection

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fa fa-sitemap"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Tabel Data Jabatan
            </h3>
        </div>
        @if (Auth::user() && Auth::user()->jabatan == '8')
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    &nbsp;
                    <a href="{{ route("jabatan.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <div class="kt-portlet__body">
        <div class="table-responsive">
        <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="table"
            role="grid" aria-describedby="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Jabatan</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        </div>
        <!--end: Datatable -->
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
      var jabatan = "{{ Auth::user()->jabatan }}";
      var showColumn = jabatan == 8 ? true:false;
      
      $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('jabatan.index') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama'},
          {data: 'action', name: 'action'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0,1,2],
          },
          {
            visible : showColumn,
            targets: [2],
          },
        ],
        pagingType: "full_numbers"
      });
    });
</script>
@endsection