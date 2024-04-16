@extends('layouts.admin')

@section('title')
    Admin User
@endsection

@section('content')
    <!-- Page Heading -->
    <h2 class="text-dark">{{ $item->code }}</h2>
    <h5 class="text-gray mb-4">Edit Transaction</h5>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
          <form action="{{ route('transaction.update', $item) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" value="{{ $item->name }}" class="form-control @error('name')
                    is-invalid
                  @enderror" readonly required>
                  @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Layanan</label>
                  <input type="text" name="option" value="{{ $item->option }}" class="form-control @error('option')
                    is-invalid
                  @enderror" readonly required>
                  @error('option')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Merk dan Tipe AC</label>
                  <input type="text" name="brand" value="{{ $item->brand }}" class="form-control @error('brand')
                    is-invalid
                  @enderror" readonly required>
                  @error('brand')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Detail Informasi</label>
                  <textarea
                    name="detail"
                    id="detail"
                    rows="3"
                    class="form-control @error('detail') is-invalid @enderror"
                    readonly
                    required
                  >{{ $item->detail }}</textarea>
                  @error('detail')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Jumlah Unit</label>
                  <input type="text" name="amount" value="{{ $item->amount }}" class="form-control @error('amount')
                    is-invalid
                  @enderror" readonly required>
                  @error('amount')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Tanggal Booking</label>
                  <input type="date" name="order_date" value="{{ $item->order_date }}" class="form-control @error('order_date')
                    is-invalid
                  @enderror" required>
                  @error('order_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea
                    name="address"
                    id="address"
                    rows="3"
                    class="form-control @error('address') is-invalid @enderror"
                    readonly
                    required
                  >{{ $item->address }}</textarea>
                  @error('address')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" value="{{ $item->user->email }}" class="form-control @error('email')
                    is-invalid
                  @enderror" readonly required>
                  @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Provinsi</label>
                  <input type="text" name="province" value="{{ $item->province }}" class="form-control @error('province')
                    is-invalid
                  @enderror" readonly required>
                  @error('province')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kota</label>
                  <input type="text" name="regency" value="{{ $item->regency }}" class="form-control @error('regency')
                    is-invalid
                  @enderror" readonly required>
                  @error('regency')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Harga</label>
                  <input type="number" name="price" value="{{ $item->price }}" class="form-control @error('price')
                    is-invalid
                  @enderror" readonly required>
                  @error('price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Total Harga</label>
                  <input type="number" name="total_price" value="{{ $item->total_price }}" class="form-control @error('total_price')
                    is-invalid
                  @enderror" readonly required>
                  @error('total_price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Status Pembayaran</label>
                  <select name="payment_status" class="form-control">
                    @if ($item->payment_status === 'UNPAID')
                    <option value="UNPAID" selected>UNPAID</option>
                    <option value="PENDING">PENDING</option>
                    <option value="PAID">PAID</option>
                    @elseif($item->payment_status === 'PENDING')
                    <option value="UNPAID">UNPAID</option>
                    <option value="PENDING" selected>PENDING</option>
                    <option value="PAID">PAID</option>
                    @else
                    <option value="UNPAID">UNPAID</option>
                    <option value="PENDING">PENDING</option>
                    <option value="PAID" selected>PAID</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Status Transaksi</label>
                  <select name="transaction_status" class="form-control">
                    @if ($item->transaction_status === 'PENDING')
                    <option value="PENDING" selected>PENDING</option>
                    <option value="PROCESS">PROCESS</option>
                    <option value="SUCCESS">SUCCESS</option>
                    <option value="CANCELED">CANCELED</option>
                    @elseif($item->transaction_status === 'PROCESS')
                    <option value="PENDING">PENDING</option>
                    <option value="PROCESS" selected>PROCESS</option>
                    <option value="SUCCESS">SUCCESS</option>
                    <option value="CANCELED">CANCELED</option>
                    @elseif($item->transaction_status === 'SUCCESS')
                    <option value="PENDING">PENDING</option>
                    <option value="PROCESS">PROCESS</option>
                    <option value="SUCCESS" selected>SUCCESS</option>
                    <option value="CANCELED">CANCELED</option>
                    @else
                    <option value="PENDING">PENDING</option>
                    <option value="PROCESS">PROCESS</option>
                    <option value="SUCCESS">SUCCESS</option>
                    <option value="CANCELED" selected>CANCELED</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Nomor HP</label>
                  <input type="number" name="phone_number" value="{{ $item->phone_number }}" class="form-control @error('phone_number')
                    is-invalid
                  @enderror" readonly required>
                  @error('phone_number')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Bukti Pembayaran</label>
                  @if ($item->payment_confirmation)
                    <img src="{{ Storage::url($item->payment_confirmation) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                  @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  @endif
                  <input type="file" id="payment_confirmation" name="payment_confirmation" class="form-control @error('payment_confirmation')
                    is-invalid
                  @enderror" onchange="previewImage()">
                  @error('payment_confirmation')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right">
                <button type="submit" class="btn btn-info px-5">
                  Save Now
                </button>
              </div>
            </div>
          </form>
        </div>
    </div>
@endsection

@push('addon-script')
  <script>
    function previewImage(){
      const image = document.querySelector('#payment_confirmation');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob;
    }
  </script>
@endpush