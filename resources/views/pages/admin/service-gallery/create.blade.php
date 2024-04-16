@extends('layouts.admin')

@section('title')
    Admin Service Gallery
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">Create New Service Gallery</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
          <form action="{{ route('service_gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Layanan</label>
                  <select name="service_id" class="form-control">
                    @foreach ($services as $service)
                      <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Foto Layanan</label>
                  <input type="file" name="photo" class="form-control @error('photo')
                    is-invalid
                  @enderror" required>
                  @error('photo')
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