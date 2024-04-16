@extends('layouts.dashboard')

@section('title')
    Ali Teknik Dashboard Transaksi
@endsection

@push('addon-style')
    <!-- Custom styles for this page -->
    <link href="/template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">Transaksi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <tbody>
                      @foreach ($transactions as $transaction)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $transaction->code }}</td>
                          <td>{{ $transaction->name }}</td>
                          <td>{{ $transaction->brand }}</td>
                          <td>{{ date('d-m-Y', strtotime($transaction->order_date)) }}</td>
                          <td>{{ date('d-m-Y', strtotime($transaction->created_at)) }}</td>
                          <td>{{ number_format($transaction->total_price,0,',','.') }}</td>
                          <td><span class="badge badge-pill @if($transaction->payment_status === 'PAID') badge-success @elseif ($transaction->payment_status === 'PENDING') badge-warning @elseif ($transaction->payment_status === 'UNPAID') badge-danger @endif">{{ $transaction->payment_status }}</span></td>
                          <td><span class="badge badge-pill @if($transaction->transaction_status === 'SUCCESS') badge-success @elseif ($transaction->transaction_status === 'PENDING') badge-warning @elseif ($transaction->transaction_status === 'CANCELED') badge-danger @elseif ($transaction->transaction_status === 'PROCESS') badge-primary @endif">{{ $transaction->transaction_status }}</span></td>
                          <td class="text-center"><a href="{{ route ('dashboard-transaction-detail', $transaction->code) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <!-- Page level plugins -->
    <script src="/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/template/js/demo/datatables-demo.js"></script>
@endpush