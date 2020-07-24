@extends('layouts.master')

@section('title', 'Inventaris (Peminjaman)')

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
    <a href="" class="kt-subheader__breadcrumbs-link">
        Peminjaman </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Tabel Rekapan Peminjaman Barang </span>
</div>

@endsection

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fa fa-box-open"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Tabel Rekapan Peminjaman Barang
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="table-responsive">
        <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="table"
            role="grid" aria-describedby="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Peminjam </th>
                    <th>Jumlah Dipinjam</th>
                    <th>Tanggal Dipinjam</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Keterangan</th>
                    <th>Diterima Oleh</th>
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
      $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('rekap_peminjaman') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama_barang', name: 'nama_barang'},
          {data: 'peminjam', name: 'peminjam'},
          {data: 'jumlah', name: 'jumlah'},
          {data: 'tanggal_dipinjam', name: 'tanggal_dipinjam'},
          {data: 'tanggal_kembali', name: 'tanggal_kembali'},
          {data: 'keterangan', name: 'keterangan'},
          {data: 'diterima_oleh', name: 'diterima_oleh'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0],
          },
        ],
        pagingType: "full_numbers"
      });
    });
</script>
@endsection