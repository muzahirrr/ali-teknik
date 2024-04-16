@extends('layouts.dashboard')

@section('title')
    Ali Teknik Dashboard Transaksi Detail
@endsection

@push('addon-style')
<style>
  .product-title {
    font-weight: normal;
    font-size: 16px;
    line-height: 25px;
    color: #c5c5c5;
  }

  .product-subtitle {
    font-weight: normal;
    font-size: 18px;
    line-height: 30px;
    color: #0c0d36;
    margin-bottom: 20px;
  }
</style>
@endpush

@section('content')
    <!-- Page Heading -->
    <h2 class="text-dark">{{ $item->code }}</h2>
    <p class="text-gray mb-4">Transaction Detail</p>

    @if ($item->payment_status === 'UNPAID' || $item->payment_status === 'PENDING')
    <div class="card mb-3">
      <div class="card-body">
        <h4>Sukses Pemesanan</h4>
        <h6>Pesanan anda sukses dipesan, untuk pembayaran silahkan transfer ke rekening <strong>Bank BCA Nomer rekening : 8870087447 a.n. SARTONO</strong> dengan nominal : <strong>Rp. {{ number_format($item->total_price,0,',','.') }}</strong> lalu upload bukti pembayaran di bawah ini.</h6>
        <p>Note:
          <br>-Batas pengirimin bukti pembayaran adalah 1 hari dari tanggal pemesanan, jika lebih dari 1 hari maka pemesanan akan dibatalkan
          <br>-Jika status pembayaran masih pending selama 1 hari, silahkan hubungi kontak ali teknik
        </p>
      </div>
    </div>
    @endif
    <form action="{{ route('dashboard-transaction-update', $item) }}" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-4">
              <img src="{{ Storage::url($item->service->galleries->first()->photo ?? '') }}" class="w-100 mb-3" alt="">
            </div>
            <div class="col-12 col-md-8">
              <div class="row">
                <div class="col-12 col-md-6">
                    <div class="product-title">
                      Nama
                    </div>
                    <div class="product-subtitle">
                      {{ $item->name }}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-title">
                      Layanan
                    </div>
                    <div class="product-subtitle">
                      {{ $item->option }} AC
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-title">
                      Merk dan Tipe AC
                    </div>
                    <div class="product-subtitle">
                      {{ $item->brand }}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-title">
                      Detail Informasi
                    </div>
                    <div class="product-subtitle">
                      {{ $item->detail }}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-title">
                      Jumlah unit
                    </div>
                    <div class="product-subtitle">
                      {{ $item->amount }}
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-title">
                      Tanggal Booking
                    </div>
                    <div class="product-subtitle">
                      {{ date('d-m-Y', strtotime($item->order_date)) }}
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mt-4">
              <h5>Informasi Akun</h5>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Alamat
                  </div>
                  <div class="product-subtitle">
                    {{ $item->address }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Email
                  </div>
                  <div class="product-subtitle">
                    {{ $item->user->email }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Provinsi
                  </div>
                  <div class="product-subtitle">
                    {{ $item->province }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Kota
                  </div>
                  <div class="product-subtitle">
                    {{ $item->regency }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Harga
                  </div>
                  <div class="product-subtitle">
                    Rp {{ number_format($item->price,0,',','.') }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Total Harga
                  </div>
                  <div class="product-subtitle">
                    Rp {{ number_format($item->total_price,0,',','.') }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Status Pembayaran
                  </div>
                  <div class="product-subtitle @if($item->payment_status === 'PAID') text-success @elseif ($item->payment_status === 'PENDING') text-warning @elseif ($item->payment_status === 'UNPAID') text-danger @endif">
                    {{ $item->payment_status }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Status Transaksi
                  </div>
                  <div class="product-subtitle @if($item->transaction_status === 'SUCCESS') text-success @elseif ($item->transaction_status === 'PENDING') text-warning @elseif ($item->transaction_status === 'CANCELED') text-danger @elseif ($item->transaction_status === 'PROCESS') text-primary @endif">
                    {{ $item->transaction_status }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="product-title">
                    Nomor HP
                  </div>
                  <div class="product-subtitle">
                    {{ $item->phone_number }}
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label class="product-title">Bukti Pembayaran</label>
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
              @if ($item->payment_status === 'UNPAID' && $item->transaction_status === 'CANCELED')
              <div class=""></div>
              @elseif ($item->payment_status === 'PENDING' && $item->transaction_status === 'CANCELED')
              <div class=""></div>
              @elseif ($item->payment_status === 'PAID')
              <div class=""></div>
              @else
              <div class="row">
                <div class="col text-right">
                  <button type="submit" class="btn btn-info px-5">
                      Save Now
                  </button>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </form>
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