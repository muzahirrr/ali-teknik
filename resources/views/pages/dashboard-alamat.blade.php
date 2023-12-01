@extends('layouts.dashboard')

@section('title')
    Ali Teknik Dashboard Setting
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">Setting Akun</h1>

    <div class="dashboard-content">
        <div class="row">
        <div class="col-12">
            <form action="" id="locations" method="POST" enctype="multipart/form-data">
                <div class="card mb-4">
                    <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="provinsi">Provinsi</label>
                        <select
                          name="provinsi"
                          id="provinsi"
                          class="form-control"
                        >
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
                        <textarea
                          name="alamat"
                          id="alamat"
                          rows="3"
                          class="form-control"
                        ></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="nohp">No HP</label>
                        <input type="number" class="form-control" id="nohp" />
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