@extends('layouts.auth')

@section('title')
  Login
@endsection

@section('content')
    <!-- LOGIN START -->
    <section class="page-auth section-margin">
      <div class="container">
        <div
          class="row align-items-center row-auth justify-content-center"
          data-aos="fade-up"
        >
          <div class="col-lg-6 text-center mb-lg-0 mb-5">
            <img src="/images/login.svg" alt="" class="w-75" />
          </div>
          <div class="col-lg-5">
            <h2 class="text-center text-lg-left">
              Sign In
            </h2>
            <form method="POST" action="{{ route('login') }}" class="mt-4">
              @csrf
              <div class="form-group">
                <label>Email Address</label>
                <input id="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-first btn-block w-75 mt-4">
                Sign In to My Account
              </button>
              <a
                href="{{ route('register') }}"
                class="btn btn-second btn-block w-75 mt-2"
              >
                Sign Up
              </a>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- LOGIN END -->
@endsection
