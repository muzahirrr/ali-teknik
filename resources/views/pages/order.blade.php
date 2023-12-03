@extends('layouts.app')

@section('title')
    Ali Teknik Order
@endsection

@section('content')
    <!-- ORDER START -->
    <section class="order section-margin">
        <section class="breadcrumbs-custom" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url()->previous() }}">Layanan</a>
                                </li>
                                <li class="breadcrumb-item active">Form Order</li>
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
                        <form action="" method="POST">
                            @csrf
                            @method('post')
                            <div class="card shadow-lg">
                                <h3 class="card-header text-center mb-3">FORM ORDER</h3>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="merk">Merk dan Tipe AC</label>
                                            <input type="text" class="form-control" id="merk" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Layanan</label>
                                            @php
                                                $harga = $service->price;
                                                $tambahan = 0;
                                                $satu = 100000;
                                                $dua = 200000;
                                                $tiga = 300000;
                                                $jumlahharga = 0;
                                            @endphp
                                            @if ($service->name === 'Pasang')
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="pasang" name="layanan"
                                                        class="custom-control-input" value="pasang" />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="pasang">Pasang Air Conditioner</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="bongkar" name="layanan"
                                                        class="custom-control-input" value="bongkar"
                                                        {{-- @if ('checked')
                                @php
                                  $jumlahharga = $harga + $satu
                                @endphp
                              @endif --}} />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="bongkar">Bongkar Air Conditioner (+100.000)</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="bongkarpasang" name="layanan"
                                                        class="custom-control-input" value="bongkar-pasang"
                                                        {{-- @if ('checked')
                                {{ $jumlahharga = $harga + $dua }}
                              @endif --}} />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="bongkarpasang">Bongkar Pasang Air Conditioner
                                                        (+200.000)</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="relokasi" name="layanan"
                                                        class="custom-control-input" value="relokasi"
                                                        {{-- @if ('checked')
                                {{ $jumlahharga = $harga + $tiga }}
                              @endif --}} />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="relokasi">Relokasi Air Conditioner (+300.000)</label>
                                                </div>
                                            @else
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="air-conditioner" name="layanan"
                                                        class="custom-control-input" checked />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="air-conditioner">{{ $service->name }} Air Conditioner</label>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="detail">Detail Informasi</label>
                                            <textarea name="detail" id="detail" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="amount">Jumlah Unit</label>
                                            <input type="number" class="form-control" name="amount" id="amount" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="order_date">Tanggal</label>
                                            <input type="date" class="form-control" id="order_date" name="order_date" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nama">Nama</label>
                                            <input readonly class="form-control" id="nama"
                                                value="{{ $user->name }}" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input readonly class="form-control" value="{{ $user->email }}" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="provinsi">Provinsi</label>
                                            <select name="provinsi" id="provinsi" class="form-control">
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="kota">Kota</label>
                                            <select name="kota" id="kota" class="form-control">
                                                <option value="Jakarta Selatan">
                                                    Jakarta Selatan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="alamat">Alamat Lengkap</label>
                                            <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nohp">No HP</label>
                                            <input type="number" class="form-control" id="nohp" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer py-4">
                                    <div class="row">
                                        <div class="col-md-3 pl-5">
                                            <div class="order-title">Rp 0</div>
                                            <div class="order-subtitle">Harga Jasa</div>
                                        </div>
                                        <div class="col-md-3 pl-5 pt-4 pt-md-0">
                                            <div class="order-title">Rp 120.000</div>
                                            <div class="order-subtitle">Total Pembayaran</div>
                                        </div>
                                        <div class="col-md-5 pt-4 pt-md-0 text-md-right text-center">
                                            <button type="submit" class="btn btn-first">Pesan Sekarang</button>
                                        </div>
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
    <script>
        $('input[name="option"]').on("click", function() {
            var pasang = $('input[id="pasang"]:checked');
            var bongkar = $('input[id="bongkar"]:checked');
            var bongkarpasang = $('input[id="bongkarpasang"]:checked');
            var hasilharga;

            if (pasang) {
                hasilharga = $service - > price
            } else if (bongkar) {
                hasilharga = $service - > price + 200
            }

            console.log(hasilharga);
        });
    </script>
@endpush
