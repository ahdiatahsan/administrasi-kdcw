@extends('layouts.master')

@section('title', 'Presensi')

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
    <a href="{{ route('presensi.index') }}" class="kt-subheader__breadcrumbs-link">
        Presensi </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Rincian Data Presensi </span>
</div>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Agenda
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $agendas->nama }}
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Tanggal Agenda
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $tanggal }}
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
                        Catatan
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{ $presensi->catatan }}
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fa fa-calendar-check"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Tabel Log Presensi
                    </h3>
                </div>
                @if (Auth::user() && Auth::user()->jabatan == '8')
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{ route('logpresensi_tambah', $presensi->id) }}"
                                class="btn btn-brand btn-elevate btn-icon-sm">
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
                    <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                        id="table" role="grid" aria-describedby="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Registrasi Anggota</th>
                                <th>Nama Lengkap</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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

<script src="{{ asset('plugins/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function () {
      var presensi = "{{ $presensi->id }}";
      var url = '{{ route("log_presensi", ":presensi") }}';
      url = url.replace(':presensi', presensi);

      var namafile = "Presensi "+"{{ $agendas->nama }}"+" - "+"{{ $tanggal }}";
      
      $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfrtip',
        buttons: [
            {extend: 'pageLength'},
            {extend: 'excelHtml5',
                filename: namafile,
                title: null, 
                exportOptions: { columns: [ 0, 1, 2] },
                customize: function ( xlsx ){
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
 
                    // jQuery selector to add a border
                    $('row c*', sheet).attr( 's', '25' );
                }
            },
        ],
        ajax: url,
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'user.noreg', name: 'user.noreg'},
          {data: 'user.nama', name: 'user.nama'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0,1,2],
          },
        ],
        pagingType: "full_numbers"
      });
    });
</script>

@endsection