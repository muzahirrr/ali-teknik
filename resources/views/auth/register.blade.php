@extends('layouts.auth')

@section('title')
  Register
@endsection

@section('content')
    <!-- REGISTER START -->
    <section class="page-auth section-margin" id="register">
      <div class="container">
        <div
          class="row align-items-center row-auth justify-content-center"
          data-aos="fade-up"
        >
          <div class="col-lg-4 mt-5">
            <h2 class="text-center mb-4">
              Sign Up
            </h2>
            <form method="POST" action="{{ route('register') }}" class="mt-3">
              @csrf
              <div class="form-group">
                <label>Full Name</label>
                <input
                  id="name"
                  type="text"
                  name="name"
                  class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name') }}"
                  required
                  autocomplete="name"
                  autofocus
                />
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input
                  id="email"
                  type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  name="email"
                  value="{{ old('email') }}"
                  required
                  autocomplete="email"
                />
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <input 
                  id="password"
                  type="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  name="password"
                  required
                  autocomplete="new-password"
                />
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password Confirmation</label>
                <input 
                  id="password-confirm"
                  type="password" 
                  class="form-control @error('password_confirmation') is-invalid @enderror" 
                  name="password_confirmation"
                  required
                  autocomplete="new-password"
                />
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-first btn-block mt-4"> Sign Up Now </button>
              <a href="{{ route('login') }}" class="btn btn-second btn-block mt-2">
                Back to Sign In
              </a>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- REGISTER END -->
@endsection