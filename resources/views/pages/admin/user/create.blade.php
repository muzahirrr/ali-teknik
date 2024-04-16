@extends('layouts.admin')

@section('title')
    Admin User
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 my-5 text-gray-800">Create New User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
          <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control @error('name')
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
                  <label>Email</label>
                  <input type="email" name="email" class="form-control @error('email')
                    is-invalid
                  @enderror" required>
                  @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control @error('password')
                    is-invalid
                  @enderror" required>
                  @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Roles</label>
                  <select name="roles" class="form-control">
                    <option value="USER">User</option>
                    <option value="ADMIN">Admin</option>
                  </select>
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