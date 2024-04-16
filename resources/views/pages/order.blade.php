@extends('layouts.app')

@section('title')
    Ali Teknik Order
@endsection

@section('content')
    <!-- ORDER START -->
    <section class="order section-margin">
      <section
        class="breadcrumbs-custom"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{ url()->previous() }}">{{ $service->name }} AC</a>
                  </li>
                  <li class="breadcrumb-item active">Form Pemesanan</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="form-order mt-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <form action="{{ route('order-store', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-lg">
                  <h3 class="card-header text-center mb-3">FORM PEMESANAN</h3>
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="brand">Merk dan Tipe AC</label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required/>
                        @error('brand')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="">Layanan</label>
                        @php
                          $harga = $service->price;
                        @endphp
                        @if ($service->name === 'Pasang')
                          <div class="custom-control custom-radio mb-2">
                            <input
                              type="radio"
                              id="pasang"
                              name="option"
                              class="custom-control-input"
                              data-price="0"
                              value="{{ json_encode(['label' => 'Pasang', 'price' => 0]) }}"
                              checked
                            />
                            <label
                              class="custom-control-label font-weight-light"
                              for="pasang"
                              >Pasang Air Conditioner (300.000)</label
                            >
                          </div>
                          <div class="custom-control custom-radio mb-2">
                            <input
                              type="radio"
                              id="bongkar"
                              name="option"
                              class="custom-control-input"
                              data-price="-200000"
                              value="{{ json_encode(['label' => 'Bongkar', 'price' => -200000]) }}"
                            />
                            <label
                              class="custom-control-label font-weight-light"
                              for="bongkar"
                              >Bongkar Air Conditioner (100.000)</label
                            >
                          </div>
                          <div class="custom-control custom-radio mb-2">
                            <input
                              type="radio"
                              id="bongkarpasang"
                              name="option"
                              class="custom-control-input"
                              data-price="150000"
                              value="{{ json_encode(['label' => 'Bongkar Pasang', 'price' => 150000]) }}"
                            />
                            <label
                              class="custom-control-label font-weight-light"
                              for="bongkarpasang"
                              >Bongkar Pasang Air Conditioner (450.000)</label
                            >
                          </div>
                        @else
                          <div class="custom-control custom-radio">
                            <input 
                              type="radio"
                              id="air-conditioner"
                              name="option"
                              data-price="0"
                              value="{{ json_encode(['label' => $service->name, 'price' => 0]) }}"
                              class="custom-control-input"
                              checked
                            />
                            <label 
                              class="custom-control-label font-weight-light"
                              for="air-conditioner"
                              >{{ $service->name }} Air Conditioner</label
                            >
                          </div>
                        @endif
                      </div>
                      <div class="form-group col-md-12">
                        <label for="detail">Detail Informasi</label>
                        <textarea
                          name="detail"
                          id="detail"
                          rows="3"
                          class="form-control @error('detail') is-invalid @enderror"
                        >{{ old('detail') }}</textarea>
                        @error('detail')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        <small class="form-text text-muted">Kosongkan jika tidak ingin diisi</small>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="amount">Jumlah Unit</label>
                        <input type="number" name="amount" id="amount" value="1" min="1" class="form-control @error('amount') is-invalid @enderror" required />
                        @error('amount')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="order_date">Tanggal</label>
                        <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" name="order_date" value="{{ old('order_date') }}" required />
                        @error('order_date')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      @guest
                      <div class="form-group col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" readonly/>
                        @error('name')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" readonly/>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="province">Provinsi</label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" readonly/>
                        @error('province')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="regency">Kota</label>
                        <input type="text" class="form-control @error('regency') is-invalid @enderror" id="regency" name="regency" readonly/>
                        @error('regency')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-12">
                        <label for="address">Alamat Lengkap</label>
                        <textarea
                          name="address"
                          id="address"
                          rows="3"
                          class="form-control @error('address') is-invalid @enderror"
                          readonly
                        ></textarea>
                        @error('address')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="phone_number">No HP</label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" readonly/>
                        @error('phone_number')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      @endguest
                      @auth
                      @if ($user->province_id && $user->regency_id && $user->address && $user->phone_number)
                      <div class="form-group col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="province">Provinsi</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{ $user->province->name }}" readonly />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="regency">Kota</label>
                        <input type="text" class="form-control" id="regency" name="regency" value="{{ $user->regency->name }}" readonly />
                      </div>
                      <div class="form-group col-md-12">
                        <label for="address">Alamat Lengkap</label>
                        <textarea
                          name="address"
                          id="address"
                          rows="3"
                          class="form-control"
                          readonly
                        >{{ $user->address }}</textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="phone_number">No HP</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" readonly />
                      </div>
                      @else
                      <div class="form-group col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="province">Provinsi</label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" readonly/>
                        @error('province')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="regency">Kota</label>
                        <input type="text" class="form-control @error('regency') is-invalid @enderror" id="regency" name="regency" readonly/>
                        @error('regency')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-12">
                        <label for="address">Alamat Lengkap</label>
                        <textarea
                          name="address"
                          id="address"
                          rows="3"
                          class="form-control @error('address') is-invalid @enderror"
                          readonly
                        ></textarea>
                        @error('address')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="phone_number">No HP</label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" readonly/>
                        @error('phone_number')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      @endif
                      @endauth
                    </div>
                  </div>
                  <div class="card-footer py-4">
                    <div class="row">
                      <div class="col-md-3 pl-5">
                        <div class="order-title order-service"></div>
                        <div class="order-subtitle">Harga Jasa</div>
                      </div>
                      <div class="col-md-3 pl-5 pt-4 pt-md-0">
                        <div class="order-title order-total"></div>
                        <div class="order-subtitle">Total Pembayaran</div>
                      </div>
                      @auth
                      <div
                        class="col-md-5 pt-4 pt-md-0 text-md-right text-center"
                      >
                        <button type="submit" class="btn btn-first">Pesan Sekarang</button>
                      </div>
                      @endauth
                      @guest
                      <div
                        class="col-md-5 pt-4 pt-md-0 text-md-right text-center"
                      >
                        <a href="{{ route('login') }}" class="btn btn-first">Masuk Sekarang</a>
                      </div>
                      @endguest
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </section>
    <!-- ORDER END -->
@endsection

@push('addon-script')
  <script src="{{ url('js/currencyFormatter.js') }}"></script>
  <script>
      const ordeTotal = $('.order-total');
      const orderService = $('.order-service');
      ordeTotal.html(`${currencyFormatter({{ $harga }})}`);
      orderService.html(`${currencyFormatter({{ $harga }})}`);

      $('input[name="option"]').on('change', function() {
          const price = JSON.parse($(this).val()).price;
          const amount = $('[name="amount"]').val() || 1;
          const total = {{ $harga }} + price

          orderService.html(`${currencyFormatter(total)}`);
          ordeTotal.html(`${currencyFormatter(total * amount)}`);
      });

      $('[name="amount"]').on('keyup', function() {
          const amount = $(this).val() || 1;
          const price = JSON.parse($('[name="option"]:checked').val()).price;
          const total = {{ $harga }} + price
          ordeTotal.html(`${currencyFormatter(total * amount)}`);
      });
  </script>
@endpush