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
    <h1 class="h3 my-5 text-gray-800">Tabel Transaksi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                           <td>Kode</td>
                            <td>Nama</td>
                            <td>Merk</td>
                            <td>Order Date</td>
                            <td>Total Price</td>
                            <td>Payment Status</td>
                            <td>Transaksi Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->code }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->brand }}</td>
                                <td>{{ $transaction->order_date }}</td>
                                <td class="total-price">{{ $transaction->total_price }}</td>
                                <td>{{ $transaction->payment_status }}</td>
                                <td>{{ $transaction->transaction_status }}</td>
                                <td>
                                    <a href="#" data-id="{{ $transaction->id }}" class="btn btn-info btn-sm showDetail" data-toggle="modal" data-target="#detailTransaction">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    Data Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailTransaction" tabindex="-1" aria-labelledby="detailTransactionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTransactionLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Data user</h5>
                                <ul class="list-group">
                                    <li class="list-group-item" id="name">Nama: </li>
                                    <li class="list-group-item" id="email">Email: </li>
                                    <li class="list-group-item" id="phone_number">No. Telepon: </li>
                                    <li class="list-group-item" id="province">Provinsi: </li>
                                    <li class="list-group-item" id="city">Kota: </li>
                                    <li class="list-group-item" id="district">Kecamatan: </li>
                                    <li class="list-group-item" id="subdistrict">Kelurahan: </li>
                                    <li class="list-group-item" id="address">Alamat: </li>

                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Data Transaksi</h5>
                                <ul class="list-group">
                                    <li class="list-group-item" id="code">Transaksi Kode:</li>
                                    <li class="list-group-item" id="brand">Merk:</li>
                                    <li class="list-group-item" id="service">Service: </li>
                                    <li class="list-group-item" id="option">Option</li>
                                    <li class="list-group-item" id="detail">Detail Informasi</li>
                                    <li class="list-group-item" id="amount">Jumlah Unit</li>
                                    <li class="list-group-item" id="order_date">Order Date</li>
                                    <li class="list-group-item" id="price">Harga Jasa</li>
                                    <li class="list-group-item" id="total_price">Total Pembayaran</li>
                                    <li class="list-group-item">
                                        <label for="payment_status">Payment Status</label>
                                        <select name="payment_status" id="payment_status" class="form-control">
                                            <option value="PENDING">Pending</option>
                                            <option value="PAID">Paid</option>
                                            <option value="UNPAID">Unpaid</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item">
                                        <label for="transaction_status">Transaksi Status</label>
                                        <select name="transaction_status" id="transaction_status" class="form-control">
                                            <option value="PENDING">Pending</option>
                                            <option value="PROCESS">Process</option>
                                            <option value="SUCCESS">Success</option>
                                            <option value="CANCELED">Canceled</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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

   <script>
       $('.total-price').each(function() {
           const totalPrice = $(this).html();
              $(this).html(currencyFormatter(totalPrice));
       });

       $('.showDetail').on('click', function () {
            const id = $(this).data('id');
            // update action
            $('form').attr('action', `{{ url(Auth::user()->roles === 'ADMIN' ? '/admin/dashboard/transactions' : '/user/dashboard/transactions') }}/${id}`);
            $.ajax(`{{ url('/api/transaction') }}/${id}`, {
                success: function (transaction) {
                    console.log(transaction);
                    $('#name').html(`Nama: ${transaction.user.name}`);
                    $('#email').html(`Email: ${transaction.user.email}`);
                    $('#phone_number').html(`No. Telepon: ${transaction.phone_number}`);
                    $('#province').html(`Provinsi: ${transaction.province.name}`);
                    $('#city').html(`Kota: ${transaction.city.alternative_name}`);
                    $('#district').html(`Kecamatan: ${transaction.district.name}`);
                    $('#subdistrict').html(`Kelurahan: ${transaction.subdistrict.name}`);
                    $('#address').html(`Alamat: ${transaction.address}`);

                    $('#code').html(`Transaksi Kode: ${transaction.code}`);
                    $('#brand').html(`Merk: ${transaction.brand}`);
                    $('#service').html(`Service: ${transaction.service.name}`);
                    $('#option').html(`Option: ${transaction.option}`);
                    $('#detail').html(`Detail Informasi: ${transaction.detail}`);
                    $('#amount').html(`Jumlah Unit: ${transaction.amount}`);
                    $('#order_date').html(`Order Date: ${transaction.order_date}`);
                    $('#price').html(`Harga Jasa: ${currencyFormatter(transaction.price)}`);
                    $('#total_price').html(`Total Pembayaran: ${currencyFormatter(transaction.total_price)}`);
                    $('#payment_status').val(transaction.payment_status);
                    $('#transaction_status').val(transaction.transaction_status);
                }
            });
       });
   </script>
@endpush
