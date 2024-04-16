@extends('layouts.admin')

@section('title')
    Admin Transaction
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">List Transaction</h1>

    <div class="row mb-4">
      <div class="col-lg-6">
        <div class="card shadow">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="tglawal">Tanggal Awal Transaksi</label>
                <input type="date" class="form-control" id="tglawal">
              </div>
              <div class="form-group col-md-6">
                <label for="tglakhir">Tanggal Akhir Transaksi</label>
                <input type="date" class="form-control" id="tglakhir">
              </div>
            </div>
            <div class="row">
              <div class="col text-right">
                <a href="#" onclick="this.href='/admin/cetak/' + document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="blank" class="btn btn-primary">
                  Cetak
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Merk dan Tipe</th>
                  <th>Tanggal Booking</th>
                  <th>Tanggal Transaksi</th>
                  <th>Total Harga</th>
                  <th>Status Pembayaran</th>
                  <th>Status Transaksi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
                {data: 'code', name:'code'},
                {data: 'name', name:'name'},
                {data: 'brand', name:'brand'},
                {data: 'order_date', name:'order_date'},
                {data: 'created_at', name:'created_at'},
                {data: 'total_price', name:'total_price'},
                {data: 'payment_status', name:'payment_status'},
                {data: 'transaction_status', name:'transaction_status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush