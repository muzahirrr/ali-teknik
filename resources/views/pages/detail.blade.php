@extends('layouts.app')

@section('title')
    Ali Teknik Detail
@endsection

@section('content')
    <!-- DETAILS START -->
    <section class="details section-margin">
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
                  <li class="breadcrumb-item active">{{ $service->name }} AC</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="layanan-gallery" id="gallery">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :key="photos[activePhoto].id"
                  :src="photos[activePhoto].url"
                  class="w-100 main-image"
                  alt=""
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="layanan-details">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
              <h2 class="heading-details-layanan">{{ $service->name }} Air Conditioner</h2>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-10 text-justify">
              {!! $service->description !!}
            </div>
          </div>
          <div class="row justify-content-center mt-5" data-aos="fade-up">
            <div class="col-lg-6 text-center">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">
                    Harga Jasa {{ $service->name }} Air Conditioner
                  </h4>
                </div>
                <div class="card-body">
                  <h1 class="card-title pricing-card-title mb-4">
                    Rp {{ number_format($service->price,0,',','.') }} <small class="text-muted">/unit</small>
                  </h1>
                  <div class="text-left">
                    {!! $service->offer !!}
                  </div>
                  <a href="{{ route('order', $service->slug) }}" class="btn btn-first mt-3"
                    >Order Sekarang</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
    <!-- DETAILS END -->
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach ($service->galleries as $gall)
              {
                id: {{ $gall->id }},
                url: "{{ Storage::url($gall->photo) }}",
              },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
@endpush