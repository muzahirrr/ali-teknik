@extends('layouts.admin')

@section('title')
    Admin Service
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">Edit Service</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
          <form action="{{ route('service.update', $item) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Nama Layanan</label>
                  <input type="text" name="name" value="{{ $item->name }}" class="form-control @error('name')
                    is-invalid
                  @enderror" required>
                  @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Logo</label>
                  <input type="file" name="logo" class="form-control @error('logo')
                    is-invalid
                  @enderror" required>
                  @error('logo')
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
                  @enderror" required>
                  @error('price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Deskripsi Singkat</label>
                  <textarea name="excerpt" id="excerpt" rows="3" class="form-control @error('excerpt')
                    is-invalid
                  @enderror" required>{{ $item->excerpt }}</textarea>
                  @error('excerpt')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Penawaran</label>
                  <textarea name="offer" id="editor1" class="form-control">{!! $item->offer !!}</textarea>
                  @error('offer')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Deskripsi Layanan</label>
                  <textarea name="description" id="editor2">{!! $item->description !!}</textarea>
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
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor1', {
    height : 150
  });
  CKEDITOR.replace('editor2');
</script>
@endpush