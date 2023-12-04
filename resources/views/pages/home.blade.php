@extends('layouts.app-home')

@section('title')
    Ali Teknik Home
@endsection

@section('content')
    <!-- HOME START -->
    <section class="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="zoom-in" data-aos-duration="1000">
                    <h1 class="heading-home">
                        Solusi Terbaik untuk Pasang dan Service Air Conditioner.
                    </h1>
                    <p class="subheading-home mt-3">
                        Ali Teknik hadir untuk membantu anda dalam pemesanan jasa pasang
                        dan service air conditioner agar menikmati suhu yang nyaman setiap
                        hari!
                    </p>
                    <div class="btn-home text-center text-lg-left">
                        <a href="#service" class="btn btn-second">Mulai Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="1000">
                    <div class="img-home mt-5 mt-lg-0 text-center">
                        <img src="/images/home-hero.png" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HOME END -->

    <!-- ABOUT START -->
    <section class="tentang section-margin" id="about">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center" style="overflow-x: hidden">
                <div class="col-lg-3 col-md-4" data-aos="fade-right" data-aos-delay="100">
                    <img src="/images/tentangsatu.png" class="img-fluid" alt="" />
                    <img src="/images/tentangdua.png" class="img-fluid mt-4" alt="" />
                </div>
                <div class="col-lg-3 col-md-4" data-aos="fade-right" data-aos-delay="200">
                    <img src="/images/tentangtiga.png" class="img-fluid mt-4 mt-md-0 mt-lg-0" alt="" />
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="300">
                    <h5 class="subheading-tentang text-lg-left">Tentang Kami</h5>
                    <h2 class="heading-tentang text-lg-left">
                        Dari Awal Hingga Menjadi Yang Sekarang
                    </h2>
                    <p class="text-justify isi-tentang mt-4">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Exercitationem sint, ratione voluptatem accusantium dolor corrupti
                        ullam explicabo labore hic modi eaque ut aliquam, repellendus eos
                        est autem nulla consectetur eligendi mollitia blanditiis maiores
                        voluptatibus, quae fugiat. Sequi ipsa similique minima architecto
                        possimus esse, voluptates quibusdam ut qui, alias officiis! Quos!
                        <br />
                        <br />
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                        ad iure quae inventore, nostrum est, eius error natus repudiandae
                        eveniet officiis explicabo, laudantium itaque sequi quisquam quod
                        rem esse. Dicta. Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Dicta laboriosam voluptatem possimus consequatur
                        itaque quaerat cumque impedit quisquam velit hic.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT END -->

    <!-- SERVICE START -->
    <section class="layanan section-margin" id="service">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="heading-layanan pt-5">Layanan</h2>
                    <h5 class="subheading-layanan">
                        Mengarahkan Langkah Kita Menuju Tujuan Bersama
                    </h5>
                </div>
            </div>
            <div class="row py-5 justify-content-center">
                @php $incrementService = 0 @endphp
                @forelse ($services as $item)
                    <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="{{ $incrementService += 200 }}">
                        <div class="card card-layanan">
                            <div class="card-layanan-img text-center pt-5">
                                <img src="{{ Storage::url($item->logo) }}" alt="" />
                            </div>
                            <div class="card-body text-center pt-4">
                                <a href="{{ route('detail', $item->slug) }}" class="btn btn-first">{{ $item->name }}
                                    AC</a>
                                <p class="card-text pt-3 pb-2">
                                    {{ $item->excerpt }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-white" data-aos="fade-up" data-aos-delay="100">
                        No Services Found
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- SERVICE END -->

    <!-- CONTACT START -->
    <section class="kontak section-margin" id="contact">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-6 col-md-6" data-aos="flip-right">
                    <h5 class="subheading-kontak text-lg-left">Kontak</h5>
                    <h2 class="heading-kontak text-lg-left">
                        Hubungi kami jika anda ingin bertanya atau terdapat kendala
                    </h2>
                    <div class="d-flex text-left align-items-center mt-5">
                        <img src="/images/location.png" alt="" class="mr-3" />
                        <a href="#" class="text-decoration-none info-kontak">Jalan Amd X Rt 02 Rw 06 No.14, Kreo,
                            Larangan, RT.003/RW.006,
                            Petukangan Utara, Kec. Pesanggrahan, Tanggerang, Banten 15156</a>
                    </div>
                    <div class="d-flex text-left align-items-center mt-3">
                        <img src="/images/telephone.png" alt="" class="mr-3" />
                        <a href="#" class="text-decoration-none info-kontak">021-94375</a>
                    </div>
                    <div class="d-flex text-left align-items-center mt-3">
                        <img src="/images/whatsapp.png" alt="" class="mr-3" />
                        <a href="#" class="text-decoration-none info-kontak">085155360226</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-5 mt-md-0" data-aos="flip-left" data-aos-delay="200">
                    <div class="img-kontak">
                        <img src="/images/kontak.svg" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT END -->
@endsection

@push('addon-script')
    <script src="/script/script.js"></script>
@endpush
