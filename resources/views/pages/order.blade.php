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
                        <form action="" data method="POST">
                            @csrf
                            @method('post')
                            <div class="card shadow-lg">
                                <h3 class="card-header text-center mb-3">FORM ORDER</h3>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="brand">Merk dan Tipe AC</label>
                                            <input type="text" class="form-control" id="brand" name="brand" />
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
                                                    <input type="radio" id="pasang" name="service"
                                                        class="custom-control-input" data-price="0" value="{{ json_encode(['label' => 'pasang', 'price' => 0])  }}" />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="pasang">Pasang Air Conditioner</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="bongkar" name="service"
                                                        class="custom-control-input" data-price="100000" value="{{ json_encode(['label' => 'bongkar', 'price' => 100000]) }}"/>
                                                    <label class="custom-control-label font-weight-light"
                                                        for="bongkar">Bongkar Air Conditioner (+100.000)</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="bongkar_pasang" name="service"
                                                        class="custom-control-input" data-price="200000" value="{{ json_encode(['label' => 'bongkar_pasang', 'price' => 200000])  }}" />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="bongkar_pasang">Bongkar Pasang Air Conditioner
                                                        (+200.000)</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="relokasi" name="service"
                                                        class="custom-control-input" data-price="300000" value="{{ json_encode(['label' => 'relokasi', 'price' => 300000])  }}" />
                                                    <label class="custom-control-label font-weight-light"
                                                        for="relokasi">Relokasi Air Conditioner (+300.000)</label>
                                                </div>
                                            @else
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="air-conditioner" name="service" data-price="0" value="{{ json_encode(['label' => $service->name, 'price' => 0]) }}"
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
                                            <label for="province_id">Provinsi</label>
                                            <select name="province_id" id="province_id" class="form-control" onchange="findLocation(this, 'cities', 'city_id')">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="city_id">Kota</label>
                                            <select name="city_id" id="city_id" class="form-control" onchange="findLocation(this, 'districts', 'district_id')"></select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="district_id">Kecamatan</label>
                                            <select name="district_id" id="district_id" class="form-control" onchange="findLocation(this, 'subdistricts', 'subdistrict_id')"></select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="subdistrict_id">Kelurahan</label>
                                            <select name="subdistrict_id" id="subdistrict_id" class="form-control"></select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="address">Alamat Lengkap</label>
                                            <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone_number">No HP</label>
                                            <input type="number" class="form-control" id="phone_number" name="phone_number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer py-4">
                                    <div class="row">
                                        <div class="col-md-3 pl-5">
                                            <div class="order-service">Rp 0</div>
                                            <div class="order-subtitle">Harga Jasa</div>
                                        </div>
                                        <div class="col-md-3 pl-5 pt-4 pt-md-0">
                                            <div class="order-total"></div>
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
        const ordeTotal = $('.order-total');
        const orderService = $('.order-service');
        ordeTotal.html(`${currencyFormatter({{ $harga }})}`);
        // $('input[name="option"]').on("click", function() {
        //     var pasang = $('input[id="pasang"]:checked');
        //     var bongkar = $('input[id="bongkar"]:checked');
        //     var bongkarpasang = $('input[id="bongkarpasang"]:checked');
        //     var hasilharga;
        //
        //     if (pasang) {
        //         hasilharga = $service - > price
        //     } else if (bongkar) {
        //         hasilharga = $service - > price + 200
        //     }
        //
        //     console.log(hasilharga);
        // });

        // $('#provinsi').change(function() {
        //     const provinsi_id = $(this).val();
        // });
        function findLocation(e, type, selectId) {
            console.log(e.value);
            const id = e.value;
            const url = '{{ url('/api/location') }}' + '/' + type + '/' + id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(items) {
                    // remove all options from select box
                    const target = $('#' + selectId);
                    target.html('');
                    for (const item of items) {
                        target.append(
                            `<option value="${item.id}">${item.name}</option>`
                        );
                    }
                }
            });
        }


       $('input[name="service"]').on('change', function() {
            const price = JSON.parse($(this).val()).price;
            const amount = $('[name="amount"]').val() || 1;

            const total = price + ({{ $harga }} * amount);

            orderService.html(`${currencyFormatter(price)}`);
            ordeTotal.html(`${currencyFormatter(total)}`);
        });

        $('[name="amount"]').on('keyup', function() {
            const amount = $(this).val() || 1;
            const price = JSON.parse($('[name="service"]:checked').val()).price;
            const total = price + {{ $harga }} * amount;
            orderService.html(`${currencyFormatter(price)}`);
            ordeTotal.html(`${currencyFormatter(total)}`);
        });

    </script>
@endpush
