@extends('layout.empty')

@section('title', 'Login')

@section('content')
<div class="login">
  <div class="login-content">
    <form id="login_form">
      <h1 class="text-center">Sign In</h1>
      <div class="text-muted text-center mb-4">
        For your protection, please verify your identity.
      </div>
      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" id="email" class="form-control form-control-lg fs-15px" placeholder="username@address.com" required>
      </div>
      <div class="mb-3">
        <div class="d-flex">
          <label class="form-label">Password</label>
          <a href="#" class="ms-auto text-muted">Forgot password?</a>
        </div>
        <input type="password" id="password" class="form-control form-control-lg fs-15px" placeholder="Enter your password" required>
      </div>
      <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember_me">
          <label class="form-check-label fw-500" for="remember_me">Remember me</label>
        </div>
      </div>
      <button id="login_button" class="btn btn-theme btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
      <div class="text-center text-muted">
        Don't have an account yet? <a href="/page/register">Sign up</a>.
      </div>
    </form>
  </div>
</div>
@endsection

@push('other_scripts')
<script  src="{{ asset('assets/js/auth/login.js') }}"></script>
@endpush