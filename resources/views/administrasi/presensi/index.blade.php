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
        Tabel Data Presensi </span>
</div>

@endsection

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fa fa-calendar-check"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Tabel Data Presensi
            </h3>
        </div>
        @if (Auth::user() && Auth::user()->jabatan == '8')
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    &nbsp;
                    <a href="{{ route("presensi.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group row">
                    <div class="col-12">
                        <select class="form-control select2" name="filter_agenda" id="filter_agenda" required>
                            <option value="" selected hidden>- Pilih Agenda -</option>
                            @foreach ($agendas as $agenda)
                            <option value="{{ $agenda->id }}">
                                {{ $agenda->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <button type="button" name="filter" id="filter" class="btn btn-success">Filter</button>
                    <button type="button" name="reset" id="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                id="tabel_daftar_agenda" role="grid" aria-describedby="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Agenda</th>
                        <th>Tanggal Agenda</th>
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

<script src="{{ asset('plugins/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function () {

        $('.select2').select2();
        
        fill_datatable();

        function fill_datatable(filter_agenda = '') {
            //datatable-absen-terpenuhi
            var dataTable1 = $('#tabel_daftar_agenda').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    {extend: 'pageLength'},
                    {extend: 'excel', exportOptions: { columns: [ 0, 1, 2] } },
                ],
                ajax: {
                    "url"  : "{{ route('daftar_agenda') }}",
                    "data" : {filter_agenda:filter_agenda}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'agenda.nama', name: 'agenda.nama'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'},
                ],
                columnDefs: [
                    {
                    className: 'text-center',
                    targets: [0,3],
                    },
                ],
                pagingType: "full_numbers"
            });
        }

        //filter-button
        $('#filter').click(function(){
            var filter_agenda = $('#filter_agenda').val();
            if (filter_agenda != '') {
                $('#tabel_daftar_agenda').DataTable().destroy();
                fill_datatable(filter_agenda);
            } else {
                alert('Pilih filter agenda yang datanya ingin ditampilkan!');
            }
        })

        //reset-button
        $('#reset').click(function(){
            $('#filter_agenda').val('');
            $('#tabel_daftar_agenda').DataTable().destroy();
            fill_datatable(filter_agenda);
        })

    });
</script>

@endsection