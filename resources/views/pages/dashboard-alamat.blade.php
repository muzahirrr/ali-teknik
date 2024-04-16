@extends('layouts.dashboard')

@section('title')
    Ali Teknik Dashboard Setting
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">Akun</h1>

    <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            <form action="{{ route('dashboard-setting-update', $user) }}" id="locations" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" />
                      @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" readonly />
                      @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="province_id">Provinsi</label>
                      <select
                        name="province_id"
                        id="province_id"
                        class="form-control @error('province_id') is-invalid @enderror"
                        v-if="provinces" 
                        v-model="province_id"
                      >
                        <option v-for="province in provinces" :value="province.id">
                          @{{ province.name }}
                        </option>
                      </select>
                      <select v-else class="form-control"></select>
                      @error('province_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      <input type="hidden" class="form-control" id="vProvinces" name="vProvinces" value="{{ $user->province_id }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="regency_id">Kota</label>
                      <select 
                        name="regency_id" 
                        id="regency_id" 
                        class="form-control @error('regency_id') is-invalid @enderror" 
                        v-if="regencies" 
                        v-model="regency_id"
                      >
                        <option v-for="regency in regencies" :value="regency.id">
                          @{{ regency.name }}
                        </option>
                      </select>
                      <select v-else class="form-control"></select>
                      @error('regency_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      <input type="hidden" class="form-control" id="vRegencies" name="vRegencies" value="{{ $user->regency_id }}">
                    </div>
                    <div class="form-group col-md-12">
                      <label for="address">Alamat Lengkap</label>
                      <textarea
                        name="address"
                        id="address"
                        rows="3"
                        class="form-control @error('address') is-invalid @enderror"
                        
                      >{{ $user->address }}</textarea>
                      @error('address')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="phone_number">No HP</label>
                      <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" />
                      @error('phone_number')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-right">
                      <button type="submit" class="btn btn-info px-5">
                          Save Now
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
  <script>
    var locations = new Vue({
        el: "#locations",
        mounted() {
            this.getProvincesData();
            if ($('#vRegencies').val() != ''){
              this.getRegenciesData();
            }
        },
        data: {
            provinces: null,
            regencies: null,
            province_id: $('#vProvinces').val(),
            regency_id: $('#vRegencies').val()
        },
        methods: {
            getProvincesData(){
                var self = this;
                axios.get('{{ route('api-provinces') }}')
                .then(function(response){
                    self.provinces = response.data;
                })
            },
            getRegenciesData(){
                var self = this;
                axios.get('{{ url('api/regencies') }}/' + self.province_id)
                .then(function(response){
                    self.regencies = response.data;
                })
            },
        },
        watch: {
            province_id: function(val, oldVal) {
                this.regency_id = null;
                this.getRegenciesData();
            }
        }
    });
  </script>
@endpush